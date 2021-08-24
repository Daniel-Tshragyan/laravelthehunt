<?php

namespace App\Http\Controllers\FrontEnd\Candidate;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use App\Facades\JobFacade;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $paginationArguments = JobFacade::candidateJobs($request->all());
        $paginationArguments['cities'] = City::all();
        $paginationArguments['applyed'] = false;
        return view('frontend.candidate.job.alljobs', $paginationArguments);
    }

    public function applyJob(Request $request, $id)
    {
        $job = JobFacade::apply($id);
        return redirect()->route('frontjob.show', ['frontjob' => $job]);
    }
}
