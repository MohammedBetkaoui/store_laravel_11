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

<div class="super_container">
	
	<!-- Header -->
	
@include('frontend.layout.header')
@yield('content')
@include('frontend.layout.product_s')
@include('frontend.layout.brand')
@include('frontend.layout.footer')

	<!-- Copyright -->

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col">
					
					<div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
						<div class="copyright_content"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</div>
						<div class="logos ml-sm-auto">
							<ul class="logos_list">
								<li><a href="#"><img src="images/logos_1.png" alt=""></a></li>
								<li><a href="#"><img src="images/logos_2.png" alt=""></a></li>
								<li><a href="#"><img src="images/logos_3.png" alt=""></a></li>
								<li><a href="#"><img src="images/logos_4.png" alt=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

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



</body>

</html>