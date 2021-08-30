@extends('admin.layouts.app')
@section('title')
    All Users
@endsection

@section('content')
    {{ Breadcrumbs::render('user') }}

    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <h1>All Users</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            @foreach($sorts as $key => $val)
                <td>
                    <a style="margin:10px" href="{{ route('user.index',['order_by' => $key, 'how' => $val]) }}">{{$key}}
                    </a>
                </td>
            @endforeach()
            <td>
                Actions
            </td>
        </tr>
        <tr>
            <form
                action="{{ route('user.index',['order_by' => Request::get('order_by'), 'how' => Request::get('how')]) }}">
                @csrf
                <td>
                    <input class="form-control" value="{{ $searched['id'] }}" type="number" name="id">
                </td>
                <td>
                    <input class="form-control" value="{{ $searched['name'] }}" type="text" name="name">
                </td>
                <td>
                    <select name="role" id="" class="form-control">
                        <option value="">
                            Select Role
                        </option>
                        @foreach($filters as $key => $value)

                            <option value="{{ $key }}"
                                @if($key == $searched['role'])
                                      selected="selected"
                                @endif
                            >{{ $value }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control"  value="{{$searched['email'] }}" name="email">
                </td>
                <td>
                    <button class="btn btn-success" type="submit">Search</button>
                </td>
            </form>

        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>
                    {{ $user->id }}
                </td>
                <td>
                    {{$user->name}}
                </td>

                <td>
                    {{ $roles[$user->role] }}
                </td>

                <td>
                    {{ $user->email }}
                </td>

                <td>
                    <a title="Show" style="margin:5px" href="{{ route('user.show',['user' => $user]) }}">
                        <i class="far fa-eye"></i>
                    </a>
                    <a title="Update" style="margin:5px" href="{{ route('user.edit',['user' => $user]) }}">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form style="display:inline-block" action="{{ route('user.destroy',['user' => $user]) }}" method="post">
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
    {{ $users->links() }}

@endsection
