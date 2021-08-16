@extends('admin.layouts.app')

@section('content')
    <h1>Update City</h1>
    <form action="{{route('city.update',['city' => $city])}}" class="w-50" method="post">
        @csrf
        @method('put')
        <input type="text" name="name" value="{{ $city->name }}" placeholder="Name" class="form-control">
        @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
        @endif
        <br>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
@endsection
