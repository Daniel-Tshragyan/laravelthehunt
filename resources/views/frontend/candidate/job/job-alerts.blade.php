@extends('layouts.app')
@section('content')

    <!-- Page Header Start -->
    <div class="page-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="inner-header">
              <h3>Job Alerts</h3>
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
                  <li><a href="{{route('bookmarked')}}.">Bookmarked Jobs</a></li>
                  <li><a href="{{route('notifications')}}">Notifications <span class="notinumber">2</span></a></li>
                  <li><a href="{{route('manage-applications')}}">Manage Applications</a></li>
                <li><a class="active" href="{{route('job-alerts')}}">Job Alerts</a></li>
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
          <div class="col-lg-8 col-md-12 col-xs-12">
            <div class="job-alerts-item">
              <h3 class="alerts-title">Job Alerts</h3>
              <div class="alerts-list">
                <div class="row">
                  <div class="col-md-3">
                    <p>Name</p>
                  </div>
                  <div class="col-md-3">
                    <p>Keywords</p>
                  </div>
                  <div class="col-md-3">
                    <p>Contract Type</p>
                  </div>
                  <div class="col-md-3">
                    <p>Frequency</p>
                  </div>
                </div>
              </div>
              <div class="alerts-content">
                <div class="row">
                  <div class="col-md-3">
                    <h3>Web Designer</h3>
                    <span class="location"><i class="lni-map-marker"></i> Manhattan, NYC</span>
                  </div>
                  <div class="col-md-3">
                    <p>Web Designer</p>
                  </div>
                  <div class="col-md-3">
                    <p><span class="full-time">Full-Time</span></p>
                  </div>
                  <div class="col-md-3">
                    <p>Daily</p>
                  </div>
                </div>
              </div>
              <div class="alerts-content">
                <div class="row">
                  <div class="col-md-3">
                    <h3>UI/UX designer</h3>
                    <span class="location"><i class="lni-map-marker"></i> Manhattan, NYC</span>
                  </div>
                  <div class="col-md-3">
                    <p>UI/UX designer</p>
                  </div>
                  <div class="col-md-3">
                    <p><span class="full-time">Full-Time</span></p>
                  </div>
                  <div class="col-md-3">
                    <p>Daily</p>
                  </div>
                </div>
              </div>
              <div class="alerts-content">
                <div class="row">
                  <div class="col-md-3">
                    <h3>Developer</h3>
                    <span class="location"><i class="lni-map-marker"></i> Manhattan, NYC</span>
                  </div>
                  <div class="col-md-3">
                    <p>Developer</p>
                  </div>
                  <div class="col-md-3">
                    <p><span class="part-time">Part-Time</span></p>
                  </div>
                  <div class="col-md-3">
                    <p>Daily</p>
                  </div>
                </div>
              </div>
              <div class="alerts-content">
                <div class="row">
                  <div class="col-md-3">
                    <h3>Senior UX Designer</h3>
                    <span class="location"><i class="lni-map-marker"></i> Manhattan, NYC</span>
                  </div>
                  <div class="col-md-3">
                    <p>Senior UX Designer</p>
                  </div>
                  <div class="col-md-3">
                    <p><span class="full-time">Full-Time</span></p>
                  </div>
                  <div class="col-md-3">
                    <p>Daily</p>
                  </div>
                </div>
              </div>
              <br>
              <!-- Start Pagination -->
              <ul class="pagination">
                <li class="active"><a href="#" class="btn-prev" ><i class="lni-angle-left"></i> prev</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li class="active"><a href="#" class="btn-next">Next <i class="lni-angle-right"></i></a></li>
              </ul>
              <!-- End Pagination -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Content -->

 @endsection
