<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $req)
    {
        $req->validate([
            'email' => ['required', 'string'],
            'password' => ['required']
        ]);
        $admin = User::find(1);
        if ($req->input('email') == $admin->email) {
            if (Hash::check($req->input('password'), $admin->password)) {
                $req->session()->put('admin', 'true');
                return redirect()->route('adminDashboard');
            } else {
                Session::flash('password', 'Invalid Password');
                return redirect()->route('adminloginpage');
            }
        } else {
            Session::flash('login', 'Invalid Login');
            return redirect()->route('adminloginpage');
        }
    }

    public function logout(Request $req)
    {
        $req->session()->forget('admin');
        return redirect('/');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
