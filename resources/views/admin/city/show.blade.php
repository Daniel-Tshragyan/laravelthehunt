@extends('admin.layouts.app')

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <td>
                    id
                </td>
                <td>
                    name
                </td>
                <td>
                    created at
                </td>
                <td>
                    updated at
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{$city->id}}
                </td>
                <td>
                    {{$city->name}}
                </td>
                <td>
                    {{ $city->created_at }}
                </td>
                <td>
                    {{ $city->updated_at }}
                </td>
            </tr>
        </tbody>
    </table>
@endsection
