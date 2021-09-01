<?php

namespace App\Http\Controllers\FrontEnd\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\ApplicationService;

class ApplicationController extends Controller
{
    public function index(Request $request, ApplicationService $applicationService)
    {
        $applications = $applicationService->getApplications($request->all(), auth()->user()->company->id);
        return view('frontend.company.applications.index', ['applications' => $applications]);
    }
}
