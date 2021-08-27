@extends('admin.layouts.app')
@section('title')
    User
@endsection

@section('content')

    {{ Breadcrumbs::render('userShow') }}
    <h1>User</h1>
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
            @if($user->role != 0)
            <td>
                City
            </td>
            <td>
                Location
            </td>

            @if($user->role=='1')
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
                    <td>
                        Plan
                    </td>
            @endif
                <td>
                    Image
                </td>
            @endif

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
            @if($user->role != 0)
            <td>
                {{$city->name}}
            </td>
            @if($user->role=='1')
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
                    {{ $user->company->plan->title }}
                </td>
                <td>
                    <img src="{{ asset('storage/users_images/'.$company['image']) }}" alt="" width="58%">
                </td>
            @endif
            @endif

        </tr>
    </table>

@endsection

