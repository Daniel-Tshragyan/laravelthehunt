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


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = ['0' => 'admin', '1' => 'candidate', '2' => 'company'];
        $withPath = '';
        $order_by = 'id';
        $how = 'asc';
        $where = [];
        $searched = [
            'name' => '',
            'email' => '',
            'id' => '',
            'role' => '',
        ];

        if ($request->input("order_by")) {
            $order_by = $request->input('order_by');
        }

        if ($request->input('name')) {
            $where[] = ['name', 'like', "%{$request->input('name')}%"];
            $withPath .= "&name={$request->input('name')}";
            $searched['name'] = $request->input('name');
        }

        if ($request->input('email')) {
            $where[] = ['email', 'like', "%{$request->input('email')}%"];
            $withPath .= "&email={$request->input('email')}";
            $searched['email'] = $request->input('email');
        }
        if ($request->input('role') && $request->input('role') != 'a') {
            $where[] = ['role', '=', "{$request->input('role')}"];
            $withPath .= "&role={$request->input('role')}";
            $searched['role'] = $request->input('role');

        }

        if ($request->input('id')) {
            $where[] = ['id', '=', "{$request->input('id')}"];
            $withPath .= "&id={$request->input('id')}";
            $searched['id'] = $request->input('id');

        }

        if ($request->input('how')) {
            $how = $request->input('how');
        }

        if (!empty($where)) {
            $users = User::where($where)->orderBy($order_by, $how)->paginate(3);
            $users->withPath("user?order_by={$order_by}&how={$how}" . $withPath);

        } else {
            $users = User::orderBy($order_by, $how)->paginate(3);
            $users->withPath("user?order_by={$order_by}&how={$how}");
        }

        if ($how == 'asc') {
            $how = 'desc';
        } else {
            $how = 'asc';
        }

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
        if ($user->role == 'candidate') {
            $candidate = $user->candidate->toArray();
            $city = City::find($candidate['city_id']);
            return view('admin.user.show', ['user' => $user, 'candidate' => $candidate, 'city' => $city]);
        }
        if ($user->role == 'company') {
            $company = $user->company->toArray();
            $city = City::find($company['city_id']);
            return view('admin.user.show', ['user' => $user, 'company' => $company, 'city' => $city]);
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

        if ($user->role == 'candidate') {
            $candidate = $user->candidate->toArray();
            $city = City::find($candidate['city_id']);
            return view('admin.user.update', ['user' => $user, 'candidate' => $candidate, 'cities' => $cities, 'city' => $city]);
        }
        if ($user->role == 'company') {
            $company = $user->company->toArray();
            $city = City::find($company['city_id']);
            return view('admin.user.update', ['user' => $user, 'company' => $company, 'cities' => $cities, 'city' => $city]);
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

        $cities = City::all();

        $userInformation = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];


        $validationArray = [
            'name' => ['required', 'string'],
            'city' => ['required', 'numeric', 'exists:App\Models\City,id'],
            'location' => ['required', 'string'],
        ];

        if ($request->input('email') != $user->email) {
            $validationArray['email'] = ['required', 'string', 'email', 'max:255', 'unique:App\Models\User,email'];
        }
        if ($request->input('password')) {
            $validationArray['password'] = ['required', 'string', 'min:8', 'confirmed'];
            $userInformation['password'] = Hash::make($request->input('password'));
        }
        if ($request->file('image')) {
            $validationArray['image'] = ['required', 'image'];
        }

        if ($user->role == 'candidate') {
            $validationArray['age'] = ['required', 'numeric'];
            $validationArray['profession'] = ['required', 'string', 'max:255'];
        }
        if ($user->role == 'company') {
            $validationArray['comapnyname'] = ['required', 'string', 'max:255'];
            $validationArray['tagline'] = ['required', 'string'];
        }

        $request->validate($validationArray);

        $user->fill($userInformation);
        $user->save();

        $fillInformation = [
            'city_id' => $request->input('city'),
            'location' => $request->input('location'),
        ];

        if ($user->role == 'candidate') {
            $fillInformation['age'] = $request->input('age');
            $fillInformation['profession'] = $request->input('profession');

            $candidat = $user->candidate->toArray();
            if ($request->file('image')) {
                Storage::delete('/public/users_images/' . $candidat['image']);
                $random = Str::random(60);
                $imageName = $random . '.' . $request->file('image')->extension();
                $request->file('image')->storeAs('public/users_images', $imageName);
                $fillInformation['image'] = $imageName;
            }
            $user->candidate->fill($fillInformation);
            $user->candidate->save();
            $city = City::find($candidat['city_id']);
            $newcandidat = $user->candidate->toArray();
            Session::flash('message', 'User Updated');
            $allusers = User::all();
            $filters = ['0' => 'admin', '1' => 'candidate', '2' => 'company'];
            $searched = [
                'name' => '',
                'email' => '',
                'id' => '',
                'role' => '',
            ];
            $sorts = ['id' => 'asc', 'name' => 'asc', 'role' => 'asc', 'email' => 'asc'];

            return view('admin.user.index', ['user' => $allusers, 'filters' => $filters, 'searched' => $searched, 'sorts' => $sorts]);

        }

        if ($user->role == 'company') {
            $fillInformation['tagline'] = $request->input('tagline');
            $fillInformation['comapnyname'] = $request->input('comapnyname');

            $company = $user->company->toArray();
            if ($request->file('image')) {
                Storage::delete('/public/users_images/' . $company['image']);
                $random = Str::random(60);
                $imageName = $random . '.' . $request->file('image')->extension();
                $request->file('image')->storeAs('public/users_images', $imageName);
                $fillInformation['image'] = $imageName;
            }
            $user->company->fill($fillInformation);
            $user->company->save();
            $city = City::find($company['city_id']);
            $newcompany = $user->company->toArray();
            Session::flash('message', 'User Updated');
            $allusers = User::all();
            $filters = ['0' => 'admin', '1' => 'candidate', '2' => 'company'];
            $searched = [
                'name' => '',
                'email' => '',
                'id' => '',
                'role' => '',
            ];
            $sorts = ['id' => 'asc', 'name' => 'asc', 'role' => 'asc', 'email' => 'asc'];

            return view('admin.user.index', ['user' => $allusers, 'filters' => $filters, 'searched' => $searched, 'sorts' => $sorts]);
            return view('admin.user.update', ['user' => $user, 'company' => $newcompany, 'cities' => $cities, 'city' => $city]);
        }
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
