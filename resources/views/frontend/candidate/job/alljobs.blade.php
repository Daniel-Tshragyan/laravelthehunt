@extends('layouts.app')
@section('content')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>Browse Job</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="job-browse section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <form action="{{route('browse-jobs',['job_tag' => Request::get('job_tag')])}}">
                        @csrf
                    <div class="wrap-search-filter row">
                    <div class="col-lg-3 col-md-3 col-xs-12">
                    <input type="text" class="form-control" name="title" value="{{ $searched['title'] }}" placeholder="Keyword: Name">
                </div>
                    <div class="col-lg-3 col-md-3 col-xs-12">
                            <input type="text" class="form-control" name="location" value="{{ $searched['location'] }}" placeholder="Location">
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-12">
                            <select name="city" id="" class="form-control">
                                <option value="">Select City</option>
                                @foreach($cities as $city)
                                    <option
                                        @if($city->id == $searched['city'])
                                             selected="selected"
                                        @endif
                                        value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-2 col-xs-12">
                            <button type="submit" class="btn btn-common float-right">Filter</button>
                        </div>
                    </div>
                </div>
                </form>
                @foreach($tags as $tag)
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

            @foreach($jobs as $job)
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <a class="job-listings" href="{{ route('show-job',['id' => $job->id]) }}">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-xs-12">
                                <div class="job-company-logo">
                                    @if(!is_null($job->category))
                                        <img style="width:50px" src="{{asset('storage/categories_images/'.$job->category->image)}}" alt="">
                                    @else
                                        <img style="width:50px" src="{{asset('img/features/img2.png')}}" alt="">
                                    @endif
                                </div>
                                <div class="job-details">
                                    <h3>{{ $job->title }}</h3>
                                    <span class="company-neme">
                                      {{ $job->user->name }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-xs-12 text-center">
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
                            <div class="col-lg-2 col-md-2 col-xs-12 text-right">
                                <div class="location">
                                    <i class="lni-map-marker"></i>{{$job->user->company->city->name}},{{$job->location}}
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-xs-12 text-right">
                                <span class="btn-full-time">{{ $job->description }}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach


                </div>
            </div>
        </div>
    </section>
    {{ $jobs->links() }}

@endsection
