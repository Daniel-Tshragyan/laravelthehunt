@extends('admin.layouts.app')
@section('title')
    Add Job
@endsection
@section('content')
    {{ Breadcrumbs::render('jobCreate') }}
    <h1>Add Job</h1>
    <form action="{{route('job.store')}}" class="w-50" method="post">
        @csrf
        <input type="text" value="{{ old('title') }}" name="title" placeholder="Title" class="form-control">
        <br>
        @if ($errors->has('title'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('title') }}
            </div>
        @endif
        <input type="text" value="{{ old('description') }}" name="description" placeholder="Description" class="form-control">
        <br>
        @if ($errors->has('description'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('description') }}
            </div>
        @endif
        <input type="date" value="{{ old('closing_date') }}" name="closing_date" placeholder="Cloasing Date" class="form-control">
        <br>
        @if ($errors->has('closing_date'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('closing_date') }}
            </div>
        @endif

        <input type="text" value="{{ old('job_tags') }}" name="job_tags" placeholder="Job Tags" class="form-control">
        <br>
        @if ($errors->has('job_tags'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('job_tags') }}
            </div>
        @endif
        <input type="text" value="{{ old('location') }}" name="location" placeholder="Location" class="form-control">
        <br>
        @if ($errors->has('location'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('location') }}
            </div>
        @endif
        <input type="number" value="{{ old('price') }}" name="price" placeholder="Price" class="form-control">
        <br>
        @if ($errors->has('price'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('price') }}
            </div>
        @endif
        <input type="text" value="{{ old('url') }}" name="url" placeholder="Aplication Url" class="form-control">
        <br>
        @if ($errors->has('url'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('url') }}
            </div>
        @endif
        <br>
        <label for="">Company </label>
        <select name="company_id" id="" class="form-control">
            @foreach( $companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
        </select>
        <br>
        @if ($errors->has('company_id'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('company_id') }}
            </div>
        @endif
        <label for="">Category </label>
        <select name="category_id" id="" class="form-control">
            @foreach( $categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>
        <br>
        @if ($errors->has('category_id'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('category_id') }}
            </div>
        @endif
        <br>
        <button type="submit" class="btn btn-success">Add</button>
    </form>
@endsection
