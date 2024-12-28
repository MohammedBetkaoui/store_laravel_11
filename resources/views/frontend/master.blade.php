<!DOCTYPE html>
<html lang="en">
<head>
<title>@yield('title')</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ asset('/styles/bootstrap4/bootstrap.min.css') }}">
<link href=" {{ asset('/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/plugins/OwlCarousel2-2.2.1/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/plugins/slick-1.8.0/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/styles/main_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/styles/responsive.css')}}">

</head>

<body>


@include('frontend.layout.header')
@yield('content')
@include('frontend.layout.product_s')
@include('frontend.layout.brand')
@include('frontend.layout.footer')
			

<script src="{{asset('/js/jquery-3.3.1.min.js')}} "></script>
<script src="{{asset('/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{asset('/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('/plugins/slick-1.8.0/slick.js')}}"></script>
<script src="{{asset('/plugins/easing/easing.js')}}"></script>
<script src="{{asset('/js/custom.js')}}"></script>


<script src="{{asset('/plugins/Isotope/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('/plugins/jquery-ui-1.12.1.custom/jquery-ui.js')}}"></script>
<script src="{{asset('/plugins/parallax-js-master/parallax.min.js')}}"></script>
<script src="{{asset('/js/shop_custom.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</body>

</html>