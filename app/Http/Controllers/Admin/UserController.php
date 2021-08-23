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
use App\Http\Requests\UserValidator;


class UserController extends Controller
{
    const Admin_Number = 0;
    const Company_Number = 2;
    const Candidate_Number = 1;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, UserService $userService)
    {
        $paginationArguments = $userService->paginationArguments($request->all());
        return view('admin.user.index', $paginationArguments);
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
        if ($user->role == self::Candidate_Number) {
            $candidate = $user->candidate->toArray();
            $city = City::find($candidate['city_id']);
            return view('admin.user.show', ['user' => $user, 'candidate' => $candidate, 'city' => $city]);
        }
        if ($user->role == self::Company_Number) {
            $company = $user->company->toArray();
            $city = City::find($company['city_id']);
            return view('admin.user.show', ['user' => $user, 'company' => $company, 'city' => $city]);
        }
        if ($user->role == self::Admin_Number) {
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
        $cities = City::all()->pluck('id', 'name')->toArray();
        if ($user->role == self::Candidate_Number) {
            $candidate = $user->candidate->toArray();
            return view('admin.user.update', compact('user', 'candidate', 'cities'));
        }
        if ($user->role == self::Company_Number) {
            $company = $user->company->toArray();
            return view('admin.user.update', compact('user', 'company', 'cities'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserValidator $request, User $user)
    {
        $userService = new UserService();

        if ($user->role == self::Candidate_Number) {
            $userService->updateCandidate($request->validated(), $user);
        }
        if ($user->role == self::Company_Number) {
            Session::flash('message', 'User Updated');
            $userService->updateCompany($request->validated(), $user);
        }
        $userService->updateUser($request->validated(), $user);
        Session::flash('message', 'User Updated');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, UserService $userService)
    {
        if ($user->role == self::Candidate_Number) {
            $userService->deleteCandidate($user);
        }
        if ($user->role == self::Company_Number) {
            $userService->deleteCompany($user);
        }
        $userService->deleteUser($user);
        Session::flash('message', 'User Deleted');
        return redirect()->route('user.index');
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
