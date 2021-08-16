@extends('admin.layouts.app')

@section('content')
    <table class="table table-bordered">
        <tr>
            <td>Id</td>
            <td>Name</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
        @foreach($cities as $city)
            <tr>
                <td>
                    {{ $city->id }}
                </td>
                <td>
                    <a href="{{ route('city.show',['city' =>$city]) }}">
                        {{ $city->name }}
                    </a>
                </td>
                <td>
                    <button class="btn btn-success">
                        <a style="color:white!important" href="{{route('city.edit',['city' => $city])}}">Change</a>
                    </button>
                </td>
                <td>
                    <form action="{{ route('city.destroy',['city' => $city]) }}">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    @if(Session::has('message'))
        <p class="text-success">{{ Session::get('message') }}</p>
    @endif
@endsection
