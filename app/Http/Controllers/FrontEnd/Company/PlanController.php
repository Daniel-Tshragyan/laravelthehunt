<?php

namespace App\Http\Controllers\FrontEnd\Company;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Service\PlanService;
use App\Http\Requests\FrontPlanValidator;
use Illuminate\Support\Facades\Session;

class PlanController extends Controller
{
    public function index(Request $request, PlanService $planService)
    {
        $paginationArguments = $planService->paginationArguments($request->all());
        return view('frontend.company.plan.all-plans', ['paginationArguments' => $paginationArguments]);
    }

    public function apply(FrontPlanValidator $request, PlanService $planService)
    {
        $planService->apply($request->validated()['id']);
        Session::flash('message', 'Plan Updated');
        return redirect()->route('pricing');
    }
}
