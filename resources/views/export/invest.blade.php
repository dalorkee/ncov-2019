@extends('layouts.index')
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('custom-style')
<link href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/date-range-picker/daterangepicker.css') }}" rel="stylesheet">
<link href="{{ URL::asset('fonts/fontawesome-free-5.13.0-web/css/fontawesome.min.css') }}" rel="stylesheet">
@endsection
@section('internal-style')
<style>
	#progress {
		margin: 2px 0;
		border: 1px solid #aaa;
		height: 16px;
	}
	#progress .bar {
		background-color: #1f262d;
		height: 16px;
		color: white;
	}
	#message {
		padding: 4px 0;
	}
</style>
@endsection
@section('contents')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Export</a></li>
						<li class="breadcrumb-item active" aria-current="page">PUI</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	@include('flash::message')
	<article class="card" style="border:2px dashed #eee">
		<section class="card-body">
			<form action="#" method="POST" enctype="multipart/form-data" class="form-horizontal">
			<!-- <form action="route" method="POST" enctype="multipart/form-data" class="form-horizontal"> -->
				{{ csrf_field() }}
				{{ method_field('POST') }}
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
						<div class="form-group">
							<label for="patient_status">สถานะผู้ป่วย</label>
							<select name="pt_status" class="form-control selectpicker show-tick" id="pt_status">
								<option value="all">-- All --</option>
								@foreach ($pt_status as $key => $value)
									<option value="{{ $key }}">{{ $value }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group">
							<label for="date">เลือกช่วงเวลาที่ต้องการส่งออกข้อมูล (ไม่ควรเกิน 7 วัน/ครั้ง)</label>
							<div class="input-group date" data-provide="datepicker" id="breathing_tube_date">
								<div class="input-group-append">
									<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
								</div>
								<input type="text" name="date_range" id="export_date" class="form-control" style="cursor: pointer;" readonly>
								<div class="input-group-append">
									<button type="button" class="btn btn-outline btn-primary" id="export_btn">ค้นหา</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			<div class="form-row">

				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<!--<div id="progress"></div>
					<div id="message"></div>-->
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="card">
						<div class="card-body">
							<ul class="chat-list loader" style="display:none;">
								<li class="chat-item">
									<div class="chat-img text-danger" style="font-size:2em;">
										<i class="fas fa-spinner fa-spin"></i>
									</div>
									<div class="chat-content">
										<h2 class="text-danger">กำลังเขียนข้อมูล โปรดรอให้ข้อความนี้หายไป...</h2>
										<div class="box text-info">ข้อมูลจำนวนมาก อาจใช้เวลานานหลายนาที</div>
									</div>
								</li>
							</ul>
							<div class="dl-section">
								<div id="dl-detail"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="card border-top">
			<div class="card-body">
				<h4 class="card-title m-t-0 m-b-0">Recent Exports</h4>
			</div>
			<div class="comment-widgets scrollable">
				@if (!is_null($recent_export_tasks))
					@php
						$i = 1;
					@endphp
					@foreach ($recent_export_tasks as $key => $value)
						<div class="d-flex flex-row comment-row m-t-0 {{ (($i > 1) ? 'border-top' : '') }}">
							<div class="p-2"><h1 class="error-title text-danger">{{ $i }}</h1></div>
							<div class="comment-text w-100">
								<h6 class="font-medium text-primary">{{ $value['file_name'] }}</h6>
								<span class="m-b-2 d-block">ดาวน์โหลดไปแล้ว: {{ $value['export_amount'] }} ครั้ง</span>
								<span class="m-b-2 d-block">ขนาด: {{ $value['file_size'] }} KB</span>
								<span class="m-b-10 d-block">สร้างไฟล์เมื่อ: {{ $value['created_at'] }}</span>
								<div class="comment-footer">
									<a href="{{ route('export.file', [$value['file_name']]) }}" title="Export" class="btn btn-cyan btn-sm btn-rounded waves-effect waves-light">ดาวน์โหลด</a>
								</div>
							</div>
						</div>
						@php
							$i++;
						@endphp
					@endforeach
				@endif
			</div>
		</section>
	</article>
</div>
@endsection
@section('bottom-script')
<script type="text/javascript" src="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/libs/date-range-picker/moment-2.18.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/libs/date-range-picker/daterangepicker.min.js') }}"></script>
<script>
/*
var timer, pmsg;
function refreshProgress() {
	$.ajax({
		method: 'GET',
		url: "{ route('checker', [Session::getId()]) }}",
		dataType: 'JSON',
		success:function(data){
			if (data.percent == null) {
				pmsg = '100';
			} else {
				pmsg = data.percent;
			}
			$("#progress").html('<div class="bar" style="width:' + data.percent + '%">' + pmsg + '%</div>');
			$("#message").html(data.message);
			if (data.percent == 100 || data.percent == null) {
				window.clearInterval(timer);
				timer = window.setInterval(completed(data.message), 1000);
			}
		},*/
		/*error: function(xhr) {
			alert(xhr.status + xhr.errorMessage + ' jet');
			window.clearInterval(timer);
		}*/
	/*});
}
function completed(rows) {
	$("#message").html("Completed. " + rows);
	window.clearInterval(timer);
}
*/
$(document).ready(function() {
	//$('#progress').hide();
	$('.dl-section').hide();
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#export_btn').click(function(e) {
		try {
			e.preventDefault();
			//$('#progress').show();
			$('.loader').show();
			$('.dl-section').hide();
			var date_range = $('#export_date').val();
			var pt_status = $('#pt_status').val();
			$.ajax({
				method: 'POST',
				url: "{{ route('export.search') }}",
				data: {date_range:date_range, pt_status:pt_status},
				dataType: "HTML",
				success: function(response) {
					$('.loader').hide();
					$('.dl-section').show();
					$('#dl-detail').html(response);
				},
				error: function(xhr) {
					alert(xhr.errorMessage + xhr.status);
					//window.clearInterval(timer);
				}
			});
			//timer = window.setInterval(refreshProgress, 1000);
		} catch(err) {
			alert(err.message);
			//window.clearInterval(timer);
		}
	});

	var currentdate = new Date();
	var startDate =  (currentdate.getMonth()+1) + "/" + (currentdate.getDate()-7) +  "/" + currentdate.getFullYear();
	var endDate =  (currentdate.getMonth()+1) + "/" +  currentdate.getDate() + "/" + currentdate.getFullYear();

	/* date range */
	$('#export_date').daterangepicker({
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
<script>
	$('[data-toggle="tooltip"]').tooltip();
	$(".preloader").fadeOut();
</script>
@endsection
