<?php

namespace App\Service;


use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Requests\JobValidation;
use App\Http\Requests\AdminJobValidator;

class JobService
{

    public function paginationArguments(Request $request, $from = null)
    {
        $withPath = '';
        $order_by = 'id';
        $how = 'asc';
        $where = [];
        $searched = ['title' => '', 'location' => '', 'id' => '', 'job_tags' => '', 'description' => '',
            'closing_date' => '', 'price' => '', 'url' => '', 'company_id' => '', 'category_id' => '',];

        if ($request->input("order_by")) {
            $order_by = $request->input('order_by');
        }

        if ($request->input("how")) {
            $how = $request->input('how');
        }
        foreach ($searched as $key => $value) {
            if ($request->input($key) || (!is_null($request->input($key)) && $request->input($key) == 0)) {
                if ($key == 'title' || $key == 'location' || $key == 'job_tags' || $key == 'description' || $key == 'url') {
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
        if ($from == 'front') {
            return $this->frontJobGetPagination(['withPath' => $withPath, 'order_by' => $order_by, 'searched' => $searched,
                'where' => $where, 'how' => $how]);
        }else{
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


    public function jobFill(AdminJobValidator $request)
    {
        $job = new Job();
        $job->fill([
            'title' => $request->input('title'),
            'location' => $request->input('location'),
            'job_tags' => $request->input('job_tags'),
            'description' => $request->input('description'),
            'closing_date' => $request->input('closing_date'),
            'price' => $request->input('price'),
            'url' => $request->input('url'),
            'company_id' => $request->input('company_id'),
            'category_id' => $request->input('category_id'),
        ]);
        return $job->save();
    }

    public function frontJobUpdate(JobValidation $request, Job $job)
    {
        $job->fill([
            'title' => $request->input('title'),
            'location' => $request->input('location'),
            'job_tags' => $request->input('job_tags'),
            'description' => $request->input('description'),
            'closing_date' => $request->input('closing_date'),
            'price' => $request->input('price'),
            'url' => $request->input('url'),
            'category_id' => $request->input('category_id'),
        ]);
        return $job->save();
    }

    public function JobUpdate(AdminJobValidator $request, Job $job)
    {
        $job->fill([
            'title' => $request->input('title'),
            'location' => $request->input('location'),
            'job_tags' => $request->input('job_tags'),
            'description' => $request->input('description'),
            'closing_date' => $request->input('closing_date'),
            'price' => $request->input('price'),
            'url' => $request->input('url'),
            'company_id' => $request->input('company_id'),
            'category_id' => $request->input('category_id'),
        ]);
        return $job->save();
    }

    public function jobFrontFill(JobValidation $request)
    {
        $job = new Job();
        $job->fill([
            'title' => $request->input('title'),
            'location' => $request->input('location'),
            'job_tags' => $request->input('job_tags'),
            'description' => $request->input('description'),
            'closing_date' => $request->input('closing_date'),
            'price' => $request->input('price'),
            'url' => $request->input('url'),
            'company_id' => auth()->id(),
            'category_id' => $request->input('category_id'),
        ]);
        return $job->save();
    }


    public function addCategoryCount(Category $category)
    {
        $count = $category->jobs_count;
        $count += 1;
        $category->fill([
            'jobs_count' => $count
        ]);
        return $category->save();
    }

    public function downCategoryCount(Category $category)
    {
        $count = $category->jobs_count;
        $count -= 1;
        $category->fill([
            'jobs_count' => $count
        ]);
        return $category->save();
    }
}

