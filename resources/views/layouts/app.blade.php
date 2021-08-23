<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Registration, Landing">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <title>TheHunt - Bootstrap HTML5 Job Portal Template</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.css')}}">
    <link rel="stylesheet" href="{{asset('css/slicknav.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">

    <style>
        .alerts-content .row .col-lg-1{
            margin: 0 0 0 10px
        }
        p{
            word-break: break-all;
        }
    </style>

</head>

<body>

<!-- Header Section Start -->
<header id="home" class="hero-area">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg fixed-top scrolling-navbar">
        <div class="container">
            <div class="theme-header clearfix">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="lni-menu"></span>
                        <span class="lni-menu"></span>
                        <span class="lni-menu"></span>
                    </button>
                    <a href="{{route('home')}}" class="navbar-brand"><img src="{{asset('img/logo.png')}}" alt=""></a>
                </div>
                <div class="collapse navbar-collapse" id="main-navbar">
                    <ul class="navbar-nav mr-auto w-100 justify-content-end">
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Home
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item active" href="{{route('home')}}">Home 1</a></li>
                                <li><a class="dropdown-item" href="{{route('index2')}}">Home 2</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Pages
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('about')}}">About</a></li>
                                <li><a class="dropdown-item" href="{{route('job-page')}}">Job Page</a></li>
                                <li><a class="dropdown-item" href="{{route('job-details')}}">Job Details</a></li>
                                <li><a class="dropdown-item" href="{{route('resume')}}">Resume Page</a></li>
                                <li><a class="dropdown-item" href="{{route('privacy-policy')}}">Privacy Policy</a></li>
                                <li><a class="dropdown-item" href="{{route('faq')}}">FAQ</a></li>
                                <li><a class="dropdown-item" href="{{route('pricing')}}">Pricing Tables</a></li>
                                <li><a class="dropdown-item" href="{{route('contact')}}">Contact</a></li>
                            </ul>
                        </li>
                        @guest
                        @else
                            @if(auth()->user()->role == '2')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Employers
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{route('frontjob.create')}}">Add Job</a></li>
                                        <li><a class="dropdown-item" href="{{route('frontjob.index')}}">Manage Jobs</a></li>
                                        <li><a class="dropdown-item" href="{{route('manage-applications')}}">Manage Applications</a></li>
                                        <li><a class="dropdown-item" href="{{route('browse-resumes')}}">Browse Resumes</a></li>
                                    </ul>
                                </li>
                            @elseif(auth()->user()->role == '1')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Candidates
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{route('browse-jobs')}}">Browse Jobs</a></li>
                                        <li><a class="dropdown-item" href="{{route('browse-categories')}}">Browse Categories</a></li>
                                        <li><a class="dropdown-item" href="{{route('add-resume')}}">Add Resume</a></li>
                                        <li><a class="dropdown-item" href="{{route('manage-resumes')}}">Manage Resumes</a></li>
                                        <li><a class="dropdown-item" href="{{route('job-alerts')}}">Job Alerts</a></li>
                                    </ul>
                                </li>
                            @endif
                        @endguest

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Blog
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('blog')}}">Blog - Right Sidebar</a></li>
                                <li><a class="dropdown-item" href="{{route('blog-left-sidebar')}}">Blog - Left Sidebar</a></li>
                                <li><a class="dropdown-item" href="{{route('blog-full-width')}}"> Blog full width</a></li>
                                <li><a class="dropdown-item" href="{{route('single-post')}}">Blog Single Post</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('contact')}}">
                                Contact
                            </a>
                        </li>
                        @guest
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{route('login')}}">Sign In</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('reg') }}">Register as Candidate</a></li>
                                <li><a class="dropdown-item" href="{{route('reg1')}}">Register as Company</a></li>
                            </ul>
                        </li>
                        @else
                            <li class="nav-item dropdown">
                                <form style="margin-top:10px" id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn" style="
                                        font-size: 14px;
                                        font-weight: 400;
                                        color: #9a9a9a;">Sign Out
                                    </button>
                                </form>
                            </li>
                            @if(auth()->user()->role == "2")
                                <li class="button-group">
                                    <a href="{{route('frontjob.create')}}" class="button btn btn-common">Post a Job</a>
                                </li>
                            @endif
                        @endguest

                    </ul>
                </div>
            </div>
        </div>
        <div class="mobile-menu" data-logo="{{asset('img/logo-mobile.png')}}"></div>
    </nav>
</header>
    @yield('content')
    <footer>
        <section class="footer-Content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-xs-12">
                        <div class="widget">
                            <div class="footer-logo"><img src="{{asset('img/logo-footer.png')}}" alt=""></div>
                            <div class="textwidget">
                                <p>Sed consequat sapien faus quam bibendum convallis quis in nulla. Pellentesque volutpat odio eget diam cursus semper.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4 col-xs-12">
                        <div class="widget">
                            <h3 class="block-title">Quick Links</h3>
                            <ul class="menu">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Support</a></li>
                                <li><a href="#">License</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                            <ul class="menu">
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Privacy</a></li>
                                <li><a href="#">Refferal Terms</a></li>
                                <li><a href="#">Product License</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-12">
                        <div class="widget">
                            <h3 class="block-title">Subscribe Now</h3>
                            <p>Sed consequat sapien faus quam bibendum convallis.</p>
                            <form method="post" id="subscribe-form" name="subscribe-form" class="validate">
                                <div class="form-group is-empty">
                                    <input type="email" value="" name="Email" class="form-control" id="EMAIL" placeholder="Enter Email..." required="">
                                    <button type="submit" name="subscribe" id="subscribes" class="btn btn-common sub-btn"><i class="lni-envelope"></i></button>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                            <ul class="mt-3 footer-social">
                                <li><a class="facebook" href="#"><i class="lni-facebook-filled"></i></a></li>
                                <li><a class="twitter" href="#"><i class="lni-twitter-filled"></i></a></li>
                                <li><a class="linkedin" href="#"><i class="lni-linkedin-fill"></i></a></li>
                                <li><a class="google-plus" href="#"><i class="lni-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer area End -->

        <!-- Copyright Start  -->
        <!-- Copyright End -->
    </footer>
    <!-- Footer Section End -->

    <!-- Go To Top Link -->
    <a href="#" class="back-to-top">
        <i class="lni-arrow-up"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader">
        <div class="loader" id="loader-1"></div>
    </div>
    <!-- End Preloader -->

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="{{asset('js/jquery-min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/color-switcher.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('js/waypoints.min.js')}}"></script>
    <script src="{{asset('js/form-validator.min.js')}}"></script>
    <script src="{{asset('js/contact-form-script.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>

</body>
</html>
