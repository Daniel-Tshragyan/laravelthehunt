<?php

namespace App\Http\Controllers\FrontEnd\Company;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,JobService $jobService)
    {
        $user = new User();
        $paginationArguments = $jobService->paginationArguments($request->all(),$from = 'front');
        $paginationArguments['categories'] = Category::all();
        return view('frontend.company.job.index', $paginationArguments);
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
        $jobService->jobFrontFill($request->validated());
        $jobService->changeCategoryJobCount($request->validated()['category_id']);
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
        $id = $frontjob->category_id;
        $jobService->frontJobUpdate($request->validated(), $frontjob);
        if ($request->input('category_id') != $id) {
            $jobService->changeCategoryJobCount($id);
            $jobService->changeCategoryJobCount($frontjob->category_id);
        }
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
        $jobService->deleteJob($frontjob);
        $jobService->changeCategoryJobCount($frontjob->category_id);
        Session::flash('message', 'Job Deleted');
        return redirect()->route('frontjob.index');
    }
}
