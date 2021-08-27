<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class HasPlan
{
    CONST ROLE_ADMIN = 0;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user() && auth()->user()->role != self::ROLE_ADMIN){
            if(!is_null(auth()->user()->company->plan)){

                if(auth()->user()->company->plan->jobs_count <= auth()->user()->job->count()){
                    Session::flash('message', "The number of jobs provided by this plan is completed. Please update the plan");
                    return redirect()->route('front-job.create');
                }
            }else{
                Session::flash('message', "You dont have a plan. Pleas get one");
                return redirect()->route('front-job.create');
            }
        }else{
            $user = User::find($request->input('company_id'));
            if(!is_null($user->company->plan)){
                if($user->company->plan->jobs_count <= $user->job->count()){
                    Session::flash('message', "The number of jobs provided by this plan is completed. Please update the plan");
                    return redirect()->route('job.create');
                }
            }else{
                Session::flash('message', "This user dont have a plan. Pleas get one");
                return redirect()->route('job.create');
            }

        }
        return $next($request);

    }
}
