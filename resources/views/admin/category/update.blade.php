@extends('admin.layouts.app')
@section('title')
    Update Category
@endsection
@section('content')
    {{ Breadcrumbs::render('categoryUpdate',$category) }}
    <h1>Update Category</h1>
    <form action="{{route('category.update',['category' => $category])}}" class="w-50" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <br>
        <label for="">Title</label>
        <input type="text" name="title"  value="{{ $category->title }}" placeholder="Title" class="form-control">
        @if ($errors->has('title'))
            <p class="text-danger">{{ $errors->first('title') }}</p>
        @endif
        <br>
        <label for="">Sort</label>

        <input type="text" name="sort"  value="{{ $category->sort }}" placeholder="Sort" class="form-control">
        @if ($errors->has('sort'))
            <p class="text-danger">{{ $errors->first('sort') }}</p>
        @endif
        <br>
        <label for="">Image</label>

        <input type="file" name="image"  placeholder="Image" class="form-control">
        @if ($errors->has('image'))
            <p class="text-danger">{{ $errors->first('image') }}</p>
        @endif
        <br>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
