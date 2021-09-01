<?php

namespace App\Http\Controllers\FrontEnd\Company;

use App\Models\Category;
use App\Models\Job;
use App\Models\Tag;
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

    public function __construct()
    {
        $this->middleware('hasPlan', ['only' => ['store']]);
    }

    public function index(Request $request, JobService $jobService)
    {
        $user = new User();
        $paginationArguments = $jobService->paginationArguments($request->all(), $from = 'front');
        $paginationArguments->categories = Category::all();
        return view('frontend.company.job.index', ['paginationArguments' => $paginationArguments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('frontend.company.job.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobValidation $request, JobService $jobService)
    {
        $jobService->jobFrontFill($request->validated());
        $jobService->changeCategoryJobCount($request->validated()['category_id']);
        Session::flash('message', 'Job Added');
        return redirect()->route('job.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $frontJob)
    {
        $applyed = false;

        foreach ($frontJob->candidates as $candidate) {
            if ($candidate->id == auth()->user()->candidate->id) {
                $applyed = true;
            }
        }
        return view('frontend.company.job.show', ['job' => $frontJob, 'applyed' => $applyed]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $front_job)
    {
        $category = Category::all();
        $price = (int)$front_job->price;
        $tags = Tag::all();
        return view('frontend.company.job.update', ['tags' => $tags, 'job' => $front_job, 'categories' => $category, 'price' => $price]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function update(JobValidation $request, Job $front_job, JobService $jobService)
    {
        $id = $front_job->category_id;
        $jobService->frontJobUpdate($request->validated(), $front_job);
        if ($request->input('category_id') != $id) {
            $jobService->changeCategoryJobCount($id);
            $jobService->changeCategoryJobCount($front_job->category_id);
        }
        Session::flash('message', 'Job Updated');
        return redirect()->route('job.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $front_job, JobService $jobService)
    {
        $jobService->deleteJob($front_job);
        $jobService->changeCategoryJobCount($front_job->category_id);
        Session::flash('message', 'Job Deleted');
        return redirect()->route('job.index');
    }
}
