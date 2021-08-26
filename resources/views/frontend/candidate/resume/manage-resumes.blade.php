@extends('layouts.app')
@section('content')
    <!-- Header Section End -->

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>Manage Resumes</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Start Content -->
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-xs-12">
                    <div class="right-sideabr">
                        <h4>Manage Account</h4>
                        <ul class="list-item">
                            <li><a href="{{route('resume')}}">My Resume</a></li>
                            <li><a href="{{route('bookmarked')}}">Bookmarked Jobs</a></li>
                            <li><a href="{{route('notifications')}}">Notifications <span class="notinumber">2</span></a>
                            </li>
                            <li><a class="active" href="{{route('manage-applications')}}">Manage Applications</a></li>
                            <li><a href="{{route('job-alerts')}}">Job Alerts</a></li>
                            <li><a href="{{route('change-password')}}">Change Password</a></li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn" style="
                                        font-size: 14px;
                                        font-weight: 400;
                                        color: #9a9a9a;">Sign Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-xs-12">
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
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->

@endsection
