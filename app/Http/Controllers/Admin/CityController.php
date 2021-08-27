<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\User;
use App\Facades\CityFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CityValidator;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginationArguments = CityFacade::paginationArguments($request->all());
        return view('admin.city.index', $paginationArguments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.city.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityValidator $request)
    {

        $city = new City();
        CityFacade::fillCity($request->validated(), $city);
        Session::flash('message', 'City Added');
        return redirect()->route('city.index');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return view('admin.city.show', ['city' => $city]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        return view('admin.city.update', ['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityValidator $request, City $city)
    {
        CityFacade::fillCity($request->validated(), $city);
        Session::flash('message', 'City Changed');
        return redirect()->route('city.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        CityFacade::deleteCity($city);
        Session::flash('message', 'City Deleted');
        return redirect()->route('city.index');
    }
}
