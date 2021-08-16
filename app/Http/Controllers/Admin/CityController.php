<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $order_by = 'id';
        $how = 'asc';
        $where = [];
        $withPath = '';
        $searched = [
            'name' => '',
            'id' => '',
        ];

        if ($request->input("order_by")) {
            $order_by = $request->input('order_by');
        }

        if ($request->input('name')) {
            $where[] = ['name', 'like', "%{$request->input('name')}%"];
            $withPath .= "&&name={$request->input('name')}";
            $searched['name'] = $request->input('name');

        }

        if ($request->input('id')) {
            $where[] = ['name', '=', "id"];
            $withPath .= "&&name={$request->input('name')}";
            $searched['id'] = $request->input('id');

        }

        if (!empty($where)) {
            $city = City::where($where)->orderBy($order_by, $how)->paginate(3);
            $city->withPath("city?order_by={$order_by}&how={$how}" . $withPath);

        } else {
            $city = City::orderBy($order_by, $how)->paginate(3);
            $city->withPath("city?order_by={$order_by}&how={$how}");
        }

        if ($how == 'asc') {
            $how = 'desc';
        } else {
            $how = 'asc';
        }

        $sorts = ['id' => 'asc', 'name' => 'asc'];
        return view('admin.city.index', ['cities' => $city, 'sorts' => $sorts, 'searched' => $searched]);
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:App\Models\City,name']
        ]);
        $city = new City();
        $city->fill(['name' => $request->input('name')]);
        $city->save();
        Session::flash('message', 'City Added');
        $cityAll = City::all();
        $sorts = ['id' => 'asc', 'name' => 'asc'];
        $searched = [
            'name' => '',
            'id' => '',
        ];

        return view('admin.city.index', ['cities' => $cityAll, 'sorts' => $sorts, 'searched' => $searched]);

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
    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => ['required', 'string']
        ]);
        $city->fill(['name' => $request->input('name')]);
        $city->save();
        Session::flash('message', 'City Changed');
        $cityAll = City::all();
        $sorts = ['id' => 'asc', 'name' => 'asc'];
        $searched = [
            'name' => '',
            'id' => '',
        ];

        return view('admin.city.index', ['cities' => $cityAll, 'sorts' => $sorts, 'searched' => $searched]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        Session::flash('message', 'City Deleted');
        return redirect('admin/city');
    }
}
