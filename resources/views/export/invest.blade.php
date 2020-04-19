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
        width: 500px;
        border: 1px solid #aaa;
        height: 20px;
      }
      #progress .bar {
        background-color: red;
        height: 20px;
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
						<li class="breadcrumb-item active" aria-current="page">Form</li>
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
								<input type="text" name="date_range" id="export_date" class="form-control" style="cursor: pointer;">
								<div class="input-group-append">
									<button type="button" class="btn btn-outline btn-primary" id="export_btn">ค้นหา</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			<!--<div id="progress"></div>
			<div id="message"></div>-->
			<div class="loader fa-2x" style="display:none;font-size:1.875em;"><i class="fas fa-spinner fa-spin"></i> กำลังเขียนข้อมูล โปรดรอ...</div>
			<div class="dl-section">
				<div id="dl-detail">
				</div>
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
var timer;
function refreshProgress() {
	$.ajax({
		url: "{{ route('getPg', ['aa']) }}",
		success:function(data){
			$("#progress").html('<div class="bar" style="width:' + data.percent + '%"></div>');
			$("#message").html(data.message);
			alert(data.percent);
			if (data.percent == 100) {
				window.clearInterval(timer);
				timer = window.setInterval(completed, 1000);
			}
		},
		error: function(xhr) {
			alert(xhr.status);
		}
	});
}
function completed() {
	$("#message").html("Completed");
	window.clearInterval(timer);
}
*/
$(document).ready(function() {
	$('.dl-section').hide();
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	//$.ajax({url: "{{ route('process') }}"});
	//timer = window.setInterval(refreshProgress, 1000);

	$('#export_btn').click(function(e) {
		try {
			e.preventDefault();
			$('.loader').show();
			var date_range = $('#export_date').val();
			var pt_status = $('#pt_status').val();
			$.ajax({
				method: 'POST',
				url: "{{ route('pj1') }}",
				data: {date_range:date_range, pt_status:pt_status},
				dataType: "HTML",
				success: function(response) {
					$('.loader').hide();
					$('.dl-section').show();
					$('#dl-detail').html(response);
				},
				error: function(xhr) {
					alert(xhr.errorMessage + xhr.status);
				}
			});
		} catch(err) {
			err.message;
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

@endsection
