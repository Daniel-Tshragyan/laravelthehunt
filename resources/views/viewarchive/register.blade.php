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
                            <input type="hidden" name="role" value="1">
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="lni-user"></i>
                                    <input type="text" value="{{ old('name') }}" class="form-control" name="name" placeholder="Name">
                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
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
                                    <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Password">
                                    @if ($errors->has('password'))
                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="lni-lock"></i>
                                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" placeholder="Password Confirm">
                                    @if ($errors->has('password'))
                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="lni-unlock"></i>
                                    <input type="number" class="form-control" value="{{ old('age') }}" name="age" placeholder="Age">
                                   @if ($errors->has('age'))
                                        <p class="text-danger">{{ $errors->first('age') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="lni-unlock"></i>
                                    <select name="city" id=""  class="form-control">
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
                                    <input type="text" class="form-control" value="{{ old('location') }}" name="location" placeholder="location">
                                    @if ($errors->has('location'))
                                        <p class="text-danger">{{ $errors->first('location') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="lni-unlock"></i>
                                    <input type="text" class="form-control" value="{{ old('profession') }}" name="profession" placeholder="Profession">
                                    @if ($errors->has('location'))
                                        <p class="text-danger">{{ $errors->first('location') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="lni-unlock"></i>
                                    <input type="file" accept="image/png, image/gif, image/jpeg" class="form-control" name="image" placeholder="image">
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
