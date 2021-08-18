@extends('admin.layouts.app')
@section('title')
    Add City
@endsection
@section('content')
    {{ Breadcrumbs::render('cityCreate') }}
    <h1>Add City</h1>
    <form action="{{route('city.store')}}" class="w-50" method="post">
        @csrf
        <input type="text" name="name" placeholder="Name" class="form-control">
        @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
        @endif
        <br>
        <button type="submit" class="btn btn-success">Add</button>
    </form>
@endsection
