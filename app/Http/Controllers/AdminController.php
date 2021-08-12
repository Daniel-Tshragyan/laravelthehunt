<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
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
                $req->session()->put('admin','true');
                return redirect()->route('adminDashboard');
            } else {
                Session::flash('password', 'Invalid Password');
            }
        } else {
            Session::flash('login', 'Invalid Email');
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
