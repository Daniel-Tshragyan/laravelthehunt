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
                {{ $admin_job->id }}
            </td>
            <td>
                {{ $admin_job->title }}

            </td>
            <td>

                {{ $admin_job->location }}
            </td>
            <td>

                @foreach($admin_job->tags as $tag)
                    <a href="{{ route('browse-jobs',['job_tag' => $tag->id,'title' => Request::get('title'),'location' => Request::get('location'),'city' => Request::get('city')]) }}">
                        <span class="full-time" style="
                            font-size: 11px;
                            font-weight: 500;
                            display: inline-block;
                            padding: 5px 15px;
                            border-radius: 50px;
                            cursor: pointer;
                            text-transform: uppercase;
                            color: #26ae61;
                            background: #d5ffe7;
                            ">{{ $tag->title }}</span>
                    </a>
                @endforeach
            </td>
            <td>

                {{ $admin_job->description }}
            </td>
            <td>

                {{ $admin_job->closing_date }}
            </td>
            <td>

                {{ $admin_job->price }}
            </td>
            <td>

                {{ $admin_job->user->name }}
            </td>
            <td>
                {{ $admin_job->category->title ?? '-' }}
            </td>
            <td>
                <img width="80px" src="{{ asset('storage/categories_images/'.$admin_job->category->image) }}" alt="">
            </td>
        </tr>
        </tbody>
    </table>
@endsection
