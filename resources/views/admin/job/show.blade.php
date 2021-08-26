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

                @foreach($job->tags as $tag)
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
                        @if($tag->id ==$searched['job_tag'])
                            background: red;
                        @endif
                            ">{{ $tag->title }}</span>
                    </a>
                @endforeach
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
