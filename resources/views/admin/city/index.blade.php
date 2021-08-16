@extends('admin.layouts.app')

@section('content')
    <table class="table table-bordered">
        <thead>
        <tr>
            @foreach($sorts as $key => $val)
                <td>
                    <a style="margin:10px" href="{{ route('user.index',['order_by' => $key, 'how' => $val]) }}">{{$key}}
                    </a>
                </td>
            @endforeach()
            <td>Actions</td>
        </tr>
        <tr>
            <form
                action="{{ route('city.index',['order_by' => Request::get('order_by'), 'how' => Request::get('how')]) }}">
                @csrf
                <td>
                    <input class="form-control" type="number" name="id">
                </td>
                <td>
                    <input class="form-control" type="text" name="name">
                </td>
                <td>
                    <button class="btn btn-success" type="submit">Search</button>
                </td>
            </form>
        </tr>
        </thead>
        <tbody>
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
                    <a title="Show" style="margin:5px" href="{{ route('city.show',['city' => $city]) }}">
                        <i class="far fa-eye"></i>
                    </a>
                    <a title="Update" style="margin:5px" href="{{ route('city.edit',['city' => $city]) }}">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form style="display:inline-block" action="{{ route('city.destroy',['city' => $city]) }}">
                        <button title="Remove" style="border:none;background-color:transparent" type="submit">
                            <i style="color: red" class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    @if(Session::has('message'))
        <p class="text-success">{{ Session::get('message') }}</p>
    @endif
@endsection
