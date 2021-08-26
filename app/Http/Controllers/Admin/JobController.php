<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use App\Models\Tag;
use App\Models\User;
use App\Facades\JobFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AdminJobValidator;

class JobController extends Controller
{
    const companyRole = 2;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = new User();
        $paginationArguments = JobFacade::paginationArguments($request->all());
        $paginationArguments['categories'] = Category::all();
        $paginationArguments['companies'] = $user->where(['role' => self::companyRole])->get();
        return view('admin.job.index', $paginationArguments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = User::where(['role' => self::companyRole])->get();
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.job.create', compact('categories', 'companies', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminJobValidator $request)
    {
        JobFacade::jobFill($request->all());
        JobFacade::changeCategoryJobCount($request->validated()['category_id']);
        Session::flash('message', 'Job Added');
        return redirect()->route('job.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        return view('admin.job.show', ['job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        $user = new User();
        $companies = $user->where(['role' => '2'])->get();
        $price = (int)$job->price;
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.job.update', compact('tags','companies', 'price', 'categories', 'job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function update(AdminJobValidator $request, Job $job)
    {
        $id = $job->category_id;
        JobFacade::jobUpdate($request->validated(), $job);
        if ($request->input('category_id') != $id) {
            JobFacade::changeCategoryJobCount($id);
            JobFacade::changeCategoryJobCount($job->category_id);
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
    public function destroy(Job $job)
    {
        JobFacade::deleteJob($job);
        JobFacade::changeCategoryJobCount($job->category_id);
        Session::flash('message', 'Job Deleted');
        return redirect()->route('job.index');
    }
}
