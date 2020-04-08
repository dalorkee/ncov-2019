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
			<h4 class="page-title">Hospital Screening Form</h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('list-data.invest') }}">Hospital Screening</a></li>
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
							<h4 class="card-title">แบบสอบผู้ป่วยเข้าเกณฑ์เฝ้าระวังและสอบสวนโรค COVID-19 (Patient Under Investigation: PUI)</h4>
							<h5 class="card-subtitle">COVID-19</h5>
						</div>
					</div>
					<form action="{{ route('confirmCase') }}" method="POST" class="form-horizontal">
						{{ csrf_field() }}
						<div class="bd-callout bd-callout-info" style="margin-top:0;position:relative">

									<h1 class="text-info">1. ข้อมูลทั่วไป</h1>
									<div class="card">
										<div class="card-body" style="margin:0; padding:0 0 30px 0;">
											<div class="form-row">
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
													<div class="form-group">
														<label for="card_id">เลขบัตรประชาชน</label>
														<input type="text" name="card_id" class="form-control" id="card_id" placeholder="เลขบัตรประชาชน" required>
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
													<div class="form-group">
														<label for="passport">passport</label>
														<input type="text" name="passport" class="form-control" id="passport" placeholder="passport">
													</div>
												</div>

											</div>
											<div class="form-row">
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
													<div class="form-group">
														<label for="name_th">ชื่อ</label>
														<input type="text" name="name_th" class="form-control" id="name_th" placeholder="ชื่อ" required>
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
													<div class="form-group">
														<label for="lname_th">นามสกุล</label>
														<input type="text" name="lname_th" class="form-control" id="lname_th" placeholder="นามสกุล" required>
													</div>
												</div>
											</div>
											<div class="form-row">
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
													<div class="form-group">
														<label for="name_th">HN</label>
														<input type="text" name="name_th" class="form-control" id="name_th" placeholder="ชื่อ" required>
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
													<div class="form-group">
														<label for="lname_th">เบอร์โทรศัพท์</label>
														<input type="text" name="lname_th" class="form-control" id="lname_th" placeholder="นามสกุล" required>
													</div>
												</div>
											</div>
											<div class="form-row">
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
													<div class="form-group">
														<label for="f_name_en">อักษรตัวแรกของชื่อภาษาอังกฤษ</label>
														<select name="f_name_en" class="form-control selectpicker show-tick" data-live-search="true" id="f_name_en">
															<option value="">-- โปรดเลือก --</option>
															<option value="A">A</option>
															<option value="B">B</option>
															<option value="C">C</option>
															<option value="D">D</option>
															<option value="E">E</option>
															<option value="F">F</option>
															<option value="G">G</option>
															<option value="H">H</option>
															<option value="I">I</option>
															<option value="J">J</option>
															<option value="K">K</option>
															<option value="L">L</option>
															<option value="M">M</option>
															<option value="N">N</option>
															<option value="O">O</option>
															<option value="P">P</option>
															<option value="Q">Q</option>
															<option value="R">R</option>
															<option value="S">S</option>
															<option value="T">T</option>
															<option value="U">U</option>
															<option value="V">V</option>
															<option value="W">W</option>
															<option value="X">X</option>
															<option value="Y">Y</option>
															<option value="Z">Z</option>
														</select>
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
													<div class="form-group">
														<label for="f_lname_en">อักษรตัวแรกของนามสกุลภาษาอังกฤษ</label>
														<select name="f_lname_en" class="form-control selectpicker show-tick" data-live-search="true" id="f_lname_en">
															<option value="">-- โปรดเลือก --</option>
															<option value="A">A</option>
															<option value="B">B</option>
															<option value="C">C</option>
															<option value="D">D</option>
															<option value="E">E</option>
															<option value="F">F</option>
															<option value="G">G</option>
															<option value="H">H</option>
															<option value="I">I</option>
															<option value="J">J</option>
															<option value="K">K</option>
															<option value="L">L</option>
															<option value="M">M</option>
															<option value="N">N</option>
															<option value="O">O</option>
															<option value="P">P</option>
															<option value="Q">Q</option>
															<option value="R">R</option>
															<option value="S">S</option>
															<option value="T">T</option>
															<option value="U">U</option>
															<option value="V">V</option>
															<option value="W">W</option>
															<option value="X">X</option>
															<option value="Y">Y</option>
															<option value="Z">Z</option>
														</select>
													</div>
												</div>
											</div>
											<h1 class="card-title m-b-0 m-t-0 text-info" style="margin-top:10px;">2. อาการและอาการแสดง</h1>
										<ul class="list-style-none">
											<li class="card-body">
												<div class="form-row">
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
														<div class="form-group">
															<label for="villageNo">ผลตรวจ COVID-19</label>
															<div class="card">
																<div class="custom-control custom-radio custom-control-inline">
																	<input type="radio" name="covid_result" value="y" class="custom-control-input covid_result" id="covid_result_yes">
																	<label for="covid_result_yes" class="custom-control-label normal-label">Positive</label>
																</div>
																<div class="custom-control custom-radio custom-control-inline">
																	<input type="radio" name="covid_result" value="n" class="custom-control-input covid_result" id="covid_result_no">
																	<label for="covid_result_no" class="custom-control-label normal-label">Negative</label>
																</div>
															</div>
														</div>
													</div>
												</div>
											</li>
											<li class="card-body border-top">
												<div class="form-row">
													<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
														<div class="form-group">
															<label for="villageNo">อุณหภูมิ (องศา)</label>
															<div class="input-group">
																<input type="text" name="temps" class="form-control" placeholder="อุณหภูมิ" required>
																<div class="input-group-append">
																	<span class="input-group-text">C&#176;</span>
																</div>
															</div>
														</div>
													</div>
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
														<div class="form-group">
															<label for="villageNo">ประวัติมีไข้</label>
															<div class="card">
																<div class="custom-control custom-radio custom-control-inline">
																	<input type="radio" name="fever" value="y" class="custom-control-input fever" id="fever_yes">
																	<label for="fever_yes" class="custom-control-label normal-label">มี</label>
																</div>
																<div class="custom-control custom-radio custom-control-inline">
																	<input type="radio" name="fever" value="n" class="custom-control-input fever" id="fever_no">
																	<label for="fever_no" class="custom-control-label normal-label">ไม่มี</label>
																</div>
															</div>
														</div>
													</div>
													<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
														<div class="form-group">
															<label for="informant">อาการ</label>
															<div class="card">
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="cough" value="y" class="custom-control-input cough" id="coughChk">
																	<label for="coughChk" class="custom-control-label normal-label">ไอ</label>
																</div>
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="running_nose" value="y" class="custom-control-input running_nose" id="running_noseChk">
																	<label for="running_noseChk" class="custom-control-label normal-label">น้ำมูก</label>
																</div>
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="sore_throat" value="y" class="custom-control-input sore_throat" id="sore_throatChk">
																	<label for="sore_throatChk" class="custom-control-label normal-label">เจ็บคอ</label>
																</div>
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="dyspnea" value="y" class="custom-control-input dyspnea" id="dyspneaChk">
																	<label for="dyspneaChk" class="custom-control-label normal-label">หายใจเหนื่อย/หายใจลำบาก</label>
																</div>
															</div>
														</div>
													</div>
												</div>
											</li>
											<li class="card-body border-top">
												<div class="form-row">
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
														<div class="form-group">
															<label for="villageNo">ปัจจัยเสี่ยง</label>
															<div class="card">
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="from_risk_place" value="y" class="custom-control-input from_risk_place" id="from_risk_place_Chk">
																	<label for="from_risk_place_Chk" class="custom-control-label normal-label">มีประวัติเดินทางไปยัง หรือ มาจาก หรืออยู่อาศัยในพื้นที่เสี่ยงตามระบุ</label>
																</div>
																<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
																	<div class="form-group">
																		<label for="country">ประเทศ</label>
																		<select name="country" class="form-control selectpicker show-tick" id="country">
																			<option value="">-- โปรดเลือก --</option>
																		</select>
																	</div>
																</div>
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="occu_contact_foreign" value="y" class="custom-control-input occu_contact_foreign" id="occu_contact_foreign_Chk">
																	<label for="occu_contact_foreign_Chk" class="custom-control-label normal-label">เป็นผู้ที่ประกอบอาชีพที่สัมผัสใกล้ชิดกับนักท่องเที่ยวต่างชาติ</label>
																</div>
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="contact_confirm" value="y" class="custom-control-input contact_confirm" id="contact_confirm_Chk">
																	<label for="contact_confirm_Chk" class="custom-control-label normal-label">มีประวัติใกล้ชิดหรือสัมผัสกับผู้ป่วยยืนยันโรคติดเชื้อไวรัสโควิท19</label>
																</div>
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="hcw_contact_confirm" value="y" class="custom-control-input hcw_contact_confirm" id="hcw_contact_confirm_Chk">
																	<label for="hcw_contact_confirm_Chk" class="custom-control-label normal-label">เป็นบุคลากรทางการแพทย์หรือสาธารณสุข ที่สัมผัสใกล้ชิดกับผู้ป่วยเข้าเกณฑ์สอบสวนโรคติดเชื้อโควิท19</label>
																</div>
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="from_meeting_place" value="y" class="custom-control-input from_meeting_place" id="from_meeting_place_Chk">
																	<label for="from_meeting_place_Chk" class="custom-control-label normal-label">มีประวัติไปในสถานที่ชุมนุมและมีผู้ป่วยโรคติดเชื้อโควิท19 ในช่วงเวลาเดียวกันกับผู้ป่วย ตามประกาศของคณะกรรมการโรคติดต่อจังหวัด</label>
																</div>
															</div>
														</div>
													</div>
												</div>
											</li>
											<li class="card-body">
												<div class="form-row">
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
														<div class="form-group">
															<label for="villageNo">ผู้ป่วยโรคปอดอักเสบ</label>
															<div class="card">
																<div class="custom-control custom-radio custom-control-inline">
																	<input type="radio" name="pneumonia" value="y" class="custom-control-input pneumonia" id="pneumonia_yes">
																	<label for="pneumonia_yes" class="custom-control-label normal-label">ใช่</label>
																</div>
																<div class="custom-control custom-radio custom-control-inline">
																	<input type="radio" name="pneumonia" value="n" class="custom-control-input pneumonia" id="cpneumonia_no">
																	<label for="pneumonia_no" class="custom-control-label normal-label">ไม่ใช่</label>
																</div>
															</div>
														</div>
													</div>
												</div>
											</li>
											<li class="card-body border-top">
												<div class="form-row">
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
														<div class="form-group">
															<label for="villageNo">ปัจจัยเสี่ยง</label>
															<div class="card">
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="hcw" value="y" class="custom-control-input hcw" id="hcw_Chk">
																	<label for="hcw_Chk" class="custom-control-label normal-label">เป็นบคลากรทางการแพทย์หรือสาธารณสุข</label>
																</div>
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="not_better_2day" value="y" class="custom-control-input not_better_2day" id="not_better_2day_Chk">
																	<label for="not_better_2day_Chk" class="custom-control-label normal-label">หาสาเหตุไม่ได้ และ รักษาแล้วอาการไม่ดีขึ้นภายใน 48 ชั่วโมง</label>
																</div>
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="severe_pneumonia" value="y" class="custom-control-input severe_pneumonia" id="severe_pneumonia_Chk">
																	<label for="severe_pneumonia_Chk" class="custom-control-label normal-label">มีอาการรุนแรง หรือ เสียชีวิตโดยหาสาเหตุไม่ได้</label>
																</div>
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="film_xray" value="y" class="custom-control-input film_xray" id="film_xray_Chk">
																	<label for="film_xray_Chk" class="custom-control-label normal-label"> มีภาพถ่ายรังสีปอดเข้าได้กับโรคติดเชื้อโควิท19</label>
																</div>
															</div>
														</div>
													</div>
												</div>
											</li>
										</ul>
								</div>
							</div>
						</div><!-- bd-collout1 -->
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
	$('.selectpicker').selectpicker();
});
</script>
@endsection

<!-- card_id->add
passport->add
name_th = first_name
lname_th = last_name
f_name_en->add
f_lname_en->add
covid_result->add
temps = fever
fever = fever_history
cough = sym_cough
running_nose = sym_snot
sore_throat = sym_sore
dyspnea = sym_dyspnea
from_risk_place = risk_stay_outbreak_chk
country = travel_from_country,risk_stay_outbreak_country
occu_contact_foreign->add
contact_confirm->add
hcw_contact_confirm->add
from_meeting_place->add
pneumonia->add
hcw->add
not_better_2day->add
severe_pneumonia->add
film_xray->add
hos_id = isolated_hosp_code -->
