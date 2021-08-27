@extends('frontend.company.layouts.app')
@section('content1')
    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="row pricing-tables " style="display:flex;justify-content:space-between">
    @foreach($plans as $plan)
            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="pricing-table border-color-defult">
                    <div class="pricing-details">
                        <div class="icon">
                            <i class="lni-rocket"></i>
                        </div>
                        <h2>{{ $plan->title }}</h2>
                        <ul>
                            <li>Post {{ $plan->jobs_count }} Job</li>
                            <li>Featured Job
                                @if($plan->featured_job == 1)
                                    <span style="margin-right:-20px;font-size:20px;color:green">&#9756;</span>
                                @endif
                            </li>
                            <li>Edit Your Job Listing
                                @if($plan->job_listing == 1)
                                    <span style="margin-right:-20px;font-size:20px;color:green">&#9756;</span>
                                @endif
                            </li>
                            <li>Manage Application
                                @if($plan->manage_applications == 1)
                                    <span style="margin-right:-20px;font-size:20px;color:green">&#9756;</span>
                                @endif
                            </li>
                            <li>{{ $plan->expired_days }}-day Expired</li>
                        </ul>
                        <div class="price"><span>$</span>{{ $plan->price }}<span>/Month</span></div>
                    </div>
                    <div class="plan-button">
                        @if($plan->id != auth()->user()->company->plan_id)
                            <form action="{{ route('pricing-apply') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $plan->id }}" name="id">
                                <button class="btn btn-success">
                                    Get Started
                                </button>
                            </form>
                        @else
                            <p class="text-primary">Your Plan</p>
                        @endif

                    </div>
                </div>
            </div>
    @endforeach
    </div>
    {{ $plans->links() }}


@endsection
