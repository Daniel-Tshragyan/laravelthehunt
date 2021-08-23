<?php

namespace App\Service;


use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Requests\JobValidation;
use App\Http\Requests\AdminJobValidator;
use function PHPUnit\Framework\isNull;

class JobService
{

    public function paginationArguments($arr, $from = null)
    {
        $withPath = '';
        $order_by = 'id';
        $how = 'asc';
        $where = [];
        $searched = ['title' => '', 'location' => '', 'id' => '', 'job_tags' => '', 'description' => '',
            'closing_date' => '', 'price' => '', 'url' => '', 'company_id' => '', 'category_id' => '',];

        if (isset($arr["order_by"])) {
            $order_by = $arr["order_by"];
        }

        if (isset($arr["how"])) {
            $how = $arr['how'];
        }
        foreach ($searched as $key => $value) {
            if (isset($arr[$key]) || isset($arr[$key]) && (!is_null($arr[$key]) && $arr[$key] == 0)) {
                if ($key == 'title' || $key == 'location' || $key == 'job_tags' || $key == 'description' || $key == 'url') {
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
        if ($from == 'front') {
            return $this->frontJobGetPagination(['withPath' => $withPath, 'order_by' => $order_by, 'searched' => $searched,
                'where' => $where, 'how' => $how]);
        } else {
            return $this->getPagination(['withPath' => $withPath, 'order_by' => $order_by, 'searched' => $searched,
                'where' => $where, 'how' => $how]);
        }

    }

    public function getPagination($array)
    {
        if (!empty($array['where'])) {
            $jobs = Job::where($array['where'])->orderBy($array['order_by'], $array['how'])->paginate(3);
            $jobs->withPath("job?order_by={$array['order_by']}&how={$array['how']}" . $array['withPath']);

        } else {
            $jobs = Job::orderBy($array['order_by'], $array['how'])->paginate(3);
            $jobs->withPath("job?order_by={$array['order_by']}&how={$array['how']}");
        }
        if ($array['how'] == 'asc') {
            $array['how'] = 'desc';
        } else {
            $array['how'] = 'asc';
        }
        $array['sorts'] = ['id' => $array['how'], 'title' => $array['how'], 'location' => $array['how'], 'job_tags' => $array['how'], 'description' => $array['how'],
            'closing_date' => $array['how'], 'price' => $array['how'], 'url' => $array['how'], 'company_id' => $array['how'], 'category_id' => $array['how'],
        ];
        $newarray = ['jobs' => $jobs, 'sorts' => $array['sorts'], 'searched' => $array['searched']];

        return $newarray;
    }

    public function frontJobGetPagination($array)
    {
        if (!empty($array['where'])) {
            $jobs = Job::where($array['where'])->orderBy($array['order_by'], $array['how'])->paginate(3);
            $jobs->withPath("frontjob?order_by={$array['order_by']}&how={$array['how']}" . $array['withPath']);

        } else {
            $jobs = Job::orderBy($array['order_by'], $array['how'])->paginate(3);
            $jobs->withPath("frontjob?order_by={$array['order_by']}&how={$array['how']}");
        }
        if ($array['how'] == 'asc') {
            $array['how'] = 'desc';
        } else {
            $array['how'] = 'asc';
        }
        $array['sorts'] = ['id' => $array['how'], 'title' => $array['how'], 'location' => $array['how'], 'job_tags' => $array['how'], 'description' => $array['how'],
            'closing_date' => $array['how'], 'price' => $array['how'], 'url' => $array['how'], 'company_id' => $array['how'], 'category_id' => $array['how'],
        ];
        $newarray = ['jobs' => $jobs, 'sorts' => $array['sorts'], 'searched' => $array['searched']];

        return $newarray;
    }

    public function deleteJob(Job $job)
    {
        return $job->delete();
    }

    public function jobFill($arr)
    {
        $job = new Job();
        $job->fill($arr);
        return $job->save();
    }

    public function frontJobUpdate($arr, Job $job)
    {
        $job->fill($arr);
        return $job->update();
    }

    public function JobUpdate($arr, Job $job)
    {
        $job->fill($arr);
        return $job->update();
    }

    public function jobFrontFill($arr)
    {
        $arr['company_id'] = auth()->user()->id;
        $job = new Job();
        $job->fill($arr);
        return $job->save();
    }

    public function changeCategoryJobCount($id)
    {
        $category = Category::find($id);
        if (!is_null($category)) {
            $category->fill([
                'jobs_count' => $category->job->count()
            ]);
            return $category->update();
        }
        return true;
    }
}
