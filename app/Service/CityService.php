<?php

namespace App\Service;

use App\DataObjects\CityObject;
use App\Http\Requests\CityValidator;
use App\Models\City;
use App\Models\Job;
use Illuminate\Http\Request;

class CityService
{
    public function paginationArguments($data)
    {
        $order_by = 'id';
        $how = 'asc';
        $where = [];
        $withPath = '';
        $searched = [
            'name' => '',
            'id' => '',
        ];

        if (isset($data['order_by'])) {
            $order_by = $data['order_by'];
        }

        if (isset($data['how'])) {
            $how = $data['how'];
        }
        foreach ($searched as $key => $value) {
            if (isset($data[$key]) || isset($data[$key]) && (!is_null($data[$key]) && $data[$key] == 0)) {
                if ($key == 'name') {
                    $where[] = [$key, 'like', "%{$data[$key]}%"];
                    $withPath .= "&{$key}={$data[$key]}";
                    $searched[$key] = $data[$key];
                } else {
                    $where[] = [$key, '=', "{$data[$key]}"];
                    $withPath .= "&{$key}={$data[$key]}";
                    $searched[$key] = $data[$key];
                }
            }
        }
        return $this->getPagination(['withPath' => $withPath, 'order_by' => $order_by, 'searched' => $searched,
            'where' => $where, 'how' => $how]);
    }

    public function getPagination($data)
    {
        if (!empty($data['where'])) {
            $city = City::where($data['where'])->orderBy($data['order_by'], $data['how'])->paginate(3);
            $city->withPath("city?order_by={$data['order_by']}&how={$data['how']}" . $data['withPath']);

        } else {
            $city = City::orderBy($data['order_by'], $data['how'])->paginate(3);
            $city->withPath("city?order_by={$data['order_by']}&how={$data['how']}");
        }
        if ($data['how'] == 'asc') {
            $data['how'] = 'desc';
        } else {
            $data['how'] = 'asc';
        }
        $data['sorts'] = ['id' => $data['how'], 'name' => $data['how']];
        $newarray = ['cities' => $city, 'sorts' => $data['sorts'], 'searched' => $data['searched']];

        return new CityObject($city, $data['sorts'], $data['searched']);
    }

    public function fillCity($data, City $city)
    {
        $city->fill($data);
        return $city->save();
    }

    public function deleteCity(City $city)
    {
        return $city->delete();
    }
}
