<?php

namespace App\Service;


use App\Models\Aplication;
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

    public function getPagination($data)
    {
        if (!empty($data['where'])) {
            $jobs = Job::where($data['where'])->orderBy($data['order_by'], $data['how'])->paginate(3);
            $jobs->withPath("job?order_by={$data['order_by']}&how={$data['how']}" . $data['withPath']);

        } else {
            $jobs = Job::orderBy($data['order_by'], $data['how'])->paginate(3);
            $jobs->withPath("job?order_by={$data['order_by']}&how={$data['how']}");
        }
        if ($data['how'] == 'asc') {
            $data['how'] = 'desc';
        } else {
            $data['how'] = 'asc';
        }
        $data['sorts'] = ['id' => $data['how'], 'title' => $data['how'], 'location' => $data['how'], 'job_tags' => $data['how'], 'description' => $data['how'],
            'closing_date' => $data['how'], 'price' => $data['how'], 'url' => $data['how'], 'company_id' => $data['how'], 'category_id' => $data['how'],
        ];
        $newarray = ['jobs' => $jobs, 'sorts' => $data['sorts'], 'searched' => $data['searched']];

        return $newarray;
    }

    public function frontJobGetPagination($data)
    {
        if (!empty($data['where'])) {
            $jobs = Job::where($data['where'])->orderBy($data['order_by'], $data['how'])->paginate(3);
            $jobs->withPath("frontjob?order_by={$data['order_by']}&how={$data['how']}" . $data['withPath']);

        } else {
            $jobs = Job::orderBy($data['order_by'], $data['how'])->paginate(3);
            $jobs->withPath("frontjob?order_by={$data['order_by']}&how={$data['how']}");
        }
        if ($data['how'] == 'asc') {
            $data['how'] = 'desc';
        } else {
            $data['how'] = 'asc';
        }
        $data['sorts'] = ['id' => $data['how'], 'title' => $data['how'], 'location' => $data['how'], 'job_tags' => $data['how'], 'description' => $data['how'],
            'closing_date' => $data['how'], 'price' => $data['how'], 'url' => $data['how'], 'company_id' => $data['how'], 'category_id' => $data['how'],
        ];
        $newarray = ['jobs' => $jobs, 'sorts' => $data['sorts'], 'searched' => $data['searched']];

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

    public function candidateJobs($data)
    {
        $searched = ['city' => '', 'location' => '', 'title' => ''];
        $where = [];
        $withPath = '';
        foreach($searched as $key => $value){
            if(isset($data[$key]) && !is_null($data[$key]) && $key != 'city'){
                $where[] = [$key, 'like', "%{$data[$key]}%"];
                $withPath.="&{$key}={$data[$key]}";
                $searched[$key] = $data[$key];
            }
        }
        if (isset($data['city'])) {
            $jobs = Job::whereHas('user',function($u) use ($data){
                $u->whereHas('company',function($c) use ($data){
                    $c->where('city_id','=',$data['city']);
                });
            })->where($where)->paginate('3');
            $withPath.="&city={$data['city']}";
            $jobs->withPath('browse-jobs?'.$withPath);
            $searched['city'] = $data['city'];
        }else{
            $jobs = Job::where($where)->paginate('3');
            $jobs->withPath('browse-jobs?'.$withPath);
        }
        return ['jobs' => $jobs, 'searched' => $searched];
    }

    public function apply(int $id)
    {
        $job = Job::find($id);
        $job->candidate()->attach(auth()->user()->candidate->id);
        $application = new Aplication();
        $application->fill([
            'company_id' => $job->user->company->id,
            'text' => "User ".auth()->user()->name." appliyed to {$job->title} Job",
        ]);
        $application->save();
        return $job;
    }
}
