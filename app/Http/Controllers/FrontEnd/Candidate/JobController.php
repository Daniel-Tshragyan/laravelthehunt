<?php

namespace App\Http\Controllers\FrontEnd\Candidate;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Facades\JobFacade;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $paginationArguments = JobFacade::candidateJobs($request->all());
        return view('frontend.candidate.job.alljobs', $paginationArguments);
    }

    public function applyJob(Request $request, $id)
    {
        $job = JobFacade::apply($id);
        return redirect()->route('show-job', ['id' => $id]);
    }

    public function show(int $id)
    {
        $data = JobFacade::showCandidateJob($id);

        return view('frontend.candidate.job.show-job',$data);
    }
}
