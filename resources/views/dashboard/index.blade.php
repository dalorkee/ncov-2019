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
.color-green {
	color: #5AA469;
}
.color-red {
	color: #D35D6E;
}
.color-brown {
	color: #AA8976;
}
.color-black {
	color: #707070;
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
						<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<p>Under Construction.</p>
	<!--
	<div class="row">
		<div class="col-xl-3 col-md-6">
            <a href="{ route('vaccineReport') }}">
                <div class="card prod-p-card card-blue">
                    <div class="card-body">
                        <div class="row align-items-center m-b-30">
                            <div class="col">
                                {{-- <h6 class="m-b-5 text-white">วัคซีน</h6> --}}
                                <h3 class="m-b-0 f-w-700 text-white">วัคซีน</h3>
                                {{-- <h3 class="m-b-0 f-w-700 text-white">{{ number_format($data['total']) }}</h3> --}}
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-database text-c-blue f-18"></i>
                            </div>
                        </div>
                        {{-- <p class="m-b-0 text-white"><span class="label label-primary m-r-10">+{{ number_format($data['today']) }}</span>Today</p> --}}
                    </div>
                </div>
            </a>
		</div>
		<div class="col-xl-3 col-md-6">
			<div class="card prod-p-card card-red">
				<div class="card-body">
					<div class="row align-items-center m-b-30">
						<div class="col">
                            <h3 class="m-b-0 f-w-700 text-white">สถานการณ์โรค</h3>
							<h6 class="m-b-5 text-white">กำลังปรับปรุง</h6>
						</div>
						<div class="col-auto">
							{{-- <i class="fas fas fa-user text-c-red f-18"></i> --}}
						</div>
					</div>
					{{-- <p class="m-b-0 text-white"><span class="label label-danger m-r-10">{{ number_format($data['confirmed_pc'], 2) }}%</span></p> --}}
				</div>
			</div>
		</div>

		{{-- <div class="col-xl-3 col-md-6">
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
		</div> --}}
	</div>
	{{-- <div class="row">
		<div class="col-xl-12">
			<div class="card proj-progress-card">
				<div class="card-block">
			 		<div class="row">
						<div class="col-xl-3 col-md-6">
							<h6>Recovered</h6>
							<h5 class="m-b-30 f-w-700">{{ number_format($data['recovered']) }}<span class="text-c-green m-l-10">{{ number_format($data['recovered_pc'], 2) }}%</span></h5>
							<div class="progress">
								<div class="progress-bar bg-c-green" style="width:{{ number_format($data['recovered_pc'], 2) }}%"></div>
							</div>
						</div>
						<div class="col-xl-3 col-md-6">
							<h6>Admitted</h6>
							<h5 class="m-b-30 f-w-700">{{ number_format($data['admitted']) }}<span class="text-c-green m-l-10">{{ number_format($data['admitted_pc'], 2) }}%</span></h5>
							<div class="progress">
								<div class="progress-bar bg-c-blue" style="width:{{ number_format($data['admitted_pc'], 2) }}%"></div>
							</div>
						</div>
						<div class="col-xl-3 col-md-6">
							<h6>Death (All disease)</h6>
							<h5 class="m-b-30 f-w-700">{{ number_format($data['death']) }}<span class="text-c-red m-l-10">{{ number_format($data['death_pc'], 2) }}%</span></h5>
							<div class="progress">
								<div class="progress-bar bg-c-red" style="width:{{ number_format($data['death_pc'], 2) }}%"></div>
							</div>
						</div>
						<div class="col-xl-3 col-md-6">
							<h6>Self quarantine</h6>
							<h5 class="m-b-30 f-w-700">{{ number_format($data['sq']) }}<span class="text-c-green m-l-10">{{ number_format($data['sq_pc'], 2) }}%</span></h5>
							<div class="progress">
								<div class="progress-bar bg-c-yellow" style="width:{{ number_format($data['sq_pc'], 2) }}%"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> --}}
-->
	<!--
	<div class="row">
		<div class="col-md-12 col-xl-8">
			<div class="card sale-card">
				<div class="card-header">
					<h5>Deals Analytics</h5>
				</div>
				<div class="card-block">
					<div id="deal-analytic-chart" class="chart-shadow" style="height:300px"></div>
				</div>
			</div>
		</div>
	</div>
	-->
</div>
@endsection
@section('bottom-script')
<?php
/*
	$ts = time();
	$signature = "bd6efdd618ef8e481ba2e247b10735b801fbdefe";
	$uid = Auth::user()->id;
	$sig = sha1($uid.$ts.$signature);
	$url_gen_lab = "http://viral.ddc.moph.go.th/viral/token.php?uid=".$uid."&ts=".$ts."&sig=".$sig."&typelab=1";
	$url_lab_result = "http://viral.ddc.moph.go.th/viral/token.php?uid=".$uid."&ts=".$ts."&sig=".$sig."&typelab=2";
	*/
?>
@endsection
