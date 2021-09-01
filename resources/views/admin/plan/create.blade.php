@extends('admin.layouts.app')
@section('title')
    Add Plan
@endsection
@section('content')
    {{ Breadcrumbs::render('planCreate') }}
    <h1>Add Plan</h1>
    <form action="{{route('plan.store')}}" class="w-50" method="post">
        @csrf
        <input type="text" value="{{ old('title') }}" name="title" placeholder="Title" class="form-control">
        <br>
        @if ($errors->has('title'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('title') }}
            </div>
        @endif
        <input type="number" value="{{ old('jobs_count') }}" name="jobs_count" placeholder="Jobs Count" class="form-control">
        <br>
        @if ($errors->has('jobs_count'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('jobs_count') }}
            </div>
        @endif
        <input type="number" value="{{ old('price') }}" name="price" placeholder="Price" class="form-control">
        <br>
        @if ($errors->has('price'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('price') }}
            </div>
        @endif
        <input type="number" value="{{ old('expired_days') }}" name="expired_days" placeholder="Expayred Days" class="form-control">
        <br>
        @if ($errors->has('expired_days'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('expired_days') }}
            </div>
        @endif
        <br>
        <label for="">Featured Jobs</label>
        <input type="checkbox" name="featured_job" class="form-controll">
        <br>
        <label for="">Jobs Listing</label>
        <input type="checkbox" name="job_listing" class="form-controll">
        <br>
        <label for="">Manage Applications</label>
        <input type="checkbox" name="manage_applications" class="form-controll">
        <br>
        <button type="submit" class="btn btn-success">Add</button>
    </form>
@endsection
