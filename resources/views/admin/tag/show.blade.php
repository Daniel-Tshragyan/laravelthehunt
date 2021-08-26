@extends('admin.layouts.app')
@section('title')
 Tag
@endsection
@section('content')
    {{ Breadcrumbs::render('tagShow') }}
    <h1>Tag</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <td>
                id
            </td>
            <td>
                title
            </td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                {{ $tag->id }}
            </td>
            <td>
                {{ $tag->title }}

            </td>
        </tr>
        </tbody>
    </table>
@endsection
