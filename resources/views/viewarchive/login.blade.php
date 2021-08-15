@extends('layouts.app')
@section('content')

    <!-- Page Header Start -->
    <div class="page-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="inner-header">
              <h3>Login</h3>
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
              <form class="login-form" method="POST" action="{{ route('login') }}">
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
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-icon">
                    <i class="lni-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                      @enderror
                  </div>
                </div>

                <button type="submit" class="btn btn-common log-btn">Submit</button>
              </form>
              <ul class="form-links">
                <li class="text-center"><a href="{{ route('reg') }}">Don't have an account?</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Content section End -->

    @endsection
