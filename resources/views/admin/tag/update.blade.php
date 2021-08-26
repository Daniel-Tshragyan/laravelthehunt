@extends('admin.layouts.app')
@section('title')
    Update Tag
@endsection
@section('content')
    {{ Breadcrumbs::render('tagUpdate') }}
    <h1>Update Tag</h1>
    <form action="{{route('tag.update',['tag' => $tag])}}" class="w-50" method="post">
        @csrf
        @method('put')
        <label for="">
            Title
        </label>
        <input type="text" name="title" value="{{ $tag->title }}" placeholder="Title" class="form-control">
        <br>
        @if ($errors->has('title'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('title') }}
            </div>
        @endif
        <br>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
