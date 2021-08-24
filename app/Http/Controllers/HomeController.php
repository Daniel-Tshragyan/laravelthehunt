<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        dd(auth()->user());
        return view('home');
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
