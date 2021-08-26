@extends('layouts.app')
@section('content')

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6 col-xs-12">
                    <div class="breadcrumb-wrapper">
                        <div class="img-wrapper">
                            @if(!is_null($job->category))
                                <img style="max-width:150%" src="{{asset('storage/categories_images/'.$job->category->image)}}" alt="">
                            @else
                                <img style="width:50px" src="{{asset('img/features/img2.png')}}" alt="">
                            @endif
                        </div>
                        <div class="content">
                            <h3 class="product-title">{{ $job->title }}</h3>
                            <p class="brand">{{ $job->user->name }}</p>
                            <div class="tags">
                                <span><i class="lni-map-marker"></i> {{ $job->location }}</span>
                                <span><i class="lni-calendar"></i> Deadline {{ $job->closing_date }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="month-price">
                        <span class="year">Yearly</span>
                        <div class="price">${{ $job->price }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Job Detail Section Start -->
    <section class="job-detail section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-8 col-md-12 col-xs-12">
                    <div class="content-area">
                        <h4>Job Description</h4>
                        {{ $job->description }}
                    </div>
                    @if(auth()->user()->role != 2)

                        <form method="post" action="{{ route('apply-job',['id' => $job->id]) }}">
                            @csrf
                            @if(!$applyed)
                                    <button type="submit" class="btn btn-success" >Apply Job</button>
                            @else
                                <p class="text-success">Already Applyed</p>
                            @endif
                        </form>
                    @endif

                </div>
                <div class="col-lg-4 col-md-12 col-xs-12">
                    <div class="sideber">
                        <div class="widghet">
                            <h3>Job Location</h3>
                            <div class="maps">
                                <div id="map" class="map-full">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d405691.57240383344!2d-122.3212843181106!3d37.40247298383319!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb68ad0cfc739%3A0x7eb356b66bd4b50e!2sSilicon+Valley%2C+CA%2C+USA!5e0!3m2!1sen!2sbd!4v1538319316724" allowfullscreen=""></iframe>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
