@extends('admin.layouts.app')

@section('title')
    All Jobs
@endsection
@section('content')
    {{ Breadcrumbs::render('job') }}

    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <h1> All Jobs</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            @foreach($sorts as $key => $val)
                <td>
                    <a style="margin:10px" href="{{ route('job.index',['order_by' => $key, 'how' => $val]) }}">
                        @if($key == 'company_id')
                            company
                        @elseif($key == 'category_id')
                            category
                        @else
                            {{$key}}
                        @endif
                    </a>
                </td>
            @endforeach()
            <td>
                Actions
            </td>
        </tr>
        <tr>
            <form
                action="{{ route('job.index',['order_by' => Request::get('order_by'), 'how' => Request::get('how')]) }}">
                @csrf
                <td style="width:80px">
                    <input class="form-control" value="{{ $searched['id'] }}" type="number" name="id">
                </td>
                <td>
                    <input class="form-control" value="{{ $searched['title'] }}" type="text" name="title">
                </td>
                <td>
                    <input class="form-control" value="{{ $searched['location'] }}" type="text" name="location">
                </td>
                <td>
                    <select name="job_tags[]" id="" multiple="multiple" class="tags1 form-control">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}"
                                @if(in_array($tag->id, $searched['job_tags']))
                                    selected="selected"
                                @endif
                            >{{ $tag->title }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input class="form-control" value="{{ $searched['description'] }}" type="text" name="description">
                </td>
                <td>
                    <input class="form-control" value="{{ $searched['closing_date'] }}" type="date" name="closing_date">
                </td>
                <td>
                    <input class="form-control" value="{{ $searched['price'] }}" type="text" name="price">
                </td>
                <td>
                    <input class="form-control" value="{{ $searched['url'] }}" type="text" name="url">
                </td>
                <td>
                    <select name="company_id" id="" class="form-control">
                        <option value="">
                            Select Company
                        </option>
                        @foreach($companies as $key => $value)

                            <option value="{{ $value->id }}"
                                    @if($value->id == $searched['company_id'])
                                    selected="selected"
                                @endif
                            >{{ $value->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="category_id" id="" class="form-control">
                        <option value="">
                            Select Category
                        </option>
                        @foreach($categories as $key => $value)

                            <option value="{{ $value->id }}"
                                    @if($value->id == $searched['category_id'])
                                    selected="selected"
                                @endif
                            >{{ $value->title }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <button class="btn btn-success" type="submit">Search</button>
                </td>
            </form>
        </tr>
        </thead>
        <tbody>
        @foreach($jobs as $job)
            <tr>
                <td>
                    {{ $job->id }}
                </td>
                <td>
                    {{$job->title}}
                </td>

                <td>
                    {{ $job->location }}
                </td>

                <td>
                    @foreach($job->tags as $tag)
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
                    {{ $job->url }}
                </td>
                <td>
                    {{ $job->user->name }}
                </td>
                <td>
                    {{ $job->category->title ?? '-' }}
                </td>

                <td>
                    <a title="Show" style="margin:5px" href="{{ route('job.show',['job' => $job]) }}">
                        <i class="far fa-eye"></i>
                    </a>
                    <a title="Update" style="margin:5px" href="{{ route('job.edit',['job' => $job]) }}">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form style="display:inline-block" action="{{ route('job.destroy',['job' => $job]) }}" method="post">
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
    {{ $jobs->links() }}

    <a href="{{ route('job.create') }}">
        <button class="btn btn-success">
            Create New
        </button>
    </a>
    <br>

@endsection
