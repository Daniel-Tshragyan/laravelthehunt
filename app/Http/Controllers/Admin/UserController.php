<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Service\UserService;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searched = ['name' => '', 'email' => '', 'id' => '', 'role' => '',];
        $userService = new UserService();
        $paginationArguments = $userService->paginationArguments($request, $searched);
        $filters = ['0' => 'admin', '1' => 'candidate', '2' => 'company'];
        $withPath = $paginationArguments['withPath'];
        $order_by = $paginationArguments['order_by'];
        $how = $paginationArguments['how'];
        $where = $paginationArguments['where'];
        $searched = $paginationArguments['searched'];


        if (!empty($where)) {
            $users = User::where($where)->orderBy($order_by, $how)->paginate(3);
            $users->withPath("user?order_by={$order_by}&how={$how}" . $withPath);

        } else {
            $users = User::orderBy($order_by, $how)->paginate(3);
            $users->withPath("user?order_by={$order_by}&how={$how}");
        }

        $how = ($how == 'asc') ? 'desc' : 'asc';
        $sorts = ['id' => $how, 'name' => $how, 'role' => $how, 'email' => $how];

        return view('admin.user.index', ['searched' => $searched, 'users' => $users, 'sorts' => $sorts, 'filters' => $filters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if ($user->role == '1') {
            $candidate = $user->candidate->toArray();
            $city = City::find($candidate['city_id']);
            return view('admin.user.show', ['user' => $user, 'candidate' => $candidate, 'city' => $city]);
        }
        if ($user->role == '2') {
            $company = $user->company->toArray();
            $city = City::find($company['city_id']);
            return view('admin.user.show', ['user' => $user, 'company' => $company, 'city' => $city]);
        }
        if ($user->role == 0) {
            return view('admin.user.show', ['user' => $user]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $cities = City::all();
        if ($user->role == 1) {
            $candidate = $user->candidate->toArray();
            $city = City::find($candidate['city_id']);
            return view('admin.user.update', ['user' => $user, 'candidate' => $candidate, 'cities' => $cities,
                'city' => $city]);
        }
        if ($user->role == 2) {
            $company = $user->company->toArray();
            $city = City::find($company['city_id']);
            return view('admin.user.update', ['user' => $user, 'company' => $company, 'cities' => $cities,
                'city' => $city]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $userService = new UserService();
        if ($user->role == 1) {
            $userService->candidateValidate($request, $user);
            $userService->updateCandidate($request, $user);
        }
        if ($user->role == 2) {
            $userService->companyValidate($request, $user);
            Session::flash('message', 'User Updated');
            $userService->updateCompany($request, $user);
        }
        Session::flash('message', 'User Updated');
        return redirect('admin/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->role == 'candidat') {
            $candidat = $user->candidate->toArray();
            Storage::delete('/public/users_images/' . $candidat['image']);
        }
        if ($user->role == 'company') {
            $company = $user->company->toArray();
            Storage::delete('/public/users_images/' . $company['image']);
        }
        $user->delete();
        Session::flash('message', 'User Deleted');
        return redirect('admin/user');
    }

    public function candidatreg()
    {
        $city = City::all();
        return view('viewarchive.register', ['cities' => $city]);
    }

    public function companyreg()
    {
        $city = City::all();
        return view('viewarchive.register1', ['cities' => $city]);
    }
}
