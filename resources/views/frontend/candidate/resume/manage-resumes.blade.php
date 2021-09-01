@extends('frontend.candidate.layouts.app')
@section('title1')
    Manage Resumes
@endsection
@section('content1')

                    <div class="job-alerts-item candidates">
                        <h3 class="alerts-title">Manage Resumes</h3>
                        <div class="manager-resumes-item">
                            <div class="manager-content">
                                <a href="{{route('resume')}}"><img class="resume-thumb"
                                                                   src="{{asset('img/jobs/avatar-1.jpg')}}" alt=""></a>
                                <div class="manager-info">
                                    <div class="manager-name">
                                        <h4><a href="#">Zane Joyner</a></h4>
                                        <h5>Front-end developer</h5>
                                    </div>
                                    <div class="manager-meta">
                                        <span class="location"><i class="lni-map-marker"></i> Cupertino, CA, USA</span>
                                        <span class="rate"><i class="lni-alarm-clock"></i> $55 per hour</span>
                                    </div>
                                </div>
                            </div>
                            <div class="update-date">
                                <p class="status">
                                    <strong>Updated on:</strong> Fab 22, 2020
                                </p>
                                <div class="action-btn">
                                    <a class="btn btn-xs btn-gray" href="#">Hide</a>
                                    <a class="btn btn-xs btn-gray" href="#">Edit</a>
                                    <a class="btn btn-xs btn-danger" href="#">Delete</a>
                                </div>
                            </div>
                        </div>
                        <div class="manager-resumes-item">
                            <div class="manager-content">
                                <a href="{{route('resume')}}"><img class="resume-thumb"
                                                                   src="{{asset('img/jobs/avatar-1.jpg')}}" alt=""></a>
                                <div class="manager-info">
                                    <div class="manager-name">
                                        <h4><a href="#">Zane Joyner</a></h4>
                                        <h5>Front-end developer</h5>
                                    </div>
                                    <div class="manager-meta">
                                        <span class="location"><i class="lni-map-marker"></i> Cupertino, CA, USA</span>
                                        <span class="rate"><i class="lni-alarm-clock"></i> $55 per hour</span>
                                    </div>
                                </div>
                            </div>
                            <div class="update-date">
                                <p class="status">
                                    <strong>Updated on:</strong> Fab 22, 2020
                                </p>
                                <div class="action-btn">
                                    <a class="btn btn-xs btn-gray" href="#">Hide</a>
                                    <a class="btn btn-xs btn-gray" href="#">Edit</a>
                                    <a class="btn btn-xs btn-danger" href="#">Delete</a>
                                </div>
                            </div>
                        </div>
                        <div class="manager-resumes-item">
                            <div class="manager-content">
                                <a href="{{route('resume')}}"><img class="resume-thumb"
                                                                   src="{{asset('img/jobs/avatar-1.jpg')}}" alt=""></a>
                                <div class="manager-info">
                                    <div class="manager-name">
                                        <h4><a href="#">Zane Joyner</a></h4>
                                        <h5>Front-end developer</h5>
                                    </div>
                                    <div class="manager-meta">
                                        <span class="location"><i class="lni-map-marker"></i> Cupertino, CA, USA</span>
                                        <span class="rate"><i class="lni-alarm-clock"></i> $55 per hour</span>
                                    </div>
                                </div>
                            </div>
                            <div class="update-date">
                                <p class="status">
                                    <strong>Updated on:</strong> Fab 22, 2020
                                </p>
                                <div class="action-btn">
                                    <a class="btn btn-xs btn-gray" href="#">Hide</a>
                                    <a class="btn btn-xs btn-gray" href="#">Edit</a>
                                    <a class="btn btn-xs btn-danger" href="#">Delete</a>
                                </div>
                            </div>
                        </div>
                        <div class="manager-resumes-item">
                            <div class="manager-content">
                                <a href="{{route('resume')}}"><img class="resume-thumb"
                                                                   src="{{asset('img/jobs/avatar-1.jpg')}}" alt=""></a>
                                <div class="manager-info">
                                    <div class="manager-name">
                                        <h4><a href="#">Zane Joyner</a></h4>
                                        <h5>Front-end developer</h5>
                                    </div>
                                    <div class="manager-meta">
                                        <span class="location"><i class="lni-map-marker"></i> Cupertino, CA, USA</span>
                                        <span class="rate"><i class="lni-alarm-clock"></i> $55 per hour</span>
                                    </div>
                                </div>
                            </div>
                            <div class="update-date">
                                <p class="status">
                                    <strong>Updated on:</strong> Fab 22, 2020
                                </p>
                                <div class="action-btn">
                                    <a class="btn btn-xs btn-gray" href="#">Hide</a>
                                    <a class="btn btn-xs btn-gray" href="#">Edit</a>
                                    <a class="btn btn-xs btn-danger" href="#">Delete</a>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-common btn-sm" href="{{route('add-resume')}}">Add new resume</a>
                    </div>


@endsection
