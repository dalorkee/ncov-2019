<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="COVID-19">
<meta name="author" content="talek team">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('assets/images/small-moph-logo.png') }}">
<title>COVID-19</title>
@yield('custom-style')
<style>
	.topbar {position:fixed;top:0;top;width:100%;transition: top 0.3s;}
	.topbar,#navbarSupportedContent {background-color:#E84C93 !important;background-color:#343A40 !important;}
	#navbarSupportedContent a {color: white;}
	.auth-box {background: none !important;}
	.bg-white-1 {background-color: #F9F9F9 !important;}
</style>
</head>
<body data-theme="dark">
<div class="main-wrapper">
	@include('flash::message')
	<div class="preloader">
		<div class="lds-ripple">
			<div class="lds-pos"></div>
			<div class="lds-pos"></div>
		</div>
	</div>
	@yield('content')
	</div>
<script src="{{ URL::asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script>
	$('[data-toggle="tooltip"]').tooltip();
	$(".preloader").fadeOut();
	$('#to-recover').on("click", function() {
		$("#loginform").slideUp();
		$("#recoverform").fadeIn();
	});
	$('#to-login').click(function(){
		$("#recoverform").hide();
		$("#loginform").fadeIn();
	});
	$('#flash-overlay-modal').modal();
</script>
@yield('bottom-script')
</body>
</html>
