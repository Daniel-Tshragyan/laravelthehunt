@extends('layouts.app')
@section('content')

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>Admin Login</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Content section Start -->
    <section id="content" class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6 col-xs-12">
                    <div class="page-login-form box">
                        <h3>
                            Login
                        </h3>
                        <form class="login-form" method="POST" action="{{ route('adminlogin') }}">
                            @csrf
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="lni-user"></i>
                                    <input type="text" id="sender-email" class="form-control" name="email" placeholder="Username">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    @if (Session::has('login'))
                                        <p class="text-danger">{{ Session::get('login') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="lni-lock"></i>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    @if (Session::has('password'))
                                        <p class="text-danger">{{ Session::get('password') }}</p>
                                    @endif
                                </div>
                            </div>

                            <button type="submit" class="btn btn-common log-btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Content section End -->

@endsection
