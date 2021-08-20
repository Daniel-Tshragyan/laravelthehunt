@extends('layouts.app')
@section('content')

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>Create Your account</h3>
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
                            Create Your account
                        </h3>
                        <form class="login-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="role" value="2">
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="lni-user"></i>
                                    <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="Name">
                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="lni-user"></i>
                                    <input type="text" class="form-control" value="{{ old('companyname') }}" name="companyname" placeholder="Company name">
                                    @if ($errors->has('companyname'))
                                        <p class="text-danger">{{ $errors->first('companyname') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="lni-envelope"></i>
                                    <input type="text" class="form-control" value="{{ old('email') }}" name="email" placeholder="Email Address">
                                    @if ($errors->has('email'))
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="lni-lock"></i>
                                    <input type="password" class="form-control" value="{{ old('password') }}" placeholder="Password" name="password">
                                    @if ($errors->has('password'))
                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="lni-lock"></i>
                                    <input type="password" value="{{ old('password_confirmation') }}" name="password_confirmation" class="form-control" placeholder="Password Confirm">
                                    @if ($errors->has('password_confirmation'))
                                        <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="lni-unlock"></i>
                                    <input type="text" value="{{ old('tagline') }}" class="form-control" name="tagline" placeholder="Tagline">
                                    @if ($errors->has('tagline'))
                                        <p class="text-danger">{{ $errors->first('tagline') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="lni-unlock"></i>
                                    <select name="city" id="" class="form-control">
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('city'))
                                        <p class="text-danger">{{ $errors->first('city') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="lni-unlock"></i>
                                    <input type="text" value="{{ old('location') }}" class="form-control" name="location" placeholder="Location">
                                    @if ($errors->has('location'))
                                        <p class="text-danger">{{ $errors->first('location') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="lni-unlock"></i>
                                    <input type="file"  class="form-control" name="image" placeholder="Tagline">
                                    @if ($errors->has('image'))
                                        <p class="text-danger">{{ $errors->first('image') }}</p>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-common log-btn mt-3">Register</button>
                            <p class="text-center">Already have an account?<a href="{{route('login')}}"> Sign In</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Content section End -->

@endsection
