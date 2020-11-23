<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta charset="utf-8">
    <meta name="author" content="John Doe">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.png')}}">
    <link rel="apple-touch-icon" href="{{asset('assets/img/apple-touch-icon.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/img/apple-touch-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/img/apple-touch-icon-114x114.png')}}">

    <!-- Load Core CSS
    =====================================-->
    <link rel="stylesheet" href="{{asset('assets/css/core/bootstrap-3.3.7.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/core/animate.min.css')}}">

    <!-- Load Main CSS
    =====================================-->
    <link rel="stylesheet" href="{{asset('assets/css/main/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main/setting.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main/hover.css')}}">


    <link rel="stylesheet" href="{{asset('assets/css/color/pasific.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/icon/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/icon/et-line-font.css')}}">
    

    <!-- Load JS
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
    WARNING: Respond.js doesn't work if you view the page via file://
    =====================================-->

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('page-level-styles')
</head>
<body id="topPage" data-spy="scroll" data-target=".navbar" data-offset="100">



<!-- Page Loader
===================================== -->
<div id="pageloader" class="bg-grad-animation-1">
    <div class="loader-item">
        <img src="{{ asset('assets/img/other/oval.svg') }}" alt="page loader">
    </div>
</div>

<a href="#page-top" class="go-to-top">
    <i class="fa fa-long-arrow-up"></i>
</a>


<!-- Navigation Area
===================================== -->

@include('layouts.blog._navigation')

@yield('header')

<!-- Blog Area
===================================== -->
<div id="blog" class="pt20 pb50">
    <div class="container">

        <div class="row">
            <div class="col-md-9 mt25">
                @yield('main-content')

            </div>


            <!-- Blog Sidebar
            ===================================== -->
            @include('layouts.blog._sidebar')

        </div>

    </div>
</div>


<!-- Newsletter Area
=====================================-->
<div id="newsletter" class="bg-dark2 pt50 pb50">
    <div class="container">
        <div class="row">

            <div class="col-md-2">
                <h4 class="color-light">
                    Newsletter
                </h4>
            </div>

            <div class="col-md-10">
                <form name="newsletter">
                    <div class="input-newsletter-container">
                        <input type="text" name="email" class="input-newsletter" placeholder="enter your email address">
                    </div>
                    <a href="#" class="button button-sm button-pasific hover-ripple-out">Subscribe<i
                            class="fa fa-envelope"></i></a>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Footer Area
=====================================-->
@include('layouts.blog._footer')


<!-- JQuery Core
=====================================-->
<script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap-3.3.7.min.js')}}"></script>

<!-- Magnific Popup
=====================================-->
<script src="{{asset('assets/js/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('assets/js/magnific-popup/magnific-popup-zoom-gallery.js')}}"></script>

<!-- JQuery Main
=====================================-->
<script src="{{asset('assets/js/main/jquery.appear.js')}}"></script>
<script src="{{asset('assets/js/main/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('assets/js/main/parallax.min.js')}}"></script>
<script src="{{asset('assets/js/main/jquery.sticky.js')}}"></script>
<script src="{{asset('assets/js/main/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('assets/js/main/main.js')}}"></script>

@yield('page-level-scripts')
</body>
</html>
