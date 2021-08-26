@extends('layouts.app')
@section('content')

    <!-- Page Header Start -->
    <div class="page-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="inner-header">
              <h3>Find Job</h3>
            </div>
            <div class="job-search-form bg-cyan job-featured-search">
              <form>
                <div class="row justify-content-center">
                  <div class="col-lg-5 col-md-5 col-xs-12">
                    <div class="form-group">
                      <input class="form-control" type="text" placeholder="Job Title or Company Name">
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-xs-12">
                    <div class="form-group">
                      <div class="search-category-container">
                        <label class="styled-select">
                          <select>
                            <option value="none">Locations</option>
                            <option value="none">New York</option>
                            <option value="none">California</option>
                            <option value="none">Washington</option>
                            <option value="none">Birmingham</option>
                            <option value="none">Chicago</option>
                            <option value="none">Phoenix</option>
                          </select>
                        </label>
                      </div>
                      <i class="lni-map-marker"></i>
                    </div>
                  </div>
                  <div class="col-lg-1 col-md-1 col-xs-12">
                    <button type="submit" class="button"><i class="lni-search"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page Header End -->

    <!-- Featured Section Start -->
    <section id="featured" class="section bg-cyan">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="job-featured">
              <div class="icon">
                <img src="{{asset('img/features/img1.png')}}" alt="">
              </div>
              <div class="content">
{{--                <h3><a href="{{route('job-details')}}">Software Engineer</a></h3>--}}
                <p class="brand">MizTech</p>
                <div class="tags">
                  <span><i class="lni-map-marker"></i> New York</span>
                  <span><i class="lni-user"></i>John Smith</span>
                </div>
                <span class="full-time">Full Time</span>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="job-featured">
              <div class="icon">
                <img src="{{asset('img/features/img1.png')}}" alt="">
              </div>
              <div class="content">
                <p class="brand">Hunter Inc.</p>
                <div class="tags">
                  <span><i class="lni-map-marker"></i> New York</span>
                  <span><i class="lni-user"></i>John Smith</span>
                </div>
                <span class="part-time">Part Time</span>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="job-featured">
              <div class="icon">
                <img src="{{asset('img/features/img1.png')}}" alt="">
              </div>
              <div class="content">
                <p class="brand">MagNews</p>
                <div class="tags">
                  <span><i class="lni-map-marker"></i> New York</span>
                  <span><i class="lni-user"></i>John Smith</span>
                </div>
                <span class="full-time">Full Time</span>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="job-featured">
              <div class="icon">
                <img src="{{asset('img/features/img1.png')}}" alt="">
              </div>
              <div class="content">
                <p class="brand">AmazeSoft</p>
                <div class="tags">
                  <span><i class="lni-map-marker"></i> New York</span>
                  <span><i class="lni-user"></i>John Smith</span>
                </div>
                <span class="full-time">Full Time</span>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="job-featured">
              <div class="icon">
                <img src="{{asset('img/features/img1.png')}}" alt="">
              </div>
              <div class="content">
                <p class="brand">Bingo</p>
                <div class="tags">
                  <span><i class="lni-map-marker"></i> New York</span>
                  <span><i class="lni-user"></i>John Smith</span>
                </div>
                <span class="part-time">Part Time</span>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="job-featured">
              <div class="icon">
                <img src="{{asset('img/features/img1.png')}}" alt="">
              </div>
              <div class="content">
                <p class="brand">MagNews</p>
                <div class="tags">
                  <span><i class="lni-map-marker"></i> New York</span>
                  <span><i class="lni-user"></i>John Smith</span>
                </div>
                <span class="full-time">Full Time</span>
              </div>
            </div>
          </div>
          <div class="col-12 text-center mt-4">
            <a href="#" class="btn btn-common">Browse All Jobs</a>
          </div>
        </div>
      </div>
    </section>
    <!-- Featured Section End -->

    <!-- Listings Section Start -->
    <section id="job-listings" class="section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-xs-12">
          </div>
        </div>
      </div>
    </section>
    <!-- Listings Section End -->


    <!-- Footer Section Start -->
@endsection
