<?php

namespace App\Service;


use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Requests\JobValidation;
use App\Http\Requests\AdminJobValidator;

class JobService
{

    public function paginationArguments(Request $request)
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
        return [ 'withPath' => $withPath,'order_by' => $order_by,'searched' =>$searched,
            'where' => $where,'how' => $how ];
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
            'company_id' =>auth()->id(),
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

