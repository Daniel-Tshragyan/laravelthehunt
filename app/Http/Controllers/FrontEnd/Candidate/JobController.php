<?php

namespace App\Http\Controllers\FrontEnd\Candidate;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Service\JobService;

class JobController extends Controller
{
    public function index(Request $request, JobService $jobService)
    {
        $paginationArguments = $jobService->candidateJobs($request->all());
        return view('frontend.candidate.job.alljobs', ['paginationArguments' => $paginationArguments]);
    }

    public function applyJob(Request $request, $id, JobService $jobService)
    {
        $job = $jobService->apply($id);
        return redirect()->route('show-job', ['id' => $id]);
    }

    public function show(int $id, JobService $jobService)
    {
        $data = $jobService->showCandidateJob($id);

        return view('frontend.candidate.job.show-job', ['data' => $data]);
    }
}
