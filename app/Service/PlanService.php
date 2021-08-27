<?php

namespace App\Service;

use App\Models\Plan;
use App\Models\User;

class PlanService
{
    public function paginationArguments($data)
    {
        $order_by = 'id';
        $how = 'asc';
        $where = [];
        $withPath = '';
        $searched = [
            'title' => '',
            'jobs_count' => '',
            'id' => '',
            'price' => '',
            'featured_job' => '',
            'expired_days' => '',
            'job_listing' => '',
            'manage_applications' => '',
        ];

        if (isset($data['order_by'])) {
            $order_by = $data['order_by'];
        }

        if (isset($data['how'])) {
            $how = $data['how'];
        }
        foreach ($searched as $key => $value) {
            if (isset($data[$key]) || isset($data[$key]) && (!is_null($data[$key]) && $data[$key] == 0)) {
                if ($key == 'title') {
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
            $plans = Plan::where($data['where'])->orderBy($data['order_by'], $data['how'])->paginate(3);
            $plans->withPath("plan?order_by={$data['order_by']}&how={$data['how']}" . $data['withPath']);

        } else {
            $plans = Plan::orderBy($data['order_by'], $data['how'])->paginate(3);
            $plans->withPath("plan?order_by={$data['order_by']}&how={$data['how']}");
        }
        if ($data['how'] == 'asc') {
            $data['how'] = 'desc';
        } else {
            $data['how'] = 'asc';
        }
        $data['sorts'] = ['id' => $data['how'], 'title' => $data['how'], 'jobs_count' => $data['how'],
            'expired_days' => $data['how'], 'price' => $data['how'], 'featured_job' => $data['how'], 'job_listing' => $data['how'],
            'manage_applications' => $data['how']];
        $newarray = ['plans' => $plans, 'sorts' => $data['sorts'], 'searched' => $data['searched']];

        return $newarray;
    }

    public function fillPlan($data)
    {
        foreach ($data as $key => $value) {
            if ($value == 'on') {
                $data[$key] = 1;
            }
        }

        $plan = new Plan();
        $plan->fill($data);
        return $plan->save();
    }

    public function deletePlan(Plan $plan)
    {
        return $plan->delete();
    }

    public function updatePlan($data, Plan $plan)
    {
        foreach ($data as $key => $value) {
            if ($value == 'on') {
                $data[$key] = 1;
            }
        }
        $plan->fill($data);
        return $plan->update();
    }

    public function apply($id)
    {
        $user = User::find(auth()->user()->id);
        $user->company->fill(['plan_id' => $id]);
        return $user->company->save();
    }
}
