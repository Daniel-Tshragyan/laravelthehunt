@extends('admin.layouts.app')
@section('title')
   Update City
@endsection
@section('content')
    {{ Breadcrumbs::render('cityUpdate') }}
    <h1>Update City</h1>
    <form action="{{route('city.update',['city' => $city])}}" class="w-50" method="post">
        @csrf
        @method('put')
        <input type="text" name="name"  value="{{ $city->name }}" placeholder="Name" class="form-control">
        @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
        @endif
        <br>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
    @if(Session::has('message'))
        <p class="text-success">{{ Session::get('message') }}</p>
    @endif
@endsection
