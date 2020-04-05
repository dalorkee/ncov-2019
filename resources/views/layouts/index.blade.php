<!DOCTYPE html>
<html dir="ltr" lang="th">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="COVID-19">
	<meta name="author" content="Talek team">
	@yield('meta-token')
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('assets/images/small-moph-logo.png') }}">
	<title>COVID-19</title>
	@include('layouts.main-style')
	@yield('custom-style')
	@yield('internal-style')
	@yield('top-script')
</head>
<body>
	<div class="preloader">
		<div class="lds-ripple">
			<div class="lds-pos"></div>
			<div class="lds-pos"></div>
		</div>
	</div>
	<div id="main-wrapper">
		@include('layouts.top-sidebar')
		@include('layouts.left-sidebar')
		<div class="page-wrapper">
			@yield('contents')
			@include('layouts.footer')
		</div>
	</div>
	@include('layouts.main-script')
	@yield('bottom-script')
</body>
</html>
