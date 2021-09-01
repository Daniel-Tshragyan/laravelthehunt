<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Requests\PlanValidation;
use App\Service\PlanService;
use Illuminate\Support\Facades\Session;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PlanService $planService)
    {
        $paginationArguments = $planService->paginationArguments($request->all());
        return view('admin.plan.index', ['paginationArguments' => $paginationArguments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanValidation $request, PlanService $planService)
    {
        $planService->fillPlan($request->validated());
        Session::flash('message', 'Plan Added');
        return redirect()->route('plan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Plan $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return view('admin.plan.show', ['plan' => $plan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Plan $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        $price = (int)$plan->price;
        return view('admin.plan.update', ['plan' => $plan, 'price' => $price]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Plan $plan
     * @return \Illuminate\Http\Response
     */
    public function update(PlanValidation $request, Plan $plan, PlanService $planService)
    {
        $planService->updatePlan($request->validated(), $plan);
        Session::flash('message', 'Plan Updated');
        return redirect()->route('plan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Plan $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan, PlanService $planService)
    {
        $planService->deletePlan($plan);
        Session::flash('message', 'Plan Deleted');
        return redirect()->route('plan.index');
    }
}
