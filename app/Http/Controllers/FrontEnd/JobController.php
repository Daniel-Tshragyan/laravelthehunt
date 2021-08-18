<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Category;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobValidation;
use App\Service\JobService;
use Illuminate\Support\Facades\Session;

class JobController extends Controller
{
//    auth()->id()
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,JobService $jobService)
    {
        $categories = Category::all();
        $paginationArguments = $jobService->paginationArguments($request);
        $withPath = $paginationArguments['withPath'];
        $order_by = $paginationArguments['order_by'];
        $how = $paginationArguments['how'];
        $where = $paginationArguments['where'];
        $where['company_id'] = auth()->id();
        $searched = $paginationArguments['searched'];
        if (!empty($where)) {
            $jobs = Job::where($where)->orderBy($order_by, $how)->paginate(3);
            $jobs->withPath("frontjob?order_by={$order_by}&how={$how}" . $withPath);
        } else {
            $jobs = Job::orderBy($order_by, $how)->paginate(3);
            $jobs->withPath("frontjob?order_by={$order_by}&how={$how}");
        }
        if ($how == 'asc') {
            $how = 'desc';
        } else {
            $how = 'asc';
        }
        $sorts = ['id' => $how, 'title' => $how, 'location' => $how, 'job_tags' => $how, 'description' => $how,
            'closing_date' => $how, 'price' => $how, 'url' => $how, 'company_id' => $how, 'category_id' => $how,
        ];
        return view('frontend.company.job.index', ['categories' => $categories, 'searched' => $searched, 'jobs' => $jobs, 'sorts' => $sorts]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('frontend.company.job.create',['categories' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobValidation $request,JobService $jobService)
    {
        $jobService->jobFrontFill($request);
        $category = Category::find($request->input('category_id'));
        $jobService->addCategoryCount($category);
        Session::flash('message', 'Job Updated');
        return redirect()->route('frontjob.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $frontjob)
    {
        return view('frontend.company.job.show',['job' => $frontjob]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $frontjob)
    {
        $category = Category::all();
        $price = (int)$frontjob->price;
        return view('frontend.company.job.update',['job' => $frontjob, 'categories' => $category,'price' =>$price]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(JobValidation $request, Job $frontjob, JobService $jobService)
    {
        if ($request->input('category_id') != $frontjob->category_id) {
            $category = Category::find($frontjob->category_id);
            $jobService->downCategoryCount($category);
            $category1 = Category::find($request->input('category_id'));
            $jobService->addCategoryCount($category1);
        }
        $jobService->frontJobUpdate($request, $frontjob);
        Session::flash('message', 'Job Updated');
        return redirect()->route('frontjob.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $frontjob, JobService $jobService)
    {
        $category = Category::find($frontjob->category_id);
        $jobService->downCategoryCount( $category);
        $frontjob->delete();
        Session::flash('message', 'Job Deleted');
        return redirect()->route('frontjob.index');

    }
}
