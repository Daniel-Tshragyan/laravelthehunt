<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\City;
use App\Facades\UserServiceFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

//use App\Service\UserService;
use App\Http\Requests\UserValidator;
use App\Facades\UserServiceHelper;

class UserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginationArguments = UserServiceFacade::paginationArguments($request->all());
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
        if ($user->role == User::ROLE_CANDIDATE) {
            $candidate = $user->candidate->toArray();
            $city = City::find($candidate['city_id']);
            return view('admin.user.show', ['user' => $user, 'candidate' => $candidate, 'city' => $city]);
        }
        if ($user->role == User::ROLE_COMPANY) {
            $company = $user->company->toArray();
            $city = City::find($company['city_id']);
            return view('admin.user.show', ['user' => $user, 'company' => $company, 'city' => $city]);
        }
        if ($user->role == User::ROLE_ADMIN) {
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
        if ($user->role == User::ROLE_CANDIDATE) {
            $candidate = $user->candidate->toArray();
            return view('admin.user.update', compact('user', 'candidate', 'cities'));
        }
        if ($user->role == User::ROLE_COMPANY) {
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


        if ($user->role == User::ROLE_CANDIDATE) {
            UserServiceFacade::updateCandidate($request->validated(), $user);
        }
        if ($user->role == User::ROLE_COMPANY) {
            Session::flash('message', 'User Updated');
            UserServiceFacade::updateCompany($request->validated(), $user);
        }
        UserServiceFacade::updateUser($request->validated(), $user);
        Session::flash('message', 'User Updated');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->role == User::ROLE_CANDIDATE) {
            UserServiceFacade::deleteCandidate($user);
        }
        if ($user->role == User::ROLE_COMPANY) {
            UserServiceFacade::deleteCompany($user);
        }
        UserServiceFacade::deleteUser($user);
        Session::flash('message', 'User Deleted');
        return redirect()->route('user.index');
    }

}
