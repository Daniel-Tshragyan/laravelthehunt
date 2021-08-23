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

    public function paginationArguments($data, $from = null)
    {
        $withPath = '';
        $order_by = 'id';
        $how = 'asc';
        $where = [];
        $searched = ['title' => '', 'location' => '', 'id' => '', 'job_tags' => '', 'description' => '',
            'closing_date' => '', 'price' => '', 'url' => '', 'company_id' => '', 'category_id' => '',];

        if (isset($data["order_by"])) {
            $order_by = $data["order_by"];
        }

        if (isset($data["how"])) {
            $how = $data['how'];
        }
        foreach ($searched as $key => $value) {
            if (isset($data[$key]) || isset($data[$key]) && (!is_null($data[$key]) && $data[$key] == 0)) {
                if ($key == 'title' || $key == 'location' || $key == 'job_tags' || $key == 'description' || $key == 'url') {
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
        if ($from == 'front') {
            return $this->frontJobGetPagination(['withPath' => $withPath, 'order_by' => $order_by, 'searched' => $searched,
                'where' => $where, 'how' => $how]);
        } else {
            return $this->getPagination(['withPath' => $withPath, 'order_by' => $order_by, 'searched' => $searched,
                'where' => $where, 'how' => $how]);
        }

    }

    public function getPagination($dataay)
    {
        if (!empty($dataay['where'])) {
            $jobs = Job::where($dataay['where'])->orderBy($dataay['order_by'], $dataay['how'])->paginate(3);
            $jobs->withPath("job?order_by={$dataay['order_by']}&how={$dataay['how']}" . $dataay['withPath']);

        } else {
            $jobs = Job::orderBy($dataay['order_by'], $dataay['how'])->paginate(3);
            $jobs->withPath("job?order_by={$dataay['order_by']}&how={$dataay['how']}");
        }
        if ($dataay['how'] == 'asc') {
            $dataay['how'] = 'desc';
        } else {
            $dataay['how'] = 'asc';
        }
        $dataay['sorts'] = ['id' => $dataay['how'], 'title' => $dataay['how'], 'location' => $dataay['how'], 'job_tags' => $dataay['how'], 'description' => $dataay['how'],
            'closing_date' => $dataay['how'], 'price' => $dataay['how'], 'url' => $dataay['how'], 'company_id' => $dataay['how'], 'category_id' => $dataay['how'],
        ];
        $newarray = ['jobs' => $jobs, 'sorts' => $dataay['sorts'], 'searched' => $dataay['searched']];

        return $newarray;
    }

    public function frontJobGetPagination($dataay)
    {
        if (!empty($dataay['where'])) {
            $jobs = Job::where($dataay['where'])->orderBy($dataay['order_by'], $dataay['how'])->paginate(3);
            $jobs->withPath("frontjob?order_by={$dataay['order_by']}&how={$dataay['how']}" . $dataay['withPath']);

        } else {
            $jobs = Job::orderBy($dataay['order_by'], $dataay['how'])->paginate(3);
            $jobs->withPath("frontjob?order_by={$dataay['order_by']}&how={$dataay['how']}");
        }
        if ($dataay['how'] == 'asc') {
            $dataay['how'] = 'desc';
        } else {
            $dataay['how'] = 'asc';
        }
        $dataay['sorts'] = ['id' => $dataay['how'], 'title' => $dataay['how'], 'location' => $dataay['how'], 'job_tags' => $dataay['how'], 'description' => $dataay['how'],
            'closing_date' => $dataay['how'], 'price' => $dataay['how'], 'url' => $dataay['how'], 'company_id' => $dataay['how'], 'category_id' => $dataay['how'],
        ];
        $newarray = ['jobs' => $jobs, 'sorts' => $dataay['sorts'], 'searched' => $dataay['searched']];

        return $newarray;
    }

    public function deleteJob(Job $job)
    {
        return $job->delete();
    }

    public function jobFill($data)
    {
        $job = new Job();
        $job->fill($data);
        return $job->save();
    }

    public function frontJobUpdate($data, Job $job)
    {
        $job->fill($data);
        return $job->update();
    }

    public function JobUpdate($data, Job $job)
    {
        $job->fill($data);
        return $job->update();
    }

    public function jobFrontFill($data)
    {
        $data['company_id'] = auth()->user()->id;
        $job = new Job();
        $job->fill($data);
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
