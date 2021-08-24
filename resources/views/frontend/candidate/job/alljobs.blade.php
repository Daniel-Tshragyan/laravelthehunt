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
                    <form action="{{route('browse-jobs')}}">
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

            @foreach($jobs as $job)
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <a class="job-listings" href="{{ route('frontjob.show',['frontjob' => $job]) }}">
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
                                <span class="btn-open">
                    {{ $job->job_tags }}
                  </span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-xs-12 text-right">
                                <div class="location">
                                    <i class="lni-map-marker"></i>{{$job->user->company->city->name}},{{$job->location}}
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-xs-12 text-right">
                                <span class="btn-full-time">{{ $job->description }}</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-xs-12 text-right">
                                <span class="btn-apply">Apply Now</span>
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
