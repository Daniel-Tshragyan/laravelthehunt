@extends('adminlte::page')

@section('content')
    @foreach($sorts as $key => $val)
        <a style="margin:10px" href=
        @if (Request::get('how') &&  Request::get('how')=='asc' ||  !Request::get('how'))
            "{{ route('user.index',['order_by' => $key, 'how' => 'desc'])  }}"
        @elseif (Request::get('how') &&  Request::get('how')=='desc')
            "{{ route('user.index',['order_by' => $key, 'how' => 'asc'])  }}"
        @endif
        >{{$val}}
        </a>
    @endforeach()
    <table class="table table-bordered">
        <tr>
            <td>Id</td>
            <td>Name</td>
            <td>Email</td>
            <td>Role</td>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>
                    {{ $user->id }}
                </td>
                <td>
                    @if($user->role != 'admin')
                        <a href="{{ route('user.show',['user' => $user]) }}">
                            {{ $user->name }}
                        </a>
                    @else
                        {{$user->name}}
                    @endif
                </td>

                <td>
                    {{ $user->email }}
                </td>
                <td>
                    {{ $user->role }}
                </td>

            </tr>
        @endforeach
    </table>
    {{ $users->links() }}
    @if(Session::has('message'))
        <p class="text-success">{{ Session::get('message') }}</p>
    @endif
@endsection
