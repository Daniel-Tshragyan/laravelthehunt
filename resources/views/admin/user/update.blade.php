@extends('admin.layouts.app')


@section('content')
    <form class="login-form" method="POST" action="{{ route('user.update',['user' => $user]) }}"
          enctype="multipart/form-data">
        @csrf
        @method('put')
        <input type="hidden" name="role" value="company">
        <div class="form-group">
            <div class="input-icon">
                <i class="lni-user"></i>
                <label for="">
                    Name
                </label>
                <input type="text" class="form-control" value="{{$user->name}}" name="name" placeholder="Name">
                @if ($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="input-icon">
                <i class="lni-envelope"></i>
                <label for="">
                    Email
                </label>
                <input type="text" class="form-control" value="{{$user->email}}" name="email"
                       placeholder="Email Address">
                @if ($errors->has('email'))
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="input-icon">
                <i class="lni-envelope"></i>
                <label for="">
                    Password
                </label>
                <input type="text" class="form-control" value="" name="password"
                       placeholder="New Password">
                @if ($errors->has('password'))
                    <p class="text-danger">{{ $errors->first('password') }}</p>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="input-icon">
                <i class="lni-unlock"></i>
                <label for="">
                    City
                </label>
                <select name="city" id="" class="form-control">
                    @foreach($cities as $city1)
                        <option value="{{$city1->id}}"
                                @if($city1->id == $city->id)
                                selected="selected"
                            @endif
                        >{{$city1->name}}</option>
                    @endforeach
                </select>
                @if ($errors->has('city'))
                    <p class="text-danger">{{ $errors->first('city') }}</p>
                @endif
            </div>
        </div>
        @if($user->role == 'company')
            <div class="form-group">
                <div class="input-icon">
                    <i class="lni-unlock"></i>
                    <label for="">
                        Location
                    </label>
                    <input type="text" class="form-control" value="{{ $company['location'] }}" name="location"
                           placeholder="Location">
                    @if ($errors->has('location'))
                        <p class="text-danger">{{ $errors->first('location') }}</p>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon">
                    <i class="lni-user"></i>
                    <label for="">
                        Company Name
                    </label>
                    <input type="text" class="form-control" value="{{ $company['comapnyname'] }}" name="comapnyname"
                           placeholder="Company name">
                    @if ($errors->has('companyname'))
                        <p class="text-danger">{{ $errors->first('companyname') }}</p>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon">
                    <i class="lni-unlock"></i>
                    <label for="">
                        Tagline
                    </label>
                    <input type="text" class="form-control" value="{{$company['tagline']}}" name="tagline"
                           placeholder="Tagline">
                    @if ($errors->has('tagline'))
                        <p class="text-danger">{{ $errors->first('tagline') }}</p>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon">
                    <i class="lni-unlock"></i>
                    <label for="">
                        Image
                    </label>
                    <input type="file" value="asset({{$company['image']}})" class="form-control" name="image"
                           placeholder="Image">
                    @if ($errors->has('image'))
                        <p class="text-danger">{{ $errors->first('image') }}</p>
                    @endif
                </div>
            </div>
        @else
            <div class="form-group">
                <div class="input-icon">
                    <i class="lni-unlock"></i>
                    <label for="">
                        Location
                    </label>
                    <input type="text" class="form-control" value="{{ $candidate['location'] }}" name="location"
                           placeholder="Location">
                    @if ($errors->has('location'))
                        <p class="text-danger">{{ $errors->first('location') }}</p>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon">
                    <i class="lni-user"></i>
                    <label for="">
                        Age
                    </label>
                    <input type="number" class="form-control" value="{{ $candidate['age'] }}" name="age"
                           placeholder="Age">
                    @if ($errors->has('age'))
                        <p class="text-danger">{{ $errors->first('age') }}</p>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon">
                    <i class="lni-unlock"></i>
                    <label for="">
                        Profession
                    </label>
                    <input type="text" class="form-control" value="{{ $candidate['profession'] }}" name="profession"
                           placeholder="Profession">
                    @if ($errors->has('profession'))
                        <p class="text-danger">{{ $errors->first('profession') }}</p>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon">
                    <i class="lni-unlock"></i>
                    <label for="">
                        Image
                    </label>
                    <input type="file" value="{{asset($candidate['image']) }}" class="form-control" name="image"
                           placeholder="Image">
                    @if ($errors->has('image'))
                        <p class="text-danger">{{ $errors->first('image') }}</p>
                    @endif
                </div>
            </div>
        @endif

        <button type="submit" class="btn btn-success log-btn mt-3">Update</button>
        @if(Session::has('message'))
            <p class="text-success">{{ Session::get('message') }}</p>
        @endif
    </form>
@endsection
