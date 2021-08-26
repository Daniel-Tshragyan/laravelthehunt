@extends('layouts.app')
@section('content')

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>@yield('title')</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Start Content -->
    <div id="content">
        <div class="container" style="max-width:1300px">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-xs-12">
                    <div class="right-sideabr">
                        <h4>Manage Account</h4>
                        <ul class="list-item">
                            <li><a href="{{route('bookmarked')}}">Bookmarked Jobs</a></li>
                            <li><a href="{{route('notifications')}}">Notifications <span class="notinumber">2</span></a></li>
                            <li><a class="@yield('manageApplication')" href="{{route('manage-applications')}}">Manage Applications</a></li>
                            <li><a class="@yield('manageApplication')" href="{{route('front-job.index')}}">Manage Jobs</a></li>
                            <li><a href="{{route('job-alerts')}}">Job Alerts</a></li>
                            <li><a href="{{route('change-password')}}">Change Password</a></li>
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
                <div class="col-lg-10 col-md-10 col-xs-12">
                    <div class="job-alerts-item candidates">
                        <h3 class="alerts-title">@yield('title')</h3>

                        @yield('content1')
                        <br>
                        <!-- Start Pagination -->

                        <!-- End Pagination -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->

    <!-- Footer Section Start -->
@endsection
