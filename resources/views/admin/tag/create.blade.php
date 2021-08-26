@extends('admin.layouts.app')
@section('title')
    Add Tag
@endsection
@section('content')
    {{ Breadcrumbs::render('tagCreate') }}
    <h1>Add Job</h1>
    <form action="{{route('tag.store')}}" class="w-50" method="post">
        @csrf
        <input type="text" value="{{ old('title') }}" name="title" placeholder="Title" class="form-control">
        <br>
        @if ($errors->has('title'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('title') }}
            </div>
        @endif
        <br>
        <button type="submit" class="btn btn-success">Add</button>
    </form>
@endsection
