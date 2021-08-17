<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = new User();
        $companies = $user->where(['role' => '2'])->get();
        $categories = Category::all();
        $withPath = '';
        $order_by = 'id';
        $how = 'asc';
        $where = [];
        $searched = [
            'title' => '',
            'location' => '',
            'id' => '',
            'job_tags' => '',
            'description' => '',
            'closing_date' => '',
            'price' => '',
            'url' => '',
            'company_id' => '',
            'category_id' => '',
        ];
        if ($request->input("order_by")) {
            $order_by = $request->input('order_by');
        }

        if ($request->input("how")) {
            $how = $request->input('how');
        }

        foreach ($searched as $key => $value) {
            if ($request->input($key) || (!is_null($request->input($key)) && $request->input($key) == 0)) {
                if($key == 'company_id' || $key == 'category_id' )
                {
                    if($request->input($key) != 'a'){
                        $where[] = [$key, '=', "{$request->input($key)}"];
                        $withPath .= "&{$key}={$request->input($key)}";
                        $searched[$key] = $request->input($key);
                    }
                }
                else{
                    if ($key == 'title' || $key == 'location' ||
                        $key == 'job_tags' || $key == 'description'
                        || $key == 'url') {
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
        }

        if (!empty($where)) {
            $jobs = Job::where($where)->orderBy($order_by, $how)->paginate(3);
            $jobs->withPath("user?order_by={$order_by}&how={$how}" . $withPath);

        } else {
            $jobs = Job::orderBy($order_by, $how)->paginate(3);
            $jobs->withPath("user?order_by={$order_by}&how={$how}");
        }

        if ($how == 'asc') {
            $how = 'desc';
        } else {
            $how = 'asc';
        }
        $sorts = ['id' => $how,
            'title' => $how,
            'location' => $how,
            'job_tags' => $how,
            'description' => $how,
            'closing_date' => $how,
            'price' => $how,
            'url' => $how,
            'company_id' => $how,
            'category_id' => $how,
        ];

//        dd($sorts);

        return view('admin.job.index', ['companies' => $companies, 'categories' => $categories, 'searched' => $searched, 'jobs' => $jobs, 'sorts' => $sorts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $companies = $user->where(['role' => '2'])->get();
        $categories = Category::all();
        return view('admin.job.create', ['categories' => $categories, 'companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => ['required', 'string'],
                'location' => ['required', 'string'],
                'job_tags' => ['required', 'string'],
                'description' => ['required', 'string'],
                'closing_date' => ['required', 'date'],
                'price' => ['required', 'numeric'],
                'url' => ['required', 'string'],
                'company_id' => ['required', 'exists:App\Models\Company,user_id'],
                'category_id' => ['required', 'exists:App\Models\Category,id'],
            ]
        );

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
        $job->save();
        $category = Category::find($request->input('category_id'));
        $count = $category->jobs_count;
        $count += 1;
        $category->fill([
            'jobs_count' => $count
        ]);
        $category->save();
        Session::flash('message', 'Job Added');
        return redirect('admin/job');

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
        $categories = Category::all();
        return view('admin.job.update', ['job' => $job,'companies' => $companies, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $request->validate(
            [
                'title' => ['required', 'string'],
                'location' => ['required', 'string'],
                'job_tags' => ['required', 'string'],
                'description' => ['required', 'string'],
                'closing_date' => ['required', 'date'],
                'price' => ['required', 'numeric'],
                'url' => ['required', 'string'],
                'company_id' => ['required', 'exists:App\Models\User,id'],
                'category_id' => ['required', 'exists:App\Models\Category,id'],
            ]
        );
        if ($request->input('category_id') != $job->category_id) {
            $category = Category::find($job->category_id);
            $count = $category->jobs_count;
            $count -= 1;
            $category->fill([
                'jobs_count' => $count
            ]);
            $category->save();
            $category1 = Category::find($request->input('category_id'));
            $count1 = $category1->jobs_count;
            $count1 += 1;
            $category1->fill([
                'jobs_count' => $count1
            ]);
            $category1->save();
        }
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
        $job->save();

        Session::flash('message', 'Job Updated');
        return redirect('admin/job');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $job->delete();
        $category = Category::find($job->id);
        $count = $category->jobs_count;
        $count -= 1;
        $category->fill([
            'jobs_count' => $count
        ]);
        $category->save();
        Session::flash('message', 'Job Deleted');
        return redirect('admin/job');
    }
}
