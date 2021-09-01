@extends('admin.layouts.app')

@section('title')
    All Plans
@endsection
@section('content')
    {{ Breadcrumbs::render('plan') }}

    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <h1> All Plans</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            @foreach($paginationArguments->sorts as $key => $val)
                <td>
                    <a style="margin:10px;text-align:center" href="{{ route('plan.index',['order_by' => $key, 'how' => $val]) }}">
                        {{str_replace('_',' ',$key)}}
                    </a>
                </td>
            @endforeach()
            <td>
                Actions
            </td>
        </tr>
        <tr>
            <form
                action="{{ route('plan.index',['order_by' => Request::get('order_by'), 'how' => Request::get('how')]) }}">
                @csrf
                <td style="width:80px">
                    <input class="form-control" value="{{ $paginationArguments->searched['id'] }}" type="number" name="id">
                </td>
                <td>
                    <input class="form-control" value="{{ $paginationArguments->searched['title'] }}" type="text" name="title">
                </td>
                <td>
                    <input class="form-control" value="{{ $paginationArguments->searched['jobs_count'] }}" type="number" name="jobs_count">
                </td>
                <td>
                    <input class="form-control" value="{{ $paginationArguments->searched['expired_days'] }}" type="number" name="expired_days">
                </td>
                <td>
                    <input class="form-control" value="{{ $paginationArguments->searched['price'] }}" type="number" name="price">
                </td>
                <td>
                    <select class="form-control" name="featured_job" id="">
                        <option value="">
                            Select
                        </option>
                        <option value="1" @if($paginationArguments->searched['featured_job'] == 1) selected="selected" @endif>
                            Yes
                        </option>
                        <option value="0" @if($paginationArguments->searched['featured_job'] == 0) selected="selected" @endif>
                            No
                        </option>
                    </select>
                </td>
                <td>
                    <select class="form-control" name="job_listing" id="">
                        <option value="">
                            Select
                        </option>
                        <option value="1" @if($paginationArguments->searched['job_listing'] == 1) selected="selected" @endif>
                            Yes
                        </option>
                        <option value="0" @if($paginationArguments->searched['job_listing'] == 0) selected="selected" @endif>
                            No
                        </option>
                    </select>
                </td>
                <td>
                    <select class="form-control" name="manage_applications" id="">
                        <option value="" >
                           Select
                        </option>
                        <option value="1" @if($paginationArguments->searched['manage_applications'] == 1) selected="selected" @endif>
                            Yes
                        </option>
                        <option value="0" @if($paginationArguments->searched['manage_applications'] == 0) selected="selected" @endif>
                            No
                        </option>
                    </select>
                </td>
                <td>
                    <button class="btn btn-success" type="submit">Search</button>
                </td>
            </form>
        </tr>
        </thead>
        <tbody>
        @foreach($paginationArguments->plans as $plan)
            <tr>
                <td>
                    {{ $plan->id }}
                </td>
                <td>
                    {{$plan->title}}
                </td>
                <td>
                    {{$plan->jobs_count}}
                </td>
                <td>
                    {{$plan->expired_days}}
                </td>
                <td>
                    {{$plan->price}}
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
                <td>
                    <a title="Show" style="margin:5px" href="{{ route('plan.show',['plan' => $plan]) }}">
                        <i class="far fa-eye"></i>
                    </a>
                    <a title="Update" style="margin:5px" href="{{ route('plan.edit',['plan' => $plan]) }}">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form style="display:inline-block" action="{{ route('plan.destroy',['plan' => $plan]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button title="Remove" style="border:none;background-color:transparent" type="submit">
                            <i style="color: red" class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $paginationArguments->plans->links() }}

    <a href="{{ route('plan.create') }}">
        <button class="btn btn-success">
            Create New
        </button>
    </a>
    <br>

@endsection
