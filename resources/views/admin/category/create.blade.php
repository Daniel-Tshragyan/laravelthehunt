@extends('admin.layouts.app')
@section('title')
    Add Category
@endsection
@section('content')
    {{ Breadcrumbs::render('categoryCreate') }}

    <h1>Add Category</h1>
    <form action="{{route('category.store')}}" class="w-50" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" value="{{ old('title') }}" placeholder="Title" class="form-control">
        <br>
        @if ($errors->has('title'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('title') }}
            </div>
        @endif
        <input type="number" name="sort" value="{{ old('sort') }}" placeholder="Sort" class="form-control">
        <br>
        @if ($errors->has('sort'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('sort') }}
            </div>
        @endif
        <input type="file" name="image" placeholder="Image" class="form-control">
        <br>
        @if ($errors->has('image'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('image') }}
            </div>
        @endif
        <br>
        <button type="submit" class="btn btn-success">Add</button>
    </form>
@endsection
