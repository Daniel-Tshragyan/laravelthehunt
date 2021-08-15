@extends('adminlte::page')

@section('content')
    <h1>{{$city->name}}</h1>
    <h2>Created At : {{ $city->created_at }}</h2>
    <h2>Updated At : {{ $city->updated_at }}</h2>
@endsection
