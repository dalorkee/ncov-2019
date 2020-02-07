@extends('layouts.index')
@section('custom-style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/toastr/build/toastr.min.css') }}">
<?php
use App\Http\Controllers\ScreenPUIController as ScreenPUIController;

//dd($data->risk_stay_outbreak_arrive_date);

$notify_date = (!empty($data->notify_date)) ? ScreenPUIController::Convert_Date_To_Picker($data->notify_date) : "" ;
$risk2_6arrive_date = (!empty($data->risk_stay_outbreak_arrive_date)) ? ScreenPUIController::Convert_Date_To_Picker($data->risk_stay_outbreak_arrive_date) : "" ;
//$risk2_6arrive_date = $data->risk_stay_outbreak_arrive_date."ds";
//dd($risk2_6arrive_date);
$data3_1date_sickdate = (!empty($data->data3_1date_sickdate)) ? ScreenPUIController::Convert_Date_To_Picker($data->data3_1date_sickdate) : "" ;
$lab_send_date = (!empty($data->lab_send_date)) ? ScreenPUIController::Convert_Date_To_Picker($data->lab_send_date) : "" ;
?>
<style>
input:-moz-read-only { /* For Firefox */
	background-color: #fafafa !important;
}
input:read-only {
	background-color: #fafafa !important;
}
</style>
@endsection
@section('contents')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">ScreenPUI</h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">ScreenPUI</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
				@if(session()->has('message'))
		    <div class="alert alert-success" role="alert">
		        <p class="text-center">{{ session()->get('message') }}</p>
		    </div>
				@endif
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="card">
				<div class="card-body">

					<div class="d-md-flex align-items-center mb-2">
						<div>
							<h4 class="card-title">แบบสอบสวนของผู้ป่วยโรคปอดอักเสบจากเชื้อไวรัสโคโรนาสายพันธุ์ใหม่ 2019</h4>
							<h5 class="card-subtitle">2019-nCoV</h5>
						</div>
					</div>
					<form action="{{ route('screenpui.update') }}" method="POST" class="form-horizontal">
						{{ csrf_field() }}
						<h3 class="text-primary">ส่วนที่ 1</h3>
						<div class="bd-callout bd-callout-info" style="margin-top:0;position:relative">
							<div class="card">
								<div class="card-body">
									<h1 class="text-info">1. ข้อมูลทั่วไปของผู้ป่วย</h1>
									<div class="form-group row">
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
											<label for="workPhone">วันที่ได้รับแจ้ง</label>
											<input type="text" name="notify_date" id="notify_date" value="{{ $notify_date }}" class="form-control" required="">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-2">
											<label for="workPhone">เวลาได้รับแจ้ง</label>
											<input type="text" class="form-control" name="notify_time" value="@if(isset($data->notify_time)) {{ $data->notify_time }} @endif" data-timepicker>
										</div>
									</div>
									<div class="form-group row">
                                    <label class="col-md-3">การคัดกรอง</label>
                                    <div class="col-md-9">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" @if($data->screen_pt==1) checked @endif id="customControlValidation_rd1" value="1" name="screen_pt" required="">
                                            <label class="custom-control-label" for="customControlValidation_rd1">คัดกรองที่สนามบิน</label>
                                        </div>
                                         <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" @if($data->screen_pt==2) checked @endif id="customControlValidation_rd2" value="2" name="screen_pt" required="">
                                            <label class="custom-control-label" for="customControlValidation_rd2">Walkin มาที่ รพ.</label>
                                        </div>
                                    </div>
                  </div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
											<label for="dowork">สถานที่ (ชื่อสนามบิน/รพ.)</label>
											<input type="text" name="walkinplace_hosp" class="form-control" value="@if(isset($data->walkinplace_hosp)) {{ $data->walkinplace_hosp }} @endif" placeholder="ชื่อสนามบิน/รพ.">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
											<div class="form-group">
												<label for="informant">มีห้อง Neagtive pressure หรือไม่</label>
												<div>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" value="Y" class="custom-control-input" id="customControlValidation1" @if($data->negative_pressure=='Y') checked @endif name="negative_pressure" required="">
														<label class="custom-control-label" for="customControlValidation1">มี</label>
													</div>
													 <div class="custom-control custom-radio custom-control-inline">
															<input type="radio" value="N" class="custom-control-input" id="customControlValidation2" @if($data->negative_pressure=='N') checked @endif name="negative_pressure" required="">
															<label class="custom-control-label" for="customControlValidation2">ไม่มี</label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-4">
											<div class="form-group">
												<label for="informant">มีรถ Refer ผู้ป่วยหรือไม่ หรือไม่</label>
												<div>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" value="Y" class="custom-control-input" id="customControlValidation3" @if($data->refer_car=='Y') checked @endif name="refer_car" required="">
														<label class="custom-control-label" for="customControlValidation3">มี</label>
													</div>
													 <div class="custom-control custom-radio custom-control-inline">
															<input type="radio" value="N" class="custom-control-input" id="customControlValidation4" @if($data->refer_car=='N') checked @endif name="refer_car" required="">
															<label class="custom-control-label" for="customControlValidation4">ไม่มี</label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-4">
											<label for="dowork">ผู้ป่วย Isolated ที่ รพ.</label>
											<input type="text" name="risk2_6history_hospital_input" value="@if($data->risk2_6history_hospital_input) {{ $data->risk2_6history_hospital_input }} @endif" class="form-control" placeholder="ชื่อ รพ.">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-4">
											<label for="dowork">จังหวัด</label>
											<select name="isolated_province" class="form-control selectpicker show-tick select-title-name" data-live-search="true" id="occupation">
												<option value="0">-- โปรดเลือก --</option>
													@foreach($provinces as $key5=>$val5) {
														<option value="{{ $val5['province_id'] }}" @if($data->isolated_province==$val5['province_id']) selected @endif>{{ $val5['province_name'] }}</option>
													@endforeach
											</select>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
											<h1 class="text-info">2. ข้อมูลการเดินทาง</h1>
											<div class="form-group">
												<label for="informant">เดินทางมาจากเมืองที่มีการระบาดหรือไม่</label>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
											<div class="form-group">
												<label for="informant">ชื่อเมือง</label>
												<input type="text" name="travel_from" value="@if($data->travel_from) {{ $data->travel_from }} @endif" id="travel_from" class="form-control">
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
											<label for="workPhone">วันที่มาถึงไทย</label>
											<input type="text" name="risk2_6arrive_date" value="@if($risk2_6arrive_date) {{ $risk2_6arrive_date }} @endif" id="datepicker1" class="form-control">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
											<label for="workPhone">สายการบิน</label>
											<input type="text" name="risk2_6airline_input" value="@if($data->risk_stay_outbreak_airline) {{ $data->risk_stay_outbreak_airline }} @endif" class="form-control" placeholder="สายการบิน">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
											<label for="workPhone">เที่ยวบิน</label>
											<input type="text" name="risk2_6flight_no_input" value="@if($data->risk_stay_outbreak_flight_no) {{ $data->risk_stay_outbreak_flight_no }} @endif" class="form-control" placeholder="เที่ยวบิน">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
											<label for="workPhone"><small>จำนวนผู้ร่วมเดินทางในกลุ่มเดียวกัน(คน)</small></label>
											<input type="text" name="total_travel_in_group" value="@if($data->total_travel_in_group) {{ $data->total_travel_in_group }} @endif"  class="form-control" placeholder="จำนวนคน">
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="titleName">คำนำหน้าชื่อ</label>
												<select name="title_name" class="form-control selectpicker show-tick select-title-name" data-live-search="true" id="title_name_input">
													<option value="0">-- โปรดเลือก --</option>
													@foreach($titleName as $key5=>$val5) {
														<option value="{{ $val5['id'] }}" @if($data->title_name==$val5['id']) selected @endif>{{ $val5['title_name'] }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group {{ $errors->has('firstNameInput') ? 'has-error' : '' }}">
												<label for="firstName">ชื่อจริง</label>
												<input type="text" name="first_name" class="form-control" value="@if($data->first_name) {{ $data->first_name }} @endif" id="first_name_input" placeholder="ชื่อ" required>
											</div>
											<span class="text-danger">{{ $errors->first('firstNameInput') }}</span>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
											<div class="form-group">
												<label for="midName">ชื่อกลาง</label>
												<input type="text" name="mid_name" class="form-control" value="@if($data->mid_name) {{ $data->mid_name }} @endif" id="mid_name_input" placeholder="ชื่อกลาง">
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
											<div class="form-group">
												<label for="lastName">นามสกุล</label>
												<input type="text" name="last_name" class="form-control" value="@if($data->last_name) {{ $data->last_name }} @endif" id="last_name_input" placeholder="นามสกุล" required>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="sex">เพศ</label>
												<select name="sex" class="form-control selectpicker show-tick">
													<option value="">-- โปรดเลือก --</option>
													<option value="ชาย" @if($data->sex=="ชาย") selected @endif >ชาย</option>
													<option value="หญิง" @if($data->sex=="หญิง") selected @endif>หญิง</option>
												</select>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-1 col-xl-1 mb-3">
											<div class="form-group">
												<label for="age">อายุ/ปี</label>
												<input type="text" name="age" value="@if($data->age) {{ $data->age }} @endif" class="form-control" id="age_year_input" required>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="nationality">สัญชาติ</label>
												<select name="nation" class="form-control selectpicker show-tick" data-live-search="true" id="select_nationality">
													<option value="">-- โปรดเลือก --</option>
													@foreach($globalcountry as $val)
													<option value="{{ $val->country_id }}" @if($data->nation==$val->country_id) selected @endif >{{ $val->country_name }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="nationality">เชื้อชาติ</label>
												<select name="race" class="form-control selectpicker show-tick" data-live-search="true" id="select_race">
													<option value="">-- โปรดเลือก --</option>
													@foreach($globalcountry as $val)
													<option value="{{ $val->country_id }}" @if($data->race==$val->country_id) selected @endif >{{ $val->country_name }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 mb-2">
											<label for="occupation">อาชีพ</label>
											<select name="occupation" class="form-control selectpicker show-tick select-title-name" data-live-search="true" id="occupation">
												<option value="0">-- โปรดเลือก --</option>
													@foreach($occupation as $key=>$val) {
														<option value="{{ $val['id'] }}" @if($data->occupation==$val['id']) selected @endif >{{ $val['occu_name_th'] }}</option>
													@endforeach
											</select>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
											<label for="occupation_oth">อาชีพอื่นๆ</label>
											<input type="text" name="occupation_oth" value="@if($data->occupation_oth) {{ $data->occupation_oth }} @endif"  class="form-control" id="occupation_oth">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
											<div class="alert alert-danger" role="alert">
												<h6 class="alert-heading">คำแนะนำ: "อาชีพ" ระบุลักษณะงานที่ทำและหากเป็นเจ้าหน้าที่ทางการแพทย์หรือสาธารณสุขต้องระบุให้ชัดเจนว่าเป็นบุคลากรทางการแพทย์</h6>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-3">
											<label for="occupation">โรคประจำตัว</label>
										</div>
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="data3_3chk" value="n" @if($data->data3_3chk=="n") checked @endif class="custom-control-input chk_risk3_3" id="data3_3chkNo">
												<label for="data3_3chkNo" class="custom-control-label normal-label">ไม่มี</label>
											</div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="data3_3chk" value="y" @if($data->data3_3chk=="y") checked @endif class="custom-control-input chk_risk3_3" id="data3_3chkYes">
												<label for="data3_3chkYes" class="custom-control-label normal-label">มี (กรุณาทำเครื่องหมายด้านล่าง)</label>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
											<div class="table-responsive">
												<table class="table">
													</thead></thead>
													<tfoot></tfoot>
													<tbody>
														<tr id="risk3_3table_tr1">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_lung" value="y" @if($data->data3_3chk_lung=="y") checked @endif class="custom-control-input" id="data3_3chk_lung">
																	<label for="data3_3chk_lung" class="custom-control-label normal-label">
																		โรคปอดเรื้อรัง เช่น COPD, chronic bronchitis, chronic bronchiectasis, BPD, หรือหอบ (asthma) ที่กำลังรักษา
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr2">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_heart" value="y" @if($data->data3_3chk_heart=="y") checked @endif class="custom-control-input" id="data3_3chk_heart">
																	<label for="data3_3chk_heart" class="custom-control-label normal-label">
																		โรคหัวใจ เช่น หัวใจพิการแต่กำเนิด, โรคหลอดเลือดหัวใจ หรือ Congestive heart failure
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr3">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_cirrhosis" value="y" @if($data->data3_3chk_cirrhosis=="y") checked @endif class="custom-control-input" id="data3_3chk_cirrhosis">
																	<label for="data3_3chk_cirrhosis" class="custom-control-label normal-label">
																		โรคตับเรื้อรัง เช่น ตับแข็ง (Cirrhosis)
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr4">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_kidney" value="y" @if($data->data3_3chk_kidney=="y") checked @endif class="custom-control-input" id="data3_3chk_kidney">
																	<label for="data3_3chk_kidney" class="custom-control-label normal-label">
																		โรคไต, ไตวาย
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr5">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_diabetes" value="y" @if($data->data3_3chk_diabetes=="y") checked @endif class="custom-control-input" id="data3_3chk_diabetes">
																	<label for="data3_3chk_diabetes" class="custom-control-label normal-label">
																		เบาหวาน
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr6">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_blood" value="y" @if($data->data3_3chk_blood=="y") checked @endif class="custom-control-input" id="data3_3chk_blood">
																	<label for="data3_3chk_blood" class="custom-control-label normal-label">
																		ความดันโลหิตสูง
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr7">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_immune" value="y" @if($data->data3_3chk_immune=="y") checked @endif class="custom-control-input" id="data3_3chk_immune">
																	<label for="data3_3chk_immune" class="custom-control-label normal-label">
																		ภูมิคุ้มกันบกพร่อง
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr8">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_anaemia" value="y" @if($data->data3_3chk_anaemia=="y") checked @endif class="custom-control-input" id="data3_3chk_anaemia">
																	<label for="data3_3chk_anaemia" class="custom-control-label normal-label">
																		โลหิตจาง (ธาลัสซีเมีย, sickle cell anemia)
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr9">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_cerebral" value="y"  @if($data->data3_3chk_cerebral=="y") checked @endif class="custom-control-input" id="data3_3chk_cerebral">
																	<label for="data3_3chk_cerebral" class="custom-control-label normal-label">
																		พิการทางสมอง ช่วยเหลือตัวเองไม่ได้
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr10">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_pregnant" value="y" @if($data->data3_3chk_pregnant=="y") checked @endif class="custom-control-input" id="data3_3chk_pregnant">
																	<label for="data3_3chk_pregnant" class="custom-control-label normal-label">
																		ตั้งครรภ์
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr11">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_fat" value="y" @if($data->data3_3chk_fat=="y") checked @endif class="custom-control-input" id="data3_3chk_fat">
																	<label for="data3_3chk_fat" class="custom-control-label normal-label">
																		อ้วน
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr12">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_cancer" value="y"  @if($data->data3_3chk_cancer=="y") checked @endif class="custom-control-input" id="data3_3chk_cancer">
																	<label for="data3_3chk_cancer" class="custom-control-label normal-label">
																		มะเร็ง
																	</label>
																	<div class="row mt-2">
																		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
																			<div class="form-group">
																				<input type="text" name="data3_3chk_cancer_name" value="@if($data->data3_3chk_cancer_name) {{ $data->data3_3chk_cancer_name }} @endif" class="form-control" placeholder="ประเภทมะเร็ง">
																			</div>
																		</div>
																	</div>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr13">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_other" value="y" class="custom-control-input" @if($data->data3_3chk_other=="y") checked @endif id="data3_3chk_other">
																	<label for="data3_3chk_other" class="custom-control-label normal-label">
																		อื่นๆ
																	</label>
																	<div class="row mt-2">
																		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
																			<div class="form-group">
																				<input type="text" name="data3_3input_other"  class="form-control" value="@if($data->data3_3input_other) {{ $data->data3_3input_other }} @endif" placeholder="อื่นๆ โปรดระบุ">
																			</div>
																		</div>
																	</div>
																</div>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="form-row">

									</div>

									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
											<h1 class="text-info">3. ข้อมูลอาการผู้ป่วย</h1>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
											<div class="form-group">
												<label for="houseNo">วันที่เริ่มป่วย</label>
												<input type="text" id="datepicker2" value="@if($data3_1date_sickdate) {{ $data3_1date_sickdate }} @endif" name="data3_1date_sickdate" class="form-control">
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-1 col-xl-1 mb-3">
											<div class="form-group">
												<label for="villageNo">ไข้(องศา)</label>
												<input type="text" name="fever" value="@if($data->fever_current) {{ $data->fever_current }} @endif"  class="form-control">
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="informant">อาการ</label>
												<div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="sym_cough" value="y" class="custom-control-input pt-type" id="coughChk" @if($data->sym_cough=="y") checked @endif>
														<label for="coughChk" class="custom-control-label normal-label">ไอ</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="sym_snot" value="y" class="custom-control-input pt-type" id="snotChk" @if($data->sym_snot=="y") checked @endif>
														<label for="snotChk" class="custom-control-label normal-label">น้ำมูก</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="sym_sore" value="y" class="custom-control-input pt-type" id="soreChk" @if($data->sym_sore=="y") checked @endif>
														<label for="soreChk" class="custom-control-label normal-label">เจ็บคอ</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="sym_dyspnea" value="y" class="custom-control-input pt-type" id="dyspneaChk" @if($data->sym_dyspnea=="y") checked @endif>
														<label for="dyspneaChk" class="custom-control-label normal-label">หายใจเหนื่อย</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="sym_breathe" value="y" class="custom-control-input pt-type" id="breatheChk" @if($data->sym_breathe=="y") checked @endif>
														<label for="breatheChk" class="custom-control-label normal-label">หายใจลำบาก</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="sym_stufefy" value="y" class="custom-control-input pt-type" id="stufefyChk" @if($data->sym_stufefy=="y") checked @endif>
														<label for="stufefyChk" class="custom-control-label normal-label">ซึม</label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
											<div class="form-group">
												<label for="lane">RR(ครั้ง/นาที)</label>
												<input type="text" name="rr_rpm" value="@if($data->rr_rpm) {{ $data->rr_rpm }} @endif" class="form-control">
											</div>
										</div>


										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
										 <h1 class="text-info">4. ข้อมูลผลทางห้องปฏิบัติการ</h1>
										</div>

										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-6">
											<div class="form-group">
												<label for="district">ผลการฉายรังสี(ถ้ามี)</label>
												<textarea class="form-control" name="xray_result">@if($data->xray_result) {{ $data->xray_result }} @endif</textarea>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
											<div class="form-group">
												<label for="lane">ผลการตรวจแล็ปเบื้องต้น</label>
											</div>
										</div>

										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-6">
											<div class="form-group">
												<label for="subDistrict">Rapid Test</label>
												<textarea class="form-control" name="rapid_test_result" >@if($data->lab_rapid_test_result) {{ $data->lab_rapid_test_result }} @endif</textarea>
											</div>
										</div>

										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-6">
											<div class="form-group">
												<label for="subDistrict">อื่นๆ</label>
												<textarea class="form-control" name="lab_test_result_other">@if($data->lab_test_result_other) {{ $data->lab_test_result_other }} @endif</textarea>
											</div>
										</div>

										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
											<div class="form-group">
												<label for="subDistrict">แพทย์วินิจฉัยเบื้องต้น</label>
												<textarea class="form-control" name="first_diag">@if($data->first_diag) {{ $data->first_diag }} @endif</textarea>
											</div>
										</div>

									</div>
								</div><!-- card body#1 -->
							</div><!-- card1 -->
						</div><!-- bd-collout1 -->

						<h3 class="text-primary">ส่วนที่ 2</h3>
						<div class="bd-callout bd-callout-danger" style="margin:0;">
							<div class="form-row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
									<h1 class="text-info">5.การดำเนินงานเพิ่มเติม สำหรับ Sup Sat./Sat Manager</h1>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-4">
									<div class="form-group">
										<label for="houseNo">PUI Code</label>
										<input type="text" name="sat_id" value="@if($data->sat_id) {{ $data->sat_id }}" @endif class="form-control">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="subDistrict">หน่วยงานที่จะส่งหนังสือ</label>
										<select name="letter_division_code" class="form-control selectpicker show-tick" id="division_code">
											<option value="">-- โปรดเลือก --</option>
											<option value="TRC" @if($data->letter_division_code=="TRC") selected @endif >TRC</option>
											<option value="NIH" @if($data->letter_division_code=="NIH") selected @endif >NIH</option>
											<option value="BIDI" @if($data->letter_division_code=="BIDI") selected @endif >BIDI</option>
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-4">
									<div class="form-group">
										<label for="subDistrict">เลขหนังสือ</label>
										<input type="text" name="letter_code" value="@if($data->letter_code) {{ $data->letter_code }} @endif" class="form-control">
									</div>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
									<div class="form-group">
										<label for="informant">แจ้งศูนย์ Refer บำราศ เพื่อ</label>
									</div>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
									<div class="form-group">
										<div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="refer_bidi" value="Y" @if($data->refer_bidi=="Y") checked @endif class="custom-control-input pt-type" id="referChk">
												<label for="referChk" class="custom-control-label normal-label">รับ Refer</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
									<div class="form-group">
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="refer_lab" value="Y" @if($data->refer_lab=="Y") checked @endif class="custom-control-input pt-type" id="refer_labChk">
												<label for="refer_labChk" class="custom-control-label normal-label">รับ Lab </label>
											</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="lane">ส่งมาเมื่อ</label>
										<input type="text" name="lab_send_detail" value="@if($data->letter_code) {{ $data->lab_send_detail }} @endif" class="form-control" data-timepicker>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="lane">วันที่</label>
										<input type="text" id="datepicker3" name="lab_send_date" value="@if($lab_send_date) {{ $lab_send_date }} @endif" class="form-control">
									</div>
								</div>

						</div>
						<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="lane">ไม่แจ้งบำราศ เนื่องจาก</label>
										<textarea class="form-control" name="not_send_bidi">@if($data->not_send_bidi) {{ $data->not_send_bidi }} @endif</textarea>
									</div>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-4">
									<div class="form-group">
										<label for="informant">แจ้งทีม Operation</label>
										<div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" value="Y" class="custom-control-input" @if($data->op_opt=="Y") checked @endif id="customControlValidation9" name="op_opt" >
												<label class="custom-control-label" for="customControlValidation9">ทีม Operation ลงเอง</label>
											</div>
											 <div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" value="Y" class="custom-control-input" @if($data->op_dpc=="Y") checked @endif id="customControlValidation10" name="op_dpc">
													<label class="custom-control-label" for="customControlValidation10">ทีม สคร. ลง</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="pt_status">PT Status</label>
										<select name="pt_status" data-live-search="true" class="form-control selectpicker show-tick">
											<option value="">-- โปรดเลือก --</option>
											@foreach($arr['pt_status'] as $key => $val)
											<option value="{{ $key }}" @if($data->pt_status==$key) selected @endif >{{ $val }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="pt_type">PUI TYPE</label>
										<select name="pui_type" data-live-search="true" class="form-control selectpicker show-tick">
											<option value="">-- โปรดเลือก --</option>
											@foreach($arr['pui_type'] as $key => $val)
											<option value="{{ $key }}" @if($data->pui_type==$key) selected @endif >{{ $val }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="news_st">การแถลงข่าว</label>
										<select name="news_st" class="form-control selectpicker show-tick">
											<option value="">-- โปรดเลือก --</option>
											@foreach($arr['news_st'] as $key => $val)
											<option value="{{ $key }}" @if($data->news_st==$key) selected @endif >{{ $val }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="disch_st">สถานะการรักษา</label>
										<select name="disch_st" class="form-control selectpicker show-tick">
											<option value="">-- โปรดเลือก --</option>
											@foreach($arr['disch_st'] as $key => $val)
											<option value="{{ $key }}" @if($data->disch_st==$key) selected @endif >{{ $val }}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
								 <h1 class="text-info">6. ข้อมูลผู้บันทึกข้อมูล</h1>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="subDistrict">เบอร์ติดต่อผู้ประสานงาน</label>
										<input type="text" name="coordinator_tel" value="@if($data->coordinator_tel) {{ $data->coordinator_tel }} @endif" class="form-control">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="subDistrict">ชื่อผู้แจ้งข้อมูล</label>
										<input type="text" name="send_information" value="@if($data->send_information) {{ $data->send_information }} @endif" class="form-control">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="subDistrict">หน่วยงาน</label>
										<input type="text" name="send_information_div" value="@if($data->send_information_div) {{ $data->send_information_div }} @endif" class="form-control">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="subDistrict">ชื่อผู้รับแจ้ง</label>
										<input type="text" name="receive_information" value="@if($data->receive_information) {{ $data->receive_information }} @endif" class="form-control">
									</div>
								</div>

							</div>
						</div><!-- bd-collout2 -->
						<div class="border-top">
                  <div class="card-body">
										    <input type="hidden" name="entry_user" value="{{ $entry_user }}"  />
												<input type="hidden" name="id" value="{{ $data->id }}"  />
                        <button type="submit" class="btn btn-primary">Edit</button>
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
	<script src="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
	<script src="https://www.jqueryscript.net/demo/jQuery-Plugin-To-Auto-Format-Time-Format-timepicker-js/timepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/toastr/build/toastr.min.css') }}">
<script>
$(document).ready(function() {
	/* ajax request */
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
});
$('.selectpicker,#cb_send,#cb_result,#nps_ts1_result,#nps_ts2_send,#nps_ts3_send,#nps_ts2_result,#nps_ts1_send,#nps_ts1_result2,#nps_ts1_result3,#nps_ts2_result2,#nps_ts2_result3,#nps_ts3_result,#nps_ts3_result2,#nps_ts3_result3').selectpicker();
/* date of birth */
$('#datepicker1,#datepicker2,#datepicker3,#notify_date').datepicker({
	format: 'dd/mm/yyyy',
	todayHighlight: true,
	todayBtn: true,
	autoclose: true
});

$('.chk_risk3_3').click(function() {
	$('.chk_risk3_3').not(this).prop('checked', false);
});

</script>
@endsection
