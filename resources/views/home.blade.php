@extends('layouts.index')
@section('internal-style')
<style>
.page-wrapper {
	background: white !important;
}
.bg-danger {
	background-color: #FF5370;
}
.color-danger {
	color: #FF5370;
}
.bg-success {
	background-color: #2ED8B6;
}
.color-success {
	color: #2ED8B6;
}
.bg-success {
	background-color: #4099FF;
}
.color-primary {
	color: #4099FF;
}
.font-main {
	font-size: 2em;
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
						<li class="breadcrumb-item"><a href="{{ route('main') }}">Dashboard</a></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-xl-3 col-md-6">
			<div class="card prod-p-card card-blue">
				<div class="card-body">
					<div class="row align-items-center m-b-30">
						<div class="col">
							<h6 class="m-b-5 text-white">Total</h6>
							<h3 class="m-b-0 f-w-700 text-white">{{ number_format($data['total']) }}</h3>
						</div>
						<div class="col-auto">
							<i class="fas fa-database text-c-blue f-18"></i>
						</div>
					</div>
					<p class="m-b-0 text-white"><span class="label label-primary m-r-10">+{{ number_format($data['today']) }}</span>Today</p>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6">
			<div class="card prod-p-card card-red">
				<div class="card-body">
					<div class="row align-items-center m-b-30">
						<div class="col">
							<h6 class="m-b-5 text-white">Confirmed</h6>
								<h3 class="m-b-0 f-w-700 text-white">{{ number_format($data['confirmed']) }}</h3>
						</div>
						<div class="col-auto">
							<i class="fas fas fa-user text-c-red f-18"></i>
						</div>
					</div>
					<p class="m-b-0 text-white"><span class="label label-danger m-r-10">{{ number_format($data['confirmed_pc'], 2) }}%</span></p>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6">
			<div class="card prod-p-card card-green">
				<div class="card-body">
					<div class="row align-items-center m-b-30">
						<div class="col">
							<h6 class="m-b-5 text-white">Excluded</h6>
							<h3 class="m-b-0 f-w-700 text-white">{{ number_format($data['excluded']) }}</h3>
						</div>
						<div class="col-auto">
							<i class="fas fas fa-user text-c-green f-18"></i>
						</div>
					</div>
					<p class="m-b-0 text-white"><span class="label label-success m-r-10">{{ number_format($data['excluded_pc'], 2) }}%</span></p>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6">
			<div class="card prod-p-card card-yellow">
				<div class="card-body">
					<div class="row align-items-center m-b-30">
						<div class="col">
							<h6 class="m-b-5 text-white">PUI</h6>
							<h3 class="m-b-0 f-w-700 text-white">{{ number_format($data['pui']) }}</h3>
						</div>
						<div class="col-auto">
							<i class="fas fas fa-user text-c-yellow f-18"></i>
						</div>
					</div>
					<p class="m-b-0 text-white"><span class="label label-warning m-r-10">{{ number_format($data['pui_pc'], 2) }}%</span></p>
				</div>
			</div>
		</div>
</div>



	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">

					<div class="row">
						<div class="col-md-3">
							<div class="card m-t-0">
								<div class="row">
									<div class="col-md-6 text-center p-t-10">
										<h3 class="mb-0 font-weight-bold">6,113</h3>
										<span class="text-muted">Recovered</span>
									</div>
									<div class="col-md-6">
										<div class="peity_bar_bad left text-center m-t-10">
											<span>
												<i class="fas fa-circle color-danger"></i>
											</span>
											<h6>10%</h6>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card m-t-0">
								<div class="row">
									<div class="col-md-6 text-center p-t-10">
										<h3 class="mb-0 font-weight-bold">4,560</h3>
										<span class="text-muted">Admitted</span>
									</div>
									<div class="col-md-6">
										<div class="peity_bar_bad left text-center m-t-10">
											<span>
												<i class="fas fa-circle color-danger"></i>
											</span>
											<h6>10%</h6>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card m-t-0">
								<div class="row">
									<div class="col-md-6 text-center p-t-10">
										<h3 class="mb-0 font-weight-bold">532,221</h3>
										<span class="text-muted">Death</span>
									</div>
									<div class="col-md-6">
										<div class="peity_bar_bad left text-center m-t-10">
											<span>
												<i class="fas fa-circle color-success"></i>
											</span>
											<h6>70%</h6>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card m-t-0">
								<div class="row">
									<div class="col-md-6 text-center p-t-10">
										<h3 class="mb-0 font-weight-bold">1,560</h3>
										<span class="text-muted">Self quarantine</span>
									</div>
									<div class="col-md-6">
										<div class="peity_bar_bad left text-center m-t-10">
											<span>
												<i class="fas fa-circle color-primary"></i>
											</span>
											<h6>20%</h6>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>

		</div>
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
