@extends('layouts.index')
@section('internal-style')
<style>
.iframe-container {
	position: relative;
	overflow: hidden;
	width: 100%;
	padding-top: 56.25%;
}

.responsive-iframe {
	position: absolute;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;
	width: 100%;
	height: 100%;
}
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('admindek/css/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admindek/css/widget.css') }}">
@endsection
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none">DDC COVID-19</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('vaccineReport') }}">Vaccine report</a></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="iframe-container">
	<iframe class="responsive-iframe" src="http://203.157.41.186/views/Covid-19/Covid-19?:showAppBanner=false&:display_count=n&:showVizHome=n&:origin=viz_share_link&:isGuestRedirectFromVizportal=y&:embed=y">
	</iframe>
</div>
</div>
@endsection
