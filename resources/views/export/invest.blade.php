@extends('layouts.index')
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('custom-style')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('contents')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Export</a></li>
						<li class="breadcrumb-item active" aria-current="page">Form</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	@include('flash::message')
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<article class="card" style="border: 2px dashed #eee">
				<section class="card-body">
					<form action="#" method="POST" enctype="multipart/form-data" class="form-horizontal">
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
							<div class="form-group">
								<label for="date">เลือกช่วงเวลาที่ต้องการส่งออกข้อมูล (MM/DD/YYYY)</label>
								<div class="input-group date" data-provide="datepicker" id="breathing_tube_date">
									<div class="input-group-append">
										<span class="input-group-text btn btn-outline-primary"><i class="mdi mdi-calendar"></i></span>
									</div>
									<input type="text" name="export_date_range" id="demo" class="form-control btn btn-outline-primary" style="cursor: pointer;">
									<div class="input-group-append">
										<button class="btn btn-outline btn-primary" type="button">Download</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</section>
			</article>
		</div>
		<ul>
			<li>
				<a href="#" id="query">From Query</a>
				<span class="loader" style="display:none;">Processing...</span>
			</li>
		</ul>
	</div>
</div>
@endsection
@section('bottom-script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#query').click(function(e) {
		$('.loader').show();
		e.preventDefault();
		$.ajax({
			url: "{ route('pj') }}",
			complete: function(res) {
				var path = res.responseJSON.path;
				location.href = path;
				$('.loader').hide();
			}
		});
	})
	var currentdate = new Date();
	var startDate =  (currentdate.getMonth()+1) + "/" + (currentdate.getDate()-7) +  "/" + currentdate.getFullYear();
	var endDate =  (currentdate.getMonth()+1) + "/" +  currentdate.getDate() + "/" + currentdate.getFullYear();

	/* date range */
	$('#demo').daterangepicker({
		"minYear": 2019,
		"maxYear": 2023,
		"maxSpan": {
			"days": 31
		},
		ranges: {
			'Today': [moment(), moment()],
			'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		"alwaysShowCalendars": true,
		"startDate": startDate,
		"endDate": endDate,
		"cancelClass": "btn-danger"
	}, function(start, end, label) {
		console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
	});
});
</script>
@endsection
