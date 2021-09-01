@extends('admin.layouts.app')
@section('title')
    Plan
@endsection
@section('content')
    {{ Breadcrumbs::render('planShow') }}
    <h1>Plan</h1>
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
                jobs count
            </td>
            <td>
                price
            </td>
            <td>
                Featured Job
            </td>
            <td>
                 Job Listing
            </td>
            <td>
                Manage Applications
            </td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                {{ $plan->id }}
            </td>
            <td>
                {{ $plan->title }}
            </td>
            <td>
                {{ $plan->jobs_count }}
            </td>
            <td>
                {{ $plan->price }}
            </td>
            <td>
                @if($plan->featured_job == 1)
                    Yes
                @else
                    No
                @endif
            </td>
            <td>
                @if($plan->job_listing == 1)
                    Yes
                @else
                    No
                @endif
            </td>
            <td>
                @if($plan->manage_applications == 1)
                    Yes
                @else
                    No
                @endif
            </td>
        </tr>
        </tbody>
    </table>
@endsection
