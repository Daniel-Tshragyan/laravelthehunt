@extends('admin.layouts.app')
@section('title')
    Category
@endsection
@section('content')
    {{ Breadcrumbs::render('categoryShow') }}
    <h1> Category</h1>

    <table class="table table-bordered">
        <thead>
        <tr>
            <td>
                id
            </td>
            <td>
                title
            </td>
            <td>
                sort
            </td>
            <td>
                jobs count
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
                {{$category->id}}
            </td>
            <td>

            {{$category->title}}
            </td>
            <td>
                <img src="{{asset('storage/categories_images/'.$category->image)}}" alt="" width="80px">
            </td>
            <td>
                {{$category->sort}}

            </td>
            <td>
                {{$category->jobs_count}}
            </td>
            <td>
                {{ $category->created_at }}
            </td>
            <td>
                {{ $category->updated_at }}
            </td>
        </tr>
        </tbody>
    </table>
@endsection
