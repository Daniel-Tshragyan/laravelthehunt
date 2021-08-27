<?php

namespace App\Http\Controllers\FrontEnd\Company;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Facades\PlanFacade;
use App\Http\Requests\FrontPlanValidator;
use Illuminate\Support\Facades\Session;

class PlanController extends Controller
{
    public function index(Request $request)
    {
        $paginationArguments = PlanFacade::paginationArguments($request->all());
        return view('frontend.company.plan.all-plans', $paginationArguments);
    }

    public function apply(FrontPlanValidator $request)
    {
        PlanFacade::apply($request->validated()['id']);
        Session::flash('message', 'Plan Updated');
        return redirect()->route('pricing');
    }
}
