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
	.select-custom select option {
		padding: 18px!important;
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
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="card">
				<div class="card-body">
					<div class="d-md-flex align-items-center mb-2">
						<div>
							<h4 class="card-title">แบบสอบสวนของผู้ป่วยโรคปอดอักเสบจากเชื้อไวรัสโคโรนาสายพันธุ์ใหม่ 2019</h4>
							<h5 class="card-subtitle">COVID-19</h5>
						</div>
					</div>
					<form action="{{ route('confirmCase') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<div class="bd-callout bd-callout-info" style="margin-top:0;position:relative">
							<div style="position:absolute;top:10px;right:10px;z-index:1">
								<span class="btn btn-danger font-weight-bold" style="font-family: 'Fira-code';">{{ $invest_pt[0]['sat_id'] }}</span>
							</div>
							@include('form.confirm.section1')
						</div><!-- bd-collout1 -->
						<div class="bd-callout bd-callout-custom-2" style="margin-top:0;">
							@include('form.confirm.section2')
						</div><!-- bd-collout2 -->
						<div class="bd-callout bd-callout-custom-1" style="margin-top:0;">
							@include('form.confirm.section3')
						</div><!-- bd-collout3 -->
						<div class="bd-callout bd-callout-danger" style="margin-top:0;">
							@include('form.confirm.section4')
						</div><!-- bd-collout4 -->
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
<!-- modal delete confirmation -->
<div id="SavedModal" class="modal fade text-danger" role="dialog" aria-labelledby="SavedModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h5 class="modal-title text-center text-white">nCoV 2019</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true ">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="text-center">Successfully saved.</p>
			</div>
		</div>
	</div>
</div><!-- end confirmation delte -->
@endsection
@section('bottom-script')
<script src="{{ URL::asset('assets/libs/jquery-blockUI/jquery.blockUI.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-validate-2.2.0/dist/bootstrap-validate.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
/* flash message */
$('#flash-overlay-modal').modal();
</script>
<script>
$(document).ready(function() {
	/* ajax request */
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	/* work city */
	$('#select_work_country').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('cityFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_work_city').html(response);
					$('#select_work_city').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* current city */
	$('#select_cur_country').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('cityFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_cur_city').html(response);
					$('#select_cur_city').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* sick city */
	$('#select_sick_country').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('cityFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_sick_city').html(response);
					$('#select_sick_city').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* risk_stay_outbreak_city */
	$('#risk_stay_outbreak_country').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('cityFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_risk_stay_outbreak_city').html(response);
					$('#select_risk_stay_outbreak_city').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* risk_stay_outbreak_city */
	$('#treat_first_country').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('cityFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#treat_first_city').html(response);
					$('#treat_first_city').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* treat first_city */
	$('#treat_first_country').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('cityFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#treat_first_city').html(response);
					$('#treat_first_city').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* treat place city */
	$('#treat_place_country').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('cityFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#treat_place_city').html(response);
					$('#treat_place_city').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* work district */
	$('#select_work_province').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('districtFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_work_district').html(response);
					$('#select_work_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* work sub district */
	$('#select_work_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('subDistrictFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_work_sub_district').html(response);
					$('#select_work_sub_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* current district */
	$('#select_cur_province').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('districtFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_cur_district').html(response);
					$('#select_cur_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* current sub district */
	$('#select_cur_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('subDistrictFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_cur_sub_district').html(response);
					$('#select_cur_sub_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* sick district */
	$('#select_sick_province').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('districtFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_sick_district').html(response);
					$('#select_sick_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* sick sub district */
	$('#select_sick_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('subDistrictFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_sick_sub_district').html(response);
					$('#select_sick_sub_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* outbreak district */
	$('#risk_stay_outbreak_province').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('districtFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#risk_stay_outbreak_district').html(response);
					$('#risk_stay_outbreak_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* outbreak sub district */
	$('#risk_stay_outbreak_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('subDistrictFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#risk_stay_outbreak_sub_district').html(response);
					$('#risk_stay_outbreak_sub_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* treat first district */
	$('#treat_first_province').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('districtFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#treat_first_district').html(response);
					$('#treat_first_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* treat first sub district */
	$('#treat_first_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('subDistrictFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#treat_first_sub_district').html(response);
					$('#treat_first_sub_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* treat place district */
	$('#treat_place_province').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('districtFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#treat_place_district').html(response);
					$('#treat_place_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* treat place sub district */
	$('#treat_place_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('subDistrictFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#treat_place_sub_district').html(response);
					$('#treat_place_sub_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});


	/* check box */
	$('.flu-vaccine-chk').click(function() {
		$('.flu-vaccine-chk').not(this).prop('checked', false);
	});

	$('.chk_breathing_Tube').click(function() {
		$('.chk_breathing_Tube').not(this).prop('checked', false);
	});

	$('.chk_complication').click(function() {
		$('.chk_complication').not(this).prop('checked', false);
	});

	$('.chk_antivirus').click(function() {
		$('.chk_antivirus').not(this).prop('checked', false);
	});

	$('.chk_risk_stay_outbreak').click(function() {
		$('.chk_risk_stay_outbreak').not(this).prop('checked', false);
	});

	$('.risk_history_human_contact_symptom').click(function() {
		$('.risk_history_human_contact_symptom').not(this).prop('checked', false);
	});

	$('.risk_patient_pneumonia_dead').click(function() {
		$('.risk_patient_pneumonia_dead').not(this).prop('checked', false);
	});

	$('.risk_closeup_flu_or_pneumonia').click(function() {
		$('.risk_closeup_flu_or_pneumonia').not(this).prop('checked', false);
	});

	$('.lab_sputum_culture_result').click(function() {
		$('.lab_sputum_culture_result').not(this).prop('checked', false);
	});

	$('.lab_hemoculture_result').click(function() {
		$('.lab_hemoculture_result').not(this).prop('checked', false);
	});

	$('.lab_cxr1_result').click(function() {
		$('.lab_cxr1_result').not(this).prop('checked', false);
	});

	$('.lab_cxr2_result').click(function() {
		$('.lab_cxr2_result').not(this).prop('checked', false);
	});

	$('.lab_rapid_test_result').click(function() {
		$('.lab_rapid_test_result').not(this).prop('checked', false);
	});

	$('.risk_history_human_contact').click(function() {
		$('.risk_history_human_contact').not(this).prop('checked', false);
	});

	$('.risk_eat_cook_animal').click(function() {
		$('.risk_eat_cook_animal').not(this).prop('checked', false);
	});

	$('.risk_contact_poultry').click(function() {
		$('.risk_contact_poultry').not(this).prop('checked', false);
	});

	$('.risk_poultry_dead').click(function() {
		$('.risk_poultry_dead').not(this).prop('checked', false);
	});

	$('.risk_poultry_market').click(function() {
		$('.risk_poultry_market').not(this).prop('checked', false);
	});

	$('.risk_poultry_market_ii').click(function() {
		$('.risk_poultry_market_ii').not(this).prop('checked', false);
	});

	$('.risk_treat_or_visit_patient').click(function() {
		$('.risk_treat_or_visit_patient').not(this).prop('checked', false);
	});

	$('.risk_care_flu_patient').click(function() {
		$('.risk_care_flu_patient').not(this).prop('checked', false);
	});

	$('.fever_history').click(function() {
		$('.fever_history').not(this).prop('checked', false);
	});

	$('.treat_patient_type').click(function() {
		$('.treat_patient_type').not(this).prop('checked', false);
	});

	$('.chk_risk3_3').click(function() {
		$('.chk_risk3_3').not(this).prop('checked', false);
	});

	/* date picker */
	$('#flu_vaccine_chk_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#flu_vaccine_chk_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#breathing_tube_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#antivirus_1_start_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#antivirus_1_end_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#antivirus_2_start_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#antivirus_2_end_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#antivirus_3_start_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#antivirus_3_end_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#antivirus_4_start_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#antivirus_4_end_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#risk_treat_or_visit_patient_hospital_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#cbcDateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#riskStayOutbreakArriveDate').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#riskStayOutbreakArriveThaiDate').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_cbc_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_chemistry_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_liver_function_test_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_sputum_afb_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_sputum_culture_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_hemoculture_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_cxr1_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_cxr2_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_rapid_test_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_other_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#data3_1date_sickdate').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#treat_first_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#treat_place_date').datepicker({
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
