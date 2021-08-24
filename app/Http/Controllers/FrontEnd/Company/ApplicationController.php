<?php

namespace App\Http\Controllers\FrontEnd\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Facades\ApplicationFacade;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $applications = ApplicationFacade::getApplications($request->all(),auth()->user()->company->id);
        return view('frontend.company.applications.index',$applications);
    }
}
