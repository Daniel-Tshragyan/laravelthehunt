<?php

namespace App\Service;

use App\Http\Requests\CityValidator;
use App\Models\City;
use App\Models\Job;
use Illuminate\Http\Request;

class CityService
{
    public function paginationArguments(Request $request)
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

        if ($request->input("how")) {
            $how = $request->input('how');
        }
        foreach ($searched as $key => $value) {
            if ($request->input($key) || (!is_null($request->input($key)) && $request->input($key) == 0)) {
                if ($key == 'name') {
                    $where[] = [$key, 'like', "%{$request->input($key)}%"];
                    $withPath .= "&{$key}={$request->input($key)}";
                    $searched[$key] = $request->input($key);
                } else {
                    $where[] = [$key, '=', "{$request->input($key)}"];
                    $withPath .= "&{$key}={$request->input($key)}";
                    $searched[$key] = $request->input($key);
                }
            }
        }
        return $this->getPagination(['withPath' => $withPath, 'order_by' => $order_by, 'searched' => $searched,
            'where' => $where, 'how' => $how]);
    }

    public function getPagination($array)
    {
        if (!empty($array['where'])) {
            $city = City::where($array['where'])->orderBy($array['order_by'], $array['how'])->paginate(3);
            $city->withPath("city?order_by={$array['order_by']}&how={$array['how']}" . $array['withPath']);

        } else {
            $city = City::orderBy($array['order_by'], $array['how'])->paginate(3);
            $city->withPath("city?order_by={$array['order_by']}&how={$array['how']}");
        }
        if ($array['how'] == 'asc') {
            $array['how'] = 'desc';
        } else {
            $array['how'] = 'asc';
        }
        $array['sorts'] = ['id' => $array['how'], 'name' => $array['how']];
        $newarray = ['cities' => $city, 'sorts' => $array['sorts'], 'searched' => $array['searched']];

        return $newarray;
    }

    public function fillCity(CityValidator $request, City $city)
    {
        $city->fill(['name' => $request->input('name')]);
        return $city->save();
    }

    public function deleteCity(City $city)
    {
        return $city->delete();
    }
}
