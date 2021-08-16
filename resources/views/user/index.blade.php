@extends('adminlte::page')

@section('content')

    Filter By :
    @foreach($filters as $filter)
        <a style="margin:10px" href=
        @if(Request::get('order_by'))
            "{{ route('user.index',['order_by' => Request::get('order_by'),
                       'how' => Request::get('how'), 'filter_by' => $filter]) }}"
        @else
            "{{ route('user.index',['filter_by' => $filter]) }}"
        @endif
        >
        {{ $filter }}</a>
    @endforeach
    <a style="margin:10px" href=
    @if(Request::get('order_by'))
        "{{ route('user.index',['order_by' => Request::get('order_by'),'how' => Request::get('how')]) }}"
    @else
        "{{ route('user.index') }}"
    @endif
    >
    All</a>
    <br>
    Sort By :
    @foreach($sorts as $key => $val)
        <a style="margin:10px" href=
        @if (Request::get('how') &&  Request::get('how')=='asc' ||  !Request::get('how'))
        @if(Request::get('filter_by'))
            "{{ route('user.index',['order_by' => $key, 'how' => 'desc','filter_by' => Request::get('filter_by')])  }}"
        @else
            "{{ route('user.index',['order_by' => $key, 'how' => 'desc'])  }}"
        @endif
        @elseif (Request::get('how') &&  Request::get('how')=='desc')
            @if(Request::get('filter_by'))
                "{{ route('user.index',['order_by' => $key, 'how' => 'asc','filter_by' => Request::get('filter_by')])  }}"
            @else
                "{{ route('user.index',['order_by' => $key, 'how' => 'asc'])  }}"
            @endif
        @endif
        >{{$val}}
        </a>
    @endforeach()
    <br>

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
