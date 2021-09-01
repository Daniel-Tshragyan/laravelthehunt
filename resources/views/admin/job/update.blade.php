@extends('admin.layouts.app')
@section('title')
    Update Job
@endsection
@section('content')
    {{ Breadcrumbs::render('jobUpdate',$admin_job) }}
    <h1>Update Job</h1>
    <form action="{{route('admin-job.update',['admin_job' => $admin_job])}}" class="w-50" method="post">
        @csrf
        @method('put')
        <label for="">
            Title
        </label>
        <input type="text" name="title" value="{{ $admin_job->title }}" placeholder="Title" class="form-control">
        <br>
        @if ($errors->has('title'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('title') }}
            </div>
        @endif
        <label for="">
            description
        </label>
        <input type="text" name="description" value="{{ $admin_job->description }}" placeholder="Description" class="form-control">
        <br>
        @if ($errors->has('description'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('description') }}
            </div>
        @endif
        <label for="">
            Cloasing Date
        </label>
        <input type="date" name="closing_date" value="{{ $admin_job->closing_date }}" placeholder="Cloasing Date" class="form-control">
        <br>
        @if ($errors->has('closing_date'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('closing_date') }}
            </div>
        @endif
        <label for="">
            Job Tags
        </label>
        <select class="tags1 form-control" name="job_tags[]" multiple="multiple">
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}"
                @if(in_array($tag->id, $admin_job->tags->pluck('id')->toArray()))
                    selected="selected"
                @endif
                >{{ $tag->title }}</option>
            @endforeach
        </select>
        <br>

        @if ($errors->has('job_tags'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('job_tags') }}
            </div>
        @endif
        <label for="">
            Location
        </label>
        <input type="text" name="location" value="{{ $admin_job->location }}" placeholder="Location" class="form-control">
        <br>

        @if ($errors->has('location'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('location') }}
            </div>
        @endif
        <label for="">
            Price
        </label>
        <input type="number" name="price" value="{{ $price }}" placeholder="Price" class="form-control">
        <br>

        @if ($errors->has('price'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('price') }}
            </div>
        @endif
        <label for="">
            Aplication Url
        </label>
        <input type="text" name="url" value="{{ $admin_job->url }}" placeholder="Aplication Url" class="form-control">
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
                <option value="{{ $company->id }}"
                        @if($company->id == $admin_job->company_id)
                        selected="selected"
                    @endif
                >{{ $company->name }}</option>
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
                <option value="{{ $category->id }}"
                        @if($category->id == $admin_job->category_id)
                        selected="selected"
                    @endif
                >{{ $category->title }}</option>
            @endforeach
        </select>
        <br>

        @if ($errors->has('category_id'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('category_id') }}
            </div>
        @endif
        <br>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
