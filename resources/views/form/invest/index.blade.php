@extends('layouts.index')
@section('custom-style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
<!--<link rel="stylesheet" type="text/css" href="{ URL::asset('assets/libs/toastr/build/toastr.min.css') }}"> -->
<style>
	input:-moz-read-only { /* For Firefox */
		background-color: #fafafa !important;
	}
	input:read-only {
		background-color: #fafafa !important;
	}
	.select-custom select option {
		padding: 18px!important;
	}
	.font-fira {
		font-family: 'Fira-code' !important;
	}
	.input-group .bootstrap-select.form-control {
		z-index: 0;
	}
	button {
		cursor: pointer;
	}
	.has-error input[type="text"], .has-error input[type="email"], .has-error select {
		border: 1px solid #a94442;
	}
	ul.err-msg {
		list-style-type: none;
		padding: 0;
	}
	ul.err-msg li {
		margin-left: 20px;
	}
	ul.err-msg li > i {
		padding-right: 8px;
	}
	.span-80 {
		width: 80px !important;
		display: inline-block;
	}
	.child-box {
		margin: 5px 0;
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
			<h4 class="page-title">Invest Form</h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('list-data.invest') }}">Invest</a></li>
						<li class="breadcrumb-item active" aria-current="page">Form</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	@include('flash::message')
	@if(Session::has('success'))
		<div class="alert alert-success">
			<i class="fas fa-check-circle"></i> {{ Session::get('success') }}
			@php
				Session::forget('success');
			@endphp
		</div>
	@elseif(Session::has('error'))
		<div class="alert alert-danger">
			<i class="fas fa-times-circle"></i> {{ Session::get('error') }}
			@php
				Session::forget('error');
			@endphp
		</div>
	@endif
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="card">
				<div class="card-body">
					<div class="d-md-flex align-items-center mb-2">
						<div>
							<h4 class="card-title">แบบสอบสวนของผู้ป่วยโรคปอดอักเสบจากเชื้อไวรัสโคโรนาสายพันธุ์ใหม่ 2019</h4>
							<h5 class="card-subtitle">COVID-19 Version 1.20</h5>
						</div>
					</div>
					@if(Session::has('success'))
						<div class="alert alert-success">
							<i class="fas fa-check-circle"></i> {{ Session::get('success') }}
							@php
								Session::forget('success');
							@endphp
						</div>
					@endif
					@if (count($errors) > 0)
						<div class = "alert alert-danger" style="margin-left:15px;">
							<h4 class="alert-heading"><i class=" fas fa-times-circle text-danger"></i> Error!</h4>
							<ul class="err-msg">
								@foreach ($errors->all() as $error)
									<li><i class="mdi mdi-alert-octagon text-danger"></i> {{ $error }}</li>
								@endforeach
							</ul>
							<hr>
							<p class="text-danger">โปรดตรวจสอบข้อมูลให้ถูกต้องอีกครั้ง ก่อนบันทึกใหม่</p>
						</div>
					@endif
					<form method="POST" action="{{ route('invest.store') }}" enctype="multipart/form-data" class="form-horizontal">
						{{ csrf_field() }}
						<div class="bd-callout bd-callout-info" style="margin-top:0;position:relative">
							<div style="position:absolute;top:10px;right:10px;z-index:1">
								<span class="btn btn-info font-weight-bold font-fira">{{ $invest_pt[0]['sat_id'] }}</span>
							</div>
							@include('form.invest.section1')
						</div><!-- bd-collout1 -->
						<div class="bd-callout bd-callout-custom-2" style="margin-top:0;">
							@include('form.invest.section2')
						</div><!-- bd-collout2 -->
						<div class="bd-callout bd-callout-custom-6" style="margin-top:0;">
							@include('form.invest.section3')
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
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	/* sick district */
	$('#select_sick_province').change(function() {
		if ($(this).val() != "0") {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('districtFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_sick_district').html(response).selectpicker("refresh");
					$('#select_sick_sub_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		} else {
			$('#select_sick_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker('refresh');
			$('#select_sick_sub_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
		}
	});

	/* sick sub district */
	$('#select_sick_district').change(function() {
		if ($(this).val() != "0") {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('subDistrictFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_sick_sub_district').html(response).selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		} else {
			$('#select_sick_sub_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
		}
	});

	/* sick district first */
	$('#select_sick_province_first').change(function() {
		if ($(this).val() != "0") {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('districtFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_sick_district_first').html(response).selectpicker("refresh");
					$('#select_sick_sub_district_first').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		} else {
			$('#select_sick_district_first').html('<option value="0">-- โปรดเลือก --</option>').selectpicker('refresh');
			$('#select_sick_sub_district_first').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
		}
	});

	/* sick sub district first */
	$('#select_sick_district_first').change(function() {
		if ($(this).val() != "0") {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('subDistrictFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_sick_sub_district_first').html(response).selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage) {
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		} else {
			$('#select_sick_sub_district_first').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
		}
	});

	$('#treat_first_province').change(function() {
		if ($(this).val() != "0") {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('districtFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#treat_first_district').html(response).selectpicker("refresh");
					$('#treat_first_sub_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
					$.ajax({
						method: "POST",
						url: "{{ route('hospitalFetch') }}",
						dataType: "HTML",
						data: {pid:id},
						success: function(hosp) {
							$('#treatFirstHospital').html(hosp).selectpicker("refresh");
						}
					});
				},
				error: function(jqXhr, textStatus, errorMessage) {
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		} else {
			$('#treat_first_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
			$('#treat_first_sub_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
			$('#treatFirstHospital').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
		}
	});

	$('#treat_first_district').change(function() {
		if ($(this).val() != "0") {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('subDistrictFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#treat_first_sub_district').html(response).selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		} else {
			$('#treat_first_sub_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
		}
	});

	$('#treat_place_province').change(function() {
		if ($(this).val() != "0") {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('districtFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#treat_place_district').html(response).selectpicker("refresh");
					$('#treat_place_sub_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
					$.ajax({
						method: "POST",
						url: "{{ route('hospitalFetch') }}",
						dataType: "HTML",
						data: {pid:id},
						success: function(hosp) {
							$('#treatPlaceHospital').html(hosp).selectpicker("refresh");
						}
					});
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		} else {
			$('#treat_place_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
			$('#treat_place_sub_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
			$('#treatPlaceHospital').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
		}
	});

	$('#treat_place_district').change(function() {
		if ($(this).val() != "0") {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('subDistrictFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#treat_place_sub_district').html(response).selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		} else {
			$('#treat_place_sub_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
		}
	});


	/* refer province */
	$('#patient_treat_status_refer_province').change(function() {
		if ($(this).val() != "0") {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('districtFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#refer_district').html(response).selectpicker("refresh");
					$('#refer_sub_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
					$.ajax({
						method: "POST",
						url: "{{ route('hospitalFetch') }}",
						dataType: "HTML",
						data: {pid:id},
						success: function(hosp) {
							$('#patient_treat_status_refer').html(hosp).selectpicker("refresh");
						}
					});
				},
				error: function(jqXhr, textStatus, errorMessage) {
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		} else {
			$('#refer_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
			$('#refer_sub_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
			$('#patient_treat_status_refer').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
		}
	});

	/* refer district */
	$('#refer_district').change(function() {
		if ($(this).val() != "0") {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('subDistrictFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#refer_sub_district').html(response).selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		} else {
			$('#refer_sub_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
		}
	});

	/* outbreak countery */
	$('#risk_stay_outbreak_country').change(function() {
		if ($(this).val() != "0") {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('cityFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_risk_stay_outbreak_city').html(response).selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		} else {
			$('#select_risk_stay_outbreak_city').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
		}
	});

	$('#risk_stay_outbreak_province').change(function() {
		if ($(this).val() != "0") {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('districtFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#risk_stay_outbreak_district').html(response).selectpicker("refresh");
					$('#risk_stay_outbreak_sub_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		} else {
			$('#risk_stay_outbreak_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
			$('#risk_stay_outbreak_sub_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
		}
	});

	$('#risk_stay_outbreak_district').change(function() {
		if ($(this).val() != "0") {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('subDistrictFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#risk_stay_outbreak_sub_district').html(response).selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		} else {
			$('#risk_stay_outbreak_sub_district').html('<option value="0">-- โปรดเลือก --</option>').selectpicker("refresh");
		}
	});


	/* ประเภทที่พัก ขณะป่วย */
	$('.sick_stay_type-chk').click(function() {
		$('.sick_stay_type-chk').not(this).prop('checked', false);
	});

	/* โรคประจำตัว */
	$('.chk_risk3_3').click(function() {
		$('.chk_risk3_3').not(this).prop('checked', false);
	});

	/* ประวัติมีไข้ */
	$('.fever_history').click(function() {
		$('.fever_history').not(this).prop('checked', false);
	});

	/* ใส่ท่อช่วยหายใจ */
	$('.chk_breathing_Tube').click(function() {
		$('.chk_breathing_Tube').not(this).prop('checked', false);
	});

	/* x-ray  */
	$('.chk_cxr').click(function() {
		$('.chk_cxr').not(this).prop('checked', false);
	});

	/* lab result 1 */
	$('.lab_cxr1_result').click(function() {
		$('.lab_cxr1_result').not(this).prop('checked', false);
	});

	/* lab rapid test result */
	$('.lab_rapid_test_result').click(function() {
		$('.lab_rapid_test_result').not(this).prop('checked', false);
	});

	/* ประเภทผู้ป่วย ipd opd */
	$('.treat_patient_type').click(function() {
		$('.treat_patient_type').not(this).prop('checked', false);
	});

	/* สถานะผู้ป่วย */
	$('.chk-treatment').click(function() {
		$('.chk-treatment').not(this).prop('checked', false);
		let id = $(this).val();
		if (id != 4) {
			$('#patient_treat_status_refer_province').val(null).trigger('change');
			$('#refer_district').val(null).trigger('change');
			$('#refer_sub_district').val(null).trigger('change');
			$('#patient_treat_status_refer').val(null).trigger('change');
			$('#patient_treat_status_refer_date').val("");
		}
	});

	/* covid-19 drug check */
	$('.chk_covid19_drug').click(function() {
		$('.chk_covid19_drug').not(this).prop('checked', false);
	});

	/* โรคประจำตัว */
	$('.chk_congenital_disease').click(function() {
		$('.chk_congenital_disease').not(this).prop('checked', false);
	});

	/* มาจากพื้นที่การระบาด */
	$('.chk_risk_stay_outbreak').click(function() {
		$('.chk_risk_stay_outbreak').not(this).prop('checked', false);
	});

	$('.risk_treat_or_visit_patient').click(function() {
		$('.risk_treat_or_visit_patient').not(this).prop('checked', false);
	});

	$('.risk_care_flu_patient').click(function() {
		$('.risk_care_flu_patient').not(this).prop('checked', false);
	});

	$('.risk_contact_covid_19').click(function() {
		$('.risk_contact_covid_19').not(this).prop('checked', false);
	});

	$('.chk-risk-contact-tourist').click(function() {
		$('.chk-risk-contact-tourist').not(this).prop('checked', false);
	});


	$('.risk_travel_to_arena').click(function() {
		$('.risk_travel_to_arena').not(this).prop('checked', false);
	});

	$('.be_patient_cluster').click(function() {
		$('.be_patient_cluster').not(this).prop('checked', false);
	});

	$('.be_patient_critical_unknown_cause').click(function() {
		$('.be_patient_critical_unknown_cause').not(this).prop('checked', false);
	});

	$('.be_health_personel').click(function() {
		$('.be_health_personel').not(this).prop('checked', false);
	});

	/* date picker */
	$('#cls_data3_1date_sickdate').click(function() {
		$('input[name=data3_1date_sickdate]').val("");
	});
	$('#data3_1date_sickdate').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#cls_treat_first_date').click(function() {
		$('#treat_first_date').val("");
	});
	$('#treat_first_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#cls_breathing_tube_date').click(function() {
		$('#breathing_tube_date').val("");
	});
	$('#breathing_tube_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#cls_lab_cxr1_date').click(function() {
		$('#lab_cxr1_date').val("");
	});
	$('#lab_cxr1_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	/* cbc date */
	$('#cls_lab_cbc_date').click(function() {
		$('#lab_cbc_date').val("");
	});
	$('#lab_cbc_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#cls_lab_rapid_test_date').click(function() {
		$('#lab_rapid_test_date').val("");
	});
	$('#lab_rapid_test_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#cls_sars_cov2_date1').click(function() {
		$('#sars_cov2_date1').val("");
	});
	$('#sars_cov2_date1').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#cls_sars_cov2_date2').click(function() {
		$('#sars_cov2_date2').val("");
	});
	$('#sars_cov2_date2').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#cls_treat_place_date').click(function() {
		$('#treat_place_date').val("");
	});
	$('#treat_place_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#cls_covid19_drug_medicate_first_date').click(function() {
		$('#covid19_drug_medicate_first_date').val("");
	});
	$('#covid19_drug_medicate_first_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#cls_riskStayOutbreakArriveDate').click(function() {
		$('#riskStayOutbreakArriveDate').val("");
	});
	$('#riskStayOutbreakArriveDate').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#cls_risk_stay_outbreak_arrive_thai_date').click(function() {
		$('#riskStayOutbreakArriveThaiDate').val("");
	});
	$('#riskStayOutbreakArriveThaiDate').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#cls_invest_date').click(function() {
		$('#invest_date').val("");
	});
	$('#invest_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	@for ($i=1; $i<=10; $i++)
		$('#cls_activity_date_{{$i}}').click(function() {
			$('#activity_date_{{$i}}').val("");
		});
		$('#activity_date_{{$i}}').datepicker({
			format: 'dd/mm/yyyy',
			todayHighlight: true,
			todayBtn: true,
			autoclose: true
		});
	@endfor

	$('#cls_patient_treat_status_refer_date').click(function() {
		$('#patient_treat_status_refer_date').val("");
	});
	$('#patient_treat_status_refer_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});
});
</script>
<script>
/* files input */
$(".custom-file-input").on("change", function() {
	var fileName = $(this).val().split("\\").pop();
	$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
@endsection
