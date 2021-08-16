<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Condidate;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validationArray = [
            'name' => ['required', 'string'],
            'city' => ['required', 'numeric', 'exists:App\Models\City,id'],
            'location' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => ['required','image'],
            'role' => ['required', 'string', 'in:candidate,company'],
        ];
        if ($data['role'] == 'candidate') {
            $validationArray['age'] = ['required', 'numeric'];
            $validationArray['profession'] = ['required', 'string', 'max:255'];
        }elseif ($data['role'] == 'company') {
            $validationArray['companyname'] = ['required', 'string', 'max:255'];
            $validationArray['tagline'] = ['required','string'];
        }
        return Validator::make($data, $validationArray);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $user = new User();
        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);
        $user->save();
        $id = $user->id;

        $random = Str::random(60);
        $imageName = $random . '.' . $data['image']->extension();
        if ($data['role'] == 'candidate') {
            $candidat = new Condidate();
            $candidat->fill([
                'user_id' => $id,
                'age' => $data['age'],
                'profession' => $data['profession'],
                'city_id' => $data['city'],
                'location' => $data['location'],
                'image' => $imageName
            ]);
            $data['image']->storeAs('public/users_images',$imageName);
            $candidat->save();
        }
        if ($data['role'] == 'company') {
            $company = new Company();
            $company->fill([
                'user_id' => $id,
                'comapnyname' => $data['companyname'],
                'tagline' => $data['tagline'],
                'location' => $data['location'],
                'city_id' => $data['city'],
                'image' => $imageName
            ]);
            $company->save();
            $data['image']->storeAs('public/users_images',$imageName);

        }
        return $user;

    }
}
