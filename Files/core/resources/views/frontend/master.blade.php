<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="shortcut icon" href="{{asset('assets/favicon.png')}}" type="image/x-icon">


    <title>{{general_setting()->title}} | @yield('title')</title>

    <!-- Bootstrap -->
    <link href="{{asset('assets/frontend/')}}/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/plugin/toastr/build/toastr.min.css')}}">
    <link href="{{asset('assets/frontend/')}}/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('assets/frontend/')}}/css/themify-icons.css" rel="stylesheet">
    <link href="{{asset('assets/frontend/')}}/css/magnific-popup.css" rel="stylesheet">
    <link href="{{asset('assets/frontend/')}}/css/jquery-ui.css" rel="stylesheet">
    <link href="{{asset('assets/frontend/')}}/css/slick.css" rel="stylesheet">


    <link href="{{asset('assets/frontend/')}}/css/animate.css" rel="stylesheet">
    <link href="{{asset('assets/frontend/')}}/css/owl.carousel.min.css" rel="stylesheet">


    <!-- Main css -->
    <link href="{{asset('assets/frontend/')}}/css/main.css" rel="stylesheet">
    <link href="{{asset('assets/frontend/')}}/css/color.php?color={{general_setting()->color}}&color_2={{general_setting()->color_2}}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- Preloader -->
<div class="preloader">
    <div class="spinner">
        <span class="spinner-rotate"></span>
    </div>
</div><!-- /Preloader -->


@include('frontend.partials.header-area')
<div class="main-content">
    @yield('content')
</div>
@include('frontend.partials.footer')



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{asset('assets/frontend/')}}/js/jquery-3.2.1.min.js"></script>
<script src="{{asset('assets/frontend/')}}/js/jquery-migrate.js"></script>
<script src="{{asset('assets/plugin/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/frontend/')}}/js/jquery-ui.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{asset('assets/frontend/')}}/js/popper.js"></script>
<script src="{{asset('assets/frontend/')}}/js/bootstrap.min.js"></script>
<script src="{{asset('assets/frontend/')}}/js/owl.carousel.min.js"></script>

<script src="{{asset('assets/frontend/')}}/js/waypoints.min.js"></script>
<script src="{{asset('assets/frontend/')}}/js/jquery.counterup.min.js"></script>
<script src="{{asset('assets/frontend/')}}/js/scrollUp.min.js"></script>

<script src="{{asset('assets/frontend/')}}/js/magnific-popup.min.js"></script>
<script src="{{asset('assets/frontend/')}}/js/imagesloaded.pkgd.min.js"></script>
<script src="{{asset('assets/frontend/')}}/js/isotope.pkgd.min.js"></script>
<script src="{{asset('assets/frontend/')}}/js/slick.min.js"></script>
<script src="{{asset('assets/frontend/')}}/js/SmoothScroll.js"></script>

<script src="{{asset('assets/frontend/')}}/js/wow.min.js"></script>
<script src="{{asset('assets/frontend/')}}/js/script.js"></script>
@include('backend.partials.msg')
@yield('script')
</body>
</html>