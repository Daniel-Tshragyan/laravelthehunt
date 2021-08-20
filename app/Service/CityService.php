<?php

namespace App\Service;

use App\Http\Requests\CityValidator;
use App\Models\City;
use App\Models\Job;
use Illuminate\Http\Request;

class CityService
{
    public function paginationArguments($arr)
    {
        $order_by = 'id';
        $how = 'asc';
        $where = [];
        $withPath = '';
        $searched = [
            'name' => '',
            'id' => '',
        ];

        if (isset($arr['order_by'])) {
            $order_by = $arr['order_by'];
        }

        if (isset($arr['how'])) {
            $how = $arr['how'];
        }
        foreach ($searched as $key => $value) {
            if (isset($arr[$key]) || isset($arr[$key]) && (!is_null($arr[$key]) && $arr[$key] == 0)) {
                if ($key == 'name') {
                    $where[] = [$key, 'like', "%{$arr[$key]}%"];
                    $withPath .= "&{$key}={$arr[$key]}";
                    $searched[$key] = $arr[$key];
                } else {
                    $where[] = [$key, '=', "{$arr[$key]}"];
                    $withPath .= "&{$key}={$arr[$key]}";
                    $searched[$key] = $arr[$key];
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

    public function fillCity($arr, City $city)
    {
        $city->fill(['name' => $arr['name']]);
        return $city->save();
    }

    public function deleteCity(City $city)
    {
        return $city->delete();
    }
}
