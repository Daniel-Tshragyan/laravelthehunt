@extends('admin.layouts.app')
@section('title')
    Job
@endsection
@section('content')
    {{ Breadcrumbs::render('jobShow') }}
    <h1>Job</h1>
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
                location
            </td>
            <td>
                job_tags
            </td>
            <td>
                description
            </td>
            <td>
                closing_date
            </td>
            <td>
                price
            </td>
            <td>
               company
            </td>
            <td>
                category
            </td>
            <td>
                Category Image
            </td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                {{ $job->id }}
            </td>
            <td>
                {{ $job->title }}

            </td>
            <td>

                {{ $job->location }}
            </td>
            <td>

                {{ $job->job_tags }}
            </td>
            <td>

                {{ $job->description }}
            </td>
            <td>

                {{ $job->closing_date }}
            </td>
            <td>

                {{ $job->price }}
            </td>
            <td>

                {{ $job->user->name }}
            </td>
            <td>
                {{ $job->category->title ?? '-' }}
            </td>
            <td>
                <img width="80px" src="{{ asset('storage/categories_images/'.$job->category->image) }}" alt="">
            </td>
        </tr>
        </tbody>
    </table>
@endsection
