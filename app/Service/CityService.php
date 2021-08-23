<?php

namespace App\Service;

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

    public function getPagination($dataay)
    {
        if (!empty($dataay['where'])) {
            $city = City::where($dataay['where'])->orderBy($dataay['order_by'], $dataay['how'])->paginate(3);
            $city->withPath("city?order_by={$dataay['order_by']}&how={$dataay['how']}" . $dataay['withPath']);

        } else {
            $city = City::orderBy($dataay['order_by'], $dataay['how'])->paginate(3);
            $city->withPath("city?order_by={$dataay['order_by']}&how={$dataay['how']}");
        }
        if ($dataay['how'] == 'asc') {
            $dataay['how'] = 'desc';
        } else {
            $dataay['how'] = 'asc';
        }
        $dataay['sorts'] = ['id' => $dataay['how'], 'name' => $dataay['how']];
        $newarray = ['cities' => $city, 'sorts' => $dataay['sorts'], 'searched' => $dataay['searched']];

        return $newarray;
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
