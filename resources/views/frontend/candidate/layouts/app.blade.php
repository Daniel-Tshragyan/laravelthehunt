@extends('layouts.app')
@section('title')
    Notifications
@endsection
@section('content')

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>@yield('title1')</h3>
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
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="right-sideabr">
                        <h4>Manage Account</h4>
                        <ul class="list-item">
                            <li><a href="{{route('resume')}}">My Resume</a></li>
                            <li><a href="{{route('bookmarked')}}">Bookmarked Jobs</a></li>
                            <li><a href="{{route('notifications')}}">Notifications <span class="notinumber">2</span></a></li>
                            <li><a class="active" href="{{route('manage-applications')}}">Manage Applications</a></li>
                            <li><a href="{{route('job-alerts')}}">Job Alerts</a></li>
                            <li><a href="{{route('all-dialogs')}}">Messages</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn" style="
                                        font-size: 14px;
                                        font-weight: 400;
                                        color: #9a9a9a;">Sign Out
                                </button>
                            </form>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    @yield('content1')
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->

@endsection
