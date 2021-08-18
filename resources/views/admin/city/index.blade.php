@extends('admin.layouts.app')
@section('title')
    All Cities
@endsection
@section('content')

    {{ Breadcrumbs::render('city') }}
    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <h1>All Cities</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            @foreach($sorts as $key => $val)
                <td>
                    <a style="margin:10px" href="{{ route('city.index',['order_by' => $key, 'how' => $val]) }}">{{$key}}
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
                    <input class="form-control" value="{{ $searched['id'] }}" type="number" name="id">
                </td>
                <td>
                    <input class="form-control" value="{{ $searched['name'] }}" type="text" name="name">
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
                    <form style="display:inline-block" action="{{ route('city.destroy',['city' => $city]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button title="Remove" style="border:none;background-color:transparent" type="submit">
                            <i style="color: red" class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

    {{ $cities->links() }}
    <br>

    <a href="{{ route('city.create') }}">
        <button class="btn btn-success">
            Create New
        </button>
    </a>

@endsection
