@extends('admin.layouts.app')


@section('content')
    <table class="table table-bordered">

        <tr>
            <td>
                ID
            </td>

            <td>
                Name
            </td>
            <td>
                Email
            </td>
            <td>
                City
            </td>
            <td>
                Location
            </td>
            @if($user->role=='candidate')
                <td>
                    Age
                </td>
                <td>
                    Profession
                </td>
            @else
                <td>
                    Company Name
                </td>
                <td>
                    Tagline
                </td>
            @endif


            <td>
                Image
            </td>
            <td>
                Edit
            </td>
            <td>
                Delete
            </td>
        </tr>
        <tr>
            <td>
                {{ $user->id }}
            </td>

            <td>
                {{$user->name}}
            </td>
            <td>
                {{$user->email}}
            </td>
            <td>
                {{$city->name}}
            </td>
            @if($user->role=='candidate')
                <td>
                    {{$candidate['location']}}
                </td>
                <td>
                    {{ $candidate['age'] }}
                </td>
                <td>
                    {{ $candidate['profession'] }}
                </td>
                <td>
                    <img src="{{ asset('storage/users_images/'.$candidate['image']) }}" alt="" width="58%">
                </td>
            @else
                <td>
                    {{$company['location']}}
                </td>
                <td>
                    {{ $company['comapnyname'] }}
                </td>
                <td>
                    {{ $company['tagline'] }}
                </td>
                <td>
                    <img src="{{ asset('storage/users_images/'.$company['image']) }}" alt="" width="58%">
                </td>
            @endif

            <td>
                <button class="btn btn-success">
                    <a style="color:white!important" href="{{route('user.edit',['user' => $user])}}">Change</a>
                </button>
            </td>
            <td>
                <form action="{{route('user.destroy',['user' => $user])}}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger" type="submit">
                        Delete
                    </button>
                </form>

            </td>
        </tr>
    </table>

@endsection

