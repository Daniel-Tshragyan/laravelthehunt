@extends('admin.layouts.app')
@section('title')
    Update Plan
@endsection
@section('content')
    {{ Breadcrumbs::render('planUpdate') }}
    <h1>Update Plan</h1>
    <form action="{{route('plan.update',['plan' => $plan])}}" class="w-50" method="post">
        @csrf
        @method('put')
        <input type="text" value="{{ $plan->title }}" name="title" placeholder="Title" class="form-control">
        <br>
        @if ($errors->has('title'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('title') }}
            </div>
        @endif
        <input type="number" value="{{ $plan->jobs_count }}" name="jobs_count" placeholder="Jobs Count" class="form-control">
        <br>
        @if ($errors->has('jobs_count'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('jobs_count') }}
            </div>
        @endif
        <input type="number" value="{{ $price }}" name="price" placeholder="Jobs Count" class="form-control">
        <br>
        @if ($errors->has('price'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('price') }}
            </div>
        @endif
        <input type="number" value="{{ $plan->expired_days }}" name="expired_days" placeholder="Expayred Days" class="form-control">
        <br>
        @if ($errors->has('expired_days'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('expired_days') }}
            </div>
        @endif
        <br>
        <label for="">Featured Jobs</label>
        <input type="checkbox" name="featured_job"
                @if($plan->featured_job == 1)
                    checked="checked"
                 @endif
               class="form-controll">
        <br>
        <label for="">Jobs Listing</label>
        <input type="checkbox" name="job_listing"
                @if($plan->job_listing == 1)
                    checked="checked"
                 @endif
               class="form-controll">
        <br>
        <label for="">Manage Applications</label>
        <input type="checkbox" name="manage_applications"
                @if($plan->manage_applications == 1)
                    checked="checked"
                 @endif
               class="form-controll">
        <br>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
