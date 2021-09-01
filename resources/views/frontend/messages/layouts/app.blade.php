@extends('layouts.app')
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
        <div class="container" style="max-width:1300px">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-xs-12">
                    <div class="right-sideabr">
                        <h4>Dialogs</h4>
                        @yield('dialogs')

                    </div>
                </div>
                <div class="col-lg-10 col-md-10 col-xs-12">
                    <div class="job-alerts-item candidates">
                        <h3 class="alerts-title">@yield('title')</h3>
                        @yield('content1')
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->

    <!-- Footer Section Start -->
@endsection
