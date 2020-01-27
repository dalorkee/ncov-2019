@extends('layouts.index')
@section('custom-style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/toastr/build/toastr.min.css') }}">
<style>
input:-moz-read-only { /* For Firefox */
	background-color: #fafafa !important;
}
input:read-only {
	background-color: #fafafa !important;
}
</style>
@endsection
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contents')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Form 001</h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Form 001</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="card">
				<div class="card-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
							</ul>
						</div>
					@endif
					<div class="d-md-flex align-items-center mb-2">
						<div>
							<h4 class="card-title">แบบสอบสวนของผู้ป่วยโรคปอดอักเสบจากเชื้อไวรัสโคโรนาสายพันธุ์ใหม่ 2019</h4>
							<h5 class="card-subtitle">2019-nCoV</h5>
						</div>
					</div>
					<form action="{{ route('confirmCase') }}" method="POST" class="form-horizontal">
						{{ csrf_field() }}
						<h3 class="text-primary">ส่วนที่ 1</h3>
						<div class="bd-callout bd-callout-info" style="margin-top:0;">
							@include('form.confirm.section1')
						</div><!-- bd-collout1 -->
						<div class="bd-callout bd-callout-danger" style="margin-top:0;">
							@include('form.confirm.section2')
						</div><!-- bd-collout2 -->
						<div class="bd-callout bd-callout-warning" style="margin-top:0;">
							@include('form.confirm.section3')
						</div><!-- bd-collout3 -->
						<div class="border-top">
							<div class="card-body">
								<button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('bottom-script')
	<script src="{{ URL::asset('assets/libs/jquery-blockUI/jquery.blockUI.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/bootstrap-validate-2.2.0/dist/bootstrap-validate.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
$(document).ready(function() {
	/* ajax request */
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	/* district */
	$('#select_province').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('districtFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_district').html(response);
					$('#select_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* sub district */
	$('#select_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('subDistrictFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_sub_district').html(response);
					$('#select_sub_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* district */
	$('#select_patient_province').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('districtFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_patient_district').html(response);
					$('#select_patient_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* sub district */
	$('#select_patient_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('subDistrictFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_patient_sub_district').html(response);
					$('#select_patient_sub_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* check box */
	$('.informant-chk').click(function() {
		$('.informant-chk').not(this).prop('checked', false);
	});

	$('.chk_risk2_1').click(function() {
		$('.chk_risk2_1').not(this).prop('checked', false);
	});

	$('.chk_risk2_2').click(function() {
		$('.chk_risk2_2').not(this).prop('checked', false);
	});

	$('.chk_risk2_3').click(function() {
		$('.chk_risk2_3').not(this).prop('checked', false);
	});

	$('.chk_risk2_4').click(function() {
		$('.chk_risk2_4').not(this).prop('checked', false);
	});

	$('.chk_risk2_5').click(function() {
		$('.chk_risk2_5').not(this).prop('checked', false);
	});

	$('.chk_risk2_5').click(function() {
		$('.chk_risk2_5').not(this).prop('checked', false);
	});

	$('.chk_risk2_6_his').click(function() {
		$('.chk_risk2_6_his').not(this).prop('checked', false);
	});

	$('.chk_risk2_7').click(function() {
		$('.chk_risk2_7').not(this).prop('checked', false);
	});

	$('.chk_risk2_8').click(function() {
		$('.chk_risk2_8').not(this).prop('checked', false);
	});

	$('.chk_risk2_9').click(function() {
		$('.chk_risk2_9').not(this).prop('checked', false);
	});

	$('.chk_risk2_10').click(function() {
		$('.chk_risk2_10').not(this).prop('checked', false);
	});

	$('.chk_risk3_2_pt').click(function() {
		$('.chk_risk3_2_pt').not(this).prop('checked', false);
	});

	$('.chk_risk3_3').click(function() {
		$('.chk_risk3_3').not(this).prop('checked', false);
	});

	$('.chk_risk3_3_smoking').click(function() {
		$('.chk_risk3_3_smoking').not(this).prop('checked', false);
	});

	$('.chk_risk3_3_drink').click(function() {
		$('.chk_risk3_3_drink').not(this).prop('checked', false);
	});

	$('.chk_risk3_4').click(function() {
		$('.chk_risk3_4').not(this).prop('checked', false);
	});

	/* symptom chk */
	$('.chk_data3_6_0Fever').click(function() {
		$('.chk_data3_6_0Fever').not(this).prop('checked', false);
	});

	$('.chk_data3_6_0Cough').click(function() {
		$('.chk_data3_6_0Cough').not(this).prop('checked', false);
	});

	$('.chk_data3_6_0Sore').click(function() {
		$('.chk_data3_6_0Sore').not(this).prop('checked', false);
	});

	$('.chk_data3_6_0Snot').click(function() {
		$('.chk_data3_6_0Snot').not(this).prop('checked', false);
	});

	$('.chk_data3_6_0Sputum').click(function() {
		$('.chk_data3_6_0Sputum').not(this).prop('checked', false);
	});

	$('.chk_data3_6_0Breate').click(function() {
		$('.chk_data3_6_0Breate').not(this).prop('checked', false);
	});

	$('.chk_data3_6_0Gasp').click(function() {
		$('.chk_data3_6_0Gasp').not(this).prop('checked', false);
	});

	$('.chk_data3_6_0Muscle').click(function() {
		$('.chk_data3_6_0Muscle').not(this).prop('checked', false);
	});

	$('.chk_data3_6_0Headache').click(function() {
		$('.chk_data3_6_0Headache').not(this).prop('checked', false);
	});

	$('.chk_data3_6_0Liquid').click(function() {
		$('.chk_data3_6_0Liquid').not(this).prop('checked', false);
	});

	$('.chk_data3_6_Tube').click(function() {
		$('.chk_data3_6_Tube').not(this).prop('checked', false);
	});

	$('.chk_data3_6_Antiv').click(function() {
		$('.chk_data3_6_Antiv').not(this).prop('checked', false);
	});



	/* date picker */
	$('#risk2_2Date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#risk2_6DateArrive').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#risk2_6Activity1DateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#risk2_6Activity2DateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#risk2_6Activity3DateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#risk2_6Activity4DateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#risk2_6Activity5DateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#risk2_6ArriveDate').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#risk2_6HistoryHospitalDate').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#risk2_10Date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#risk3_1sickDateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#risk3_2treatDateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#risk3_2admitDateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#risk3_4influVaccineChkYesInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#data3_6sickDate').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#data3_6BreathingTubeDate').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#data3_6AntiVirusDrugStartDate').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#data3_6AntiVirusDrugEndDate').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

});


</script>
@endsection
