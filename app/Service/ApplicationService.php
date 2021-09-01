<?php

namespace App\Service;


use App\DataObjects\ApplicationObject;
use App\Models\Aplication;

class ApplicationService
{

    public function getApplications($data,$id)
    {
        $withPath = '';
        $order_by = 'id';
        $how = 'asc';
        $where = ['company_id' => $id];
        $searched = ['text' => '', 'id' => ''];
        foreach ($searched as $key => $value) {
            if (isset($data[$key]) || isset($data[$key]) && (!is_null($data[$key]) && $data[$key] == 0)) {
                if ($key == 'text') {
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
        if (isset($data["order_by"])) {
            $order_by = $data["order_by"];
        }
        if (isset($data["how"])) {
            $how = $data["how"];
        }
        return $this->getPagination(['withPath' => $withPath, 'order_by' => $order_by, 'searched' => $searched,
            'where' => $where, 'how' => $how]);
    }

    public function getPagination($data)
    {
        if (!empty($data['where'])) {
            $application = Aplication::where($data['where'])->orderBy($data['order_by'], $data['how'])->paginate(3);
            $application->withPath("manage-applications?order_by={$data['order_by']}&how={$data['how']}" . $data['withPath']);
        } else {
            $application = Category::orderBy($data['order_by'], $data['how'])->paginate(3);
            $application->withPath("manage-applications?order_by={$data['order_by']}&how={$data['how']}");
        }
        if ($data['how'] == 'asc') {
            $data['how'] = 'desc';
        } else {
            $data['how'] = 'asc';
        }
        $data['sorts'] = ['id' => $data['how'], 'text' => $data['how']];
        $newarray = ['applications' => $application, 'sorts' => $data['sorts'], 'searched' => $data['searched']];
        return new ApplicationObject($application, $data['sorts'], $data['searched']);
    }

}
