@extends('frontend.company.layouts.app')
@section('manageApplication')
    active
@endsection
@section('title')
    Manage Jobs
@endsection
@section('content1')
    <div class="alerts-list">
        @if(Session::has('message'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="row justify-content-around">
            @foreach($sorts as $key => $val)
                @if($key != 'company_id')

                <div style="margin:0 0 0 10px;padding:0; text-align:right" class="col-lg-1 col-md-1 col-xs-12">
                        <a style="margin:10px" href="{{ route('front-job.index',['order_by' => $key, 'how' => $val]) }}">
                            @if($key == 'category_id')
                                category
                            @else
                                {{$key}}
                            @endif
                        </a>
                </div>
                @endif

            @endforeach()
                <div style="margin:0 0 0 10px" class="col-lg-1 col-md-1 col-xs-12">
                    Actions
                </div>
        </div>

            <form
                action="{{ route('front-job.index',['order_by' => Request::get('order_by'), 'how' => Request::get('how')]) }}">
    <div class="alerts-list d-flex justify-content-around">

        @csrf
        <div style="margin:0 0 0 10px;padding:0; text-align:right" class="col-lg-1 col-md-1 col-xs-12">
            <input class="form-control" value="{{ $searched['id'] }}" type="number" name="id">
        </div>
        <div  style="margin:0 0 0 10px;padding:0; text-align:right" class="col-lg-1 col-md-1 col-xs-12">
            <input class="form-control" value="{{ $searched['title'] }}" type="text" name="title">
        </div>
        <div style="margin:0 0 0 10px;padding:0; text-align:right" class="col-lg-1 col-md-1 col-xs-12">
            <input class="form-control" value="{{ $searched['location'] }}" type="text" name="location">
        </div>
        <div style="margin:0 0 0 10px;padding:0; text-align:right" class="col-lg-1 col-md-1 col-xs-12">
            <select name="job_tags[]" id="" multiple="multiple" class="tags1 form-control">
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}"
                            @if(in_array($tag->id, $searched['job_tags']))
                            selected="selected"
                        @endif
                    >{{ $tag->title }}</option>
                @endforeach
            </select>
        </div>
       <div style="margin:0 0 0 10px;padding:0; text-align:right" class="col-lg-1 col-md-1 col-xs-12">
            <input class="form-control" value="{{ $searched['description'] }}" type="text" name="description">
       </div>
        <div style="margin:0 0 0 10px;padding:0; text-align:right" class="col-lg-1 col-md-1 col-xs-12">
            <input class="form-control" value="{{ $searched['closing_date'] }}" type="date" name="closing_date">
        </div>
        <div style="margin:0 0 0 10px;padding:0; text-align:right" class="col-lg-1 col-md-1 col-xs-12">
            <input class="form-control" value="{{ $searched['price'] }}" type="number" name="price">
        </div>
        <div style="margin:0 0 0 10px;padding:0; text-align:right" class="col-lg-1 col-md-1 col-xs-12">
            <input class="form-control" value="{{ $searched['url'] }}" type="text" name="url">
        </div>
        <div style="margin:0 0 0 10px;padding:0; text-align:right" class="col-lg-1 col-md-1 col-xs-12">
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
        </div>
        <div style="margin:0 0 0 10px;padding:0; text-align:right" class="col-lg-1 col-md-1 col-xs-12">
            <button class="btn btn-success" type="submit">Search</button>
        </div>
    </div>
            </form>
        @foreach($jobs as $job)
        <div class="alerts-content">
            <div class="row justify-content-around" style="text-align:right">

                <div class="col-lg-1 col-md-1 col-xs-12">
                    <h3>{{ $job->id }}</h3>
                </div>
                <div class="col-lg-1 col-md-1 col-xs-12">
                    <h3>{{ $job->title }}</h3>
                </div>
                <div class="col-lg-1 col-md-1 col-xs-12">
                    <span class="location"><i class="lni-map-marker"></i> {{ $job->location }}</span>
                </div>
                <div class="col-lg-1 col-md-1 col-xs-12">
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
                </div>
                <div class="col-lg-1 col-md-1 col-xs-12">
                    <p style="overflow:hidde">{{ $job->description }}</p>
                </div>
                <div class="col-lg-1 col-md-1 col-xs-12">
                    <p>{{ $job->closing_date }}</p>
                </div>
                <div class="col-lg-1 col-md-1 col-xs-12">
                    <p>{{ $job->price }}</p>
                </div>
                <div class="col-lg-1 col-md-1 col-xs-12">
                    <p>{{ $job->url }}</p>
                </div>
                <div class="col-lg-1 col-md-1 col-xs-12">
                    {{ $job->category->title ?? '-' }}
                </div>

                <div class="col-lg-1 col-md-1 col-xs-12">
                    <a title="Show" style="margin:5px" href="{{ route('front-job.show',['front_job' => $job]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                        </svg>
                    </a>
                    <a title="Update" style="margin:5px" href="{{ route('front-job.edit',['front_job' => $job]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-pen-fill" viewBox="0 0 16 16">
                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                        </svg>
                    </a>
                    <form style="display:inline-block" action="{{ route('front-job.destroy',['front_job' => $job]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button title="Remove" style="border:none;background-color:transparent" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-calendar-x-fill" viewBox="0 0 16 16">
                                <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM6.854 8.146 8 9.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 10l1.147 1.146a.5.5 0 0 1-.708.708L8 10.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 10 6.146 8.854a.5.5 0 1 1 .708-.708z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{ $jobs->links() }}

@endsection
