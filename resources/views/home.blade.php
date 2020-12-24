@extends('layouts.index')
@section('internal-style')
<style>
.page-wrapper {
	background: white !important;
}
.link-colab {
	color: #FF1543;
}
</style>
@endsection
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span>DDC COVID-19</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('main') }}">Home</a></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="error-box">
		<div class="error-body text-center">
		<img src="{{ asset('assets/images/logo-ddc.png') }}">
		<h3 class="text-uppercase error-subtitle">DDC COVID-19</h3>
		<p class="text-muted m-t-30 m-b-30"></p>
	</div>
</div>
@endsection
@section('bottom-script')
<?php
	$ts = time();
	$signature = "bd6efdd618ef8e481ba2e247b10735b801fbdefe";
	$uid = Auth::user()->id;
	$sig = sha1($uid.$ts.$signature);
	$url_gen_lab = "http://viral.ddc.moph.go.th/viral/token.php?uid=".$uid."&ts=".$ts."&sig=".$sig."&typelab=1";
	$url_lab_result = "http://viral.ddc.moph.go.th/viral/token.php?uid=".$uid."&ts=".$ts."&sig=".$sig."&typelab=2";
	?>
<script>
@endsection
