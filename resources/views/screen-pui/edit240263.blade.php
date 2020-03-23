@extends('layouts.index')
@section('custom-style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
<?php
use App\Http\Controllers\ScreenPUIController as ScreenPUIController;


$notify_date = (!empty($data->notify_date)) ? ScreenPUIController::Convert_Date_To_Picker($data->notify_date) : "" ;
$risk2_6arrive_date = (!empty($data->risk_stay_outbreak_arrive_date)) ? ScreenPUIController::Convert_Date_To_Picker($data->risk_stay_outbreak_arrive_date) : "" ;
//$risk2_6arrive_date = $data->risk_stay_outbreak_arrive_date."ds";
//dd($risk2_6arrive_date);
$data3_1date_sickdate = (!empty($data->data3_1date_sickdate)) ? ScreenPUIController::Convert_Date_To_Picker($data->data3_1date_sickdate) : "" ;
$lab_send_date = (!empty($data->lab_send_date)) ? ScreenPUIController::Convert_Date_To_Picker($data->lab_send_date) : "" ;
$isolate_date = (!empty($data->isolate_date)) ? ScreenPUIController::Convert_Date_To_Picker($data->isolate_date) : "" ;
$disch_st_date = (!empty($data->disch_st_date)) ? ScreenPUIController::Convert_Date_To_Picker($data->disch_st_date) : "" ;
//dd($data->pt_status);
//dd($globalcountry[$data->travel_from_country]);
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
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contents')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Edit SAT Form ID : {{ $data->sat_id }}</h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Edit SAT Form</li>
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
							<h4 class="card-title">แบบบันทึกข้อมูลของผู้ป่วยโรคไวรัสโคโรนา 19(For SAT)</h4>
							<h5 class="card-subtitle">COVID-19</h5>
						</div>
					</div>
					<form action="{{ route('screenpui.update') }}" method="POST" class="form-horizontal">
						{{ csrf_field() }}
						<h3 class="text-primary">ส่วนที่ 1</h3>
						<div class="bd-callout bd-callout-info" style="margin-top:0;position:relative">
							<div style="position:absolute;top:10px;right:10px;z-index:1">
								<a type="button" href="{{ route('list-data.sat') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back To Lists SAT</a>
								<a type="button" href="{{ route('screenpui.create') }}" class="btn btn-info"><i class="fas fa-user-plus"></i> New patient</a>
								<span class="btn btn-primary font-weight-bold">SAT ID : {{ $data->sat_id }}</span>
							</div>
							<div class="card">
								<div class="card-body">
									<h1 class="text-info">1. ข้อมูลทั่วไปของผู้ป่วย</h1>
									<div class="form-group row">
										<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-4">
											<div class="form-group">
												<label for="houseNo">PUI Code</label>
												<input type="text" name="sat_id" value="{{ $data->sat_id }}" maxlength="12" placeholder="SATID/CASECODE"  class="form-control">
											</div>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
											<label for="workPhone">วันที่ได้รับแจ้ง</label>
											<input type="text" name="notify_date" id="notify_date" value="{{ $notify_date }}" class="form-control" required="" readonly>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-2">
											<label for="workPhone">เวลาได้รับแจ้ง</label>
											<input type="text" class="form-control time" data-mask="00:00" name="notify_time" value="@if(isset($data->notify_time)) {{ $data->notify_time }} @endif" placeholder="10:15">
										</div>
									</div>
									<div class="form-group row">
                                    <label class="col-md-3">การคัดกรอง</label>
                                    <div class="col-md-9">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input is-invalid" @if($data->screen_pt==1) checked @endif id="customControlValidation_rd1" value="1" name="screen_pt" required="">
                                            <label class="custom-control-label" for="customControlValidation_rd1">คัดกรองที่สนามบิน</label>
                                        </div>
                                         <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input is-invalid" @if($data->screen_pt==2) checked @endif id="customControlValidation_rd2" value="2" name="screen_pt" required="">
                                            <label class="custom-control-label" for="customControlValidation_rd2">Walkin มาที่ รพ.</label>
                                        </div>
																				<div class="custom-control custom-radio">
																					 <input type="radio" class="custom-control-input is-invalid" @if($data->screen_pt==3) checked @endif id="customControlValidation_rd3" value="3" name="screen_pt" required="">
																					 <label class="custom-control-label" for="customControlValidation_rd3">ผู้สัมผัสของผู้ป่วยยืนยัน</label>
																			 </div>
																			 <div class="custom-control custom-radio">
																					<input type="radio" class="custom-control-input is-invalid" @if($data->screen_pt==99) checked @endif id="customControlValidation_rd4" value="99" name="screen_pt" required="">
																					<label class="custom-control-label" for="customControlValidation_rd4">อื่นๆ</label>
																			</div>
                                    </div>
                  </div>

										<div class="form-group screen_type1">
											<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
												<label for="dowork">ชื่อสนามบิน</label>
												<select name="airports_code" class="form-control selectpicker show-tick" data-live-search="true" id="airports_code">
													<option value="">-- โปรดเลือก --</option>
													@foreach ($airportlists as $key => $value)
														<option value="{{ $value['list'] }}" {{ $data->airports_code == $value['list'] ? 'selected' : ''}}>สนามบิน{{ $value['right'] }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="form-group screen_type2">
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
													<label for="dowork">จังหวัดที่เข้ารับการคัดกรอง</label>
														<select name="walkinplace_hosp_province" class="form-control selectpicker show-tick select-title-name" data-live-search="true" id="walkinplace_hosp_province">
															<option value="">-- โปรดเลือก --</option>
																@foreach($provinces as $key5=>$val5) {
																	<option value="{{ $val5['province_id'] }}" {{ $data->walkinplace_hosp_province == $val5['province_id'] ? 'selected' : ''}}>{{ $val5['province_name'] }}</option>
																@endforeach
														</select>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-4">
													<label for="chospital_new">โรงพยาบาลที่เข้ารับการคัดกรอง</label>
						              <select name="walkinplace_hosp_code" id="walkinplace_hosp_code" class="form-control selectpicker" data-live-search="true">
														@if (!empty($data->walkinplace_hosp_code))
															<option value="{{ $walkinplace_hosp_name->hospcode }}" selected="selected">{{ $walkinplace_hosp_name->hosp_name }}</option>
														@endif
														<option value="">เลือกโรงพยาบาลที่เข้ารับการคัดกรอง</option>
						  						</select>
											 </div>
											</div>
										</div>
										<div class="form-group screen_type3">
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
													<label for="dowork">SATID ของผู้ป่วยยืนยัน</label>
														<input type="text" name="contact_sat_id" maxlength="12" class="form-control" id="contact_sat_id" value="{{ $data->contact_sat_id }}" placeholder="SATID ของผู้ป่วยยืนยัน">
												</div>
											</div>
										</div>
										<div class="form-group screen_type4">
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
													<label for="dowork">อื่นๆ(ชื่อสถานที่)</label>
														<input type="text" name="community_name" class="form-control" id="community_name" value="{{ $data->community_name }}" placeholder="อื่นๆ(ชื่อสถานที่)">
												</div>
											</div>
										</div>
										<div class="form-group row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-4">
											<label for="dowork">จังหวัด ที่ผู้ป่วย Isolated</label>
											<select name="isolated_province" class="form-control selectpicker show-tick select-title-name" data-live-search="true" id="isolated_province">
												<option value="0">-- โปรดเลือก --</option>
													@foreach($provinces as $key5=>$val5) {
														<option value="{{ $val5['province_id'] }}" @if($data->isolated_province==$val5['province_id']) selected @endif>{{ $val5['province_name'] }}</option>
													@endforeach
											</select>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-6">
											<label for="dowork">ผู้ป่วย Isolated ที่ รพ.</label>
											<select name="isolated_hosp_code" id="isolated_hosp_code" class="form-control selectpicker" data-live-search="true">
												@if (!empty($data->isolated_hosp_code))
													<option value="{{ $isolated_hosp_name->hospcode }}" selected="selected">{{ $isolated_hosp_name->hosp_name }}</option>
												@endif
												<option value="">เลือกโรงพยาบาลที่ผู้ป่วย Isolated</option>
											</select>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 mb-2">
											<div class="form-group">
												<label for="houseNo">วันที่ Isolated</label>
												<input type="text" id="isolate_date" name="isolate_date" value="{{ $isolate_date }}" class="form-control" readonly>
											</div>
										</div>
									</div>
								</div>
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
											<h1 class="text-info">2. ข้อมูลการเดินทาง</h1>
											<div class="form-group">
												<label for="informant">เดินทางมาจากเมืองที่มีการระบาดหรือไม่</label>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
												<label for="country">ประเทศที่เดินทาง</label>
												<select name="travel_from_country" class="form-control selectpicker show-tick" data-live-search="true" id="select_travel_from_country">
													@if (!empty($data->travel_from_country))
														<option value="{{ $data->travel_from_country }}" selected="selected">{{ $globalcountry[$data->travel_from_country] }}</option>
													@endif
													<option value="">-- เลือกประเทศ --</option>
													@foreach ($globalcountry as $key => $value)
														<option value="{{ $key }}">{{ $value }}</option>
													@endforeach
												</select>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
												<label for="country">เมืองที่เดินทาง</label>
												<select name="travel_from_city" class="form-control selectpicker show-tick" data-live-search="true" id="select_travel_from_city">
													@if (!empty($data->travel_from_city))
														<option value="{{ $work_city[0]['city_id'] }}" selected="selected">{{ $work_city[0]['city_name'] }}</option>
													@endif
													<option value="">-- โปรดเลือก --</option>
												</select>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
											<label for="workPhone">วันที่มาถึงไทย</label>
											<input type="text" name="risk2_6arrive_date" value="@if($risk2_6arrive_date) {{ $risk2_6arrive_date }} @endif" id="datepicker1" class="form-control" readonly>
										</div>
									</div>
									<div class="row">
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
												<select name="title_name" class="form-control selectpicker show-tick select-title-name is-invalid" data-live-search="true" id="title_name_input">
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
												<input type="text" name="first_name" class="form-control is-invalid" value="@if($data->first_name) {{ $data->first_name }} @endif" id="first_name_input" placeholder="ชื่อ" required>
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
												<input type="text" name="last_name" class="form-control is-invalid" value="@if($data->last_name) {{ $data->last_name }} @endif" id="last_name_input" placeholder="นามสกุล" required>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="sex">เพศ</label>
												<select name="sex" class="form-control selectpicker show-tick is-invalid">
													<option value="">-- โปรดเลือก --</option>
													<option value="ชาย" @if($data->sex=="ชาย") selected @endif >ชาย</option>
													<option value="หญิง" @if($data->sex=="หญิง") selected @endif>หญิง</option>
												</select>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-1 col-xl-1 mb-3 ">
											<div class="form-group">
												<label for="age">อายุ/ปี</label>
												<input type="text" name="age" value="@if($data->age) {{ $data->age }} @endif" class="form-control is-invalid" id="age_year_input" required>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="nationality">สัญชาติ</label>
												<select name="nation" class="form-control selectpicker show-tick" data-live-search="true" id="select_nationality">
													@if (!empty($data->nation))
														<option value="{{ $data->nation }}" selected="selected">{{ $globalcountry[$data->nation] }}</option>
													@endif
													<option value="">-- โปรดเลือก --</option>
													@foreach ($globalcountry as $key => $value)
														<option value="{{ $key }}">{{ $value }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="nationality">เชื้อชาติ</label>
												<select name="race" class="form-control selectpicker show-tick" data-live-search="true" id="select_race">
													@if (!empty($data->race))
														<option value="{{ $data->race }}" selected="selected">{{ $globalcountry[$data->race] }}</option>
													@endif
													<option value="">-- โปรดเลือก --</option>
													@foreach ($globalcountry as $key => $value)
														<option value="{{ $key }}">{{ $value }}</option>
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
																		โรคประจำตัวอื่นๆ
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
									<hr />
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
											<h1 class="text-info">ปัจจัยเสี่ยง</h1>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
											<div class="form-group">
												<label for="risk_detail">รายละเอียดประวัติเสี่ยง</label>
												<textarea class="form-control" name="risk_detail">@if($data->risk_detail) {{ $data->risk_detail }} @endif</textarea>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
											<div class="form-group">
												<label for="risk_type">ประเภทประวัติเสี่ยง</label>
												<select name="risk_type" id="risk_type" data-live-search="true" class="form-control selectpicker show-tick">
													<option value="">-- โปรดเลือก --</option>
													@foreach($risk_type as $val)
													<option value="{{ $val->id }}" {{ $data->risk_type == $val->id ? 'selected' : ''}}>{{ $val->risk_name }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3 risk_type_text">
											<div class="form-group">
												<label for="risk_type_text">ประเภทประวัติเสี่ยง(อื่นๆ)</label>
												<input type="text" name="risk_type_text" class="form-control" id="risk_type_text" value="{{ $data->risk_type_text }}" placeholder="กรอกประเภทประวัติเสี่ยง(อื่นๆ)">
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
											<h1 class="text-info">3. ข้อมูลอาการผู้ป่วย</h1>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
											<div class="form-group">
												<label for="houseNo">วันที่เริ่มป่วย</label>
												<input type="text" id="datepicker2" value="@if($data3_1date_sickdate) {{ $data3_1date_sickdate }} @endif" name="data3_1date_sickdate" class="form-control" readonly>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-1 col-xl-1 mb-3">
											<div class="form-group">
												<label for="villageNo">ประวัติมีไข้</label>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="fever_history" value="y" class="custom-control-input fever_history" id="fever_history" @if($data->fever_history=="y") checked @endif>
													<label for="fever_history" class="custom-control-label normal-label">มีไข้</label>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-1 col-xl-1 mb-3">
											<div class="form-group">
												<label for="villageNo">ไข้(องศา)</label>
												<input type="text" name="fever" value="@if($data->fever_current) {{ $data->fever_current }} @endif"  class="form-control">
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
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
														<input type="checkbox" name="sym_dyspnea_breathe" value="y" class="custom-control-input pt-type" id="sym_dyspnea_breathe" @if($data->sym_dyspnea_breathe=="y") checked @endif>
														<label for="sym_dyspnea_breathe" class="custom-control-label normal-label">หายใจเหนื่อย/ลำบาก</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="sym_stufefy" value="y" class="custom-control-input pt-type" id="stufefyChk" @if($data->sym_stufefy=="y") checked @endif>
														<label for="stufefyChk" class="custom-control-label normal-label">ซึม</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="sym_vomit" value="y" class="custom-control-input pt-type" id="sym_vomit" @if($data->sym_vomit=="y") checked @endif>
														<label for="sym_vomit" class="custom-control-label normal-label">อาเจียน</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="sym_diarrhoea" value="y" class="custom-control-input pt-type" id="sym_diarrhoea" @if($data->sym_diarrhoea=="y") checked @endif>
														<label for="sym_diarrhoea" class="custom-control-label normal-label">ถ่ายเหลว</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" onclick="check_uncheck_checkbox(this.checked)" name="sym_other" value="y" class="custom-control-input pt-type" id="sym_other" @if($data->sym_other=="y") checked @endif>
														<label for="sym_other" class="custom-control-label normal-label">อื่นๆ</label>
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

										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4">

										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4">
											<div class="form-group sym_othertext">
												<label for="lane">อาการ(อื่นๆ)</label>
												<input type="text" name="sym_othertext" id="sym_othertext" value="{{ $data->sym_othertext }}" class="form-control">
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4">

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
												<textarea class="form-control" name="first_diag" rows="3">@if($data->first_diag) {{ $data->first_diag }} @endif</textarea>
											</div>
										</div>

										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
											<div class="form-group">
												<label for="subDistrict">แพทย์วินิจฉัยสุดท้าย</label>
												<textarea class="form-control" name="last_diag" rows="3">@if($data->last_diag) {{ $data->last_diag }} @endif</textarea>
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
								<!-- <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-4">
									<div class="form-group">
										<label for="houseNo">PUI Code</label>
										<input type="text" name="sat_id" value="{{ trim($data->sat_id) }}" maxlength="12" placeholder="SATID/CASECODE"  class="form-control">
									</div>
								</div> -->
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
										<input type="text" name="lab_send_detail" value="@if($data->letter_code) {{ $data->lab_send_detail }} @endif" class="form-control time" data-mask="00:00" placeholder="10:15">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="lane">วันที่</label>
										<input type="text" id="datepicker3" name="lab_send_date" value="@if($lab_send_date) {{ $lab_send_date }} @endif" class="form-control" readonly>
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
										<select name="pt_status" id="pt_status" data-live-search="true" class="form-control  show-tick is-invalid" required>
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
										<select name="pui_type" data-live-search="true" class="form-control  show-tick ">
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
										<select name="news_st" class="form-control  show-tick">
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
										<select name="disch_st" id="disch_st" class="form-control  show-tick">
											<option value="">-- โปรดเลือก --</option>
											@foreach($arr['disch_st'] as $key => $val)
											<option value="{{ $key }}" @if($data->disch_st==$key) selected @endif >{{ $val }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="row disch_st_date">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="disch_st_date">วันที่(สถานะการรักษา)</label>
											<input type="text" id="disch_st_date" name="disch_st_date" value="@if($disch_st_date) {{ $disch_st_date }} @endif" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="row confirm_order">
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="subDistrict">ผู้ป่วย Confirm ลำดับที่(กรณีที่ทราบลำดับประกาศเคสยืนยัน)</label>
										<input type="text" name="order_pt" value="@if($data->order_pt) {{ $data->order_pt }} @endif" id="order_pt" class="form-control" placeholder="ลำดับผู้ป่วย">
									</div>
								</div>
							</div>
							<div class="row type_nature">
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="subDistrict">ผู้ป่วยมาจาก</label>
										<select name="type_nature" id="type_nature" class="form-control  show-tick">
											<option value="">-- โปรดเลือก --</option>
											<option value="1" <?php if($data->type_nature==1){ echo "selected";} ?>>Local</option>
											<option value="2" <?php if($data->type_nature==2){ echo "selected";} ?>>Import</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
<script>
(function($) {
	$.fn.inputFilter = function(inputFilter) {
		return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
			if (inputFilter(this.value)) {
				this.oldValue = this.value;
				this.oldSelectionStart = this.selectionStart;
				this.oldSelectionEnd = this.selectionEnd;
			} else if (this.hasOwnProperty("oldValue")) {
				this.value = this.oldValue;
				this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
			} else {
				this.value = "";
			}
		});
	};
}(jQuery));

$(document).ready(function() {
	/* ajax request */
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('.sym_othertext').hide();

	var sym_other = '<?php echo $data->sym_other; ?>';
	if(sym_other=="y"){
		$('.sym_othertext').show();
	}else{
		$('.sym_othertext').hide();
	}

	var risk_type_db = '<?php echo $data->risk_type; ?>';
	if(risk_type_db=='13'){
		$('.risk_type_text').show();
	}else{
		$('.risk_type_text').hide();
	}

	$('#risk_type').change(function() {
	 var risk_type = $('#risk_type').val();
	 //console.log(pt_status);
	 if(risk_type==13){
		 $('.risk_type_text').show();
	 }else{
		 $('.risk_type_text').hide();
		 $('#risk_type_text').val('');
	 }
	});


	$('.time').mask('00:00');

	$('.selectpicker').selectpicker();
	/* date of birth */
	$('#datepicker1,#datepicker2,#datepicker3,#notify_date,#isolate_date,#disch_st_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$("#age_year_input,#coordinator_tel").inputFilter(function(value) {
			return /^\d*$/.test(value);    // Allow digits only, using a RegExp
		});

	$('.chk_risk3_3').click(function() {
		$('.chk_risk3_3').not(this).prop('checked', false);
	});

	$('#select_travel_from_country').change(function() {
		//alert('fdfdfd');
		 console.log($('#select_travel_from_country').val());
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('cityFetch') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_travel_from_city').html(response);
					$('#select_travel_from_city').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	var pt_status_from_db = <?php if(isset($data->pt_status)) { echo $data->pt_status; } ?>;
	if(pt_status_from_db==2){
		$('.confirm_order').show();
		$('.type_nature').show();
	}else{
		$('.confirm_order').hide();
		$('.type_nature').hide();
	}

	//$('.confirm_order').hide();
	$('#pt_status').change(function() {
	 var pt_status = $('#pt_status').val();
	 //console.log(pt_status);
	 if(pt_status==2){
		 $('.confirm_order').show();
		 //$("#order_pt").prop('required',true);
		 $('.type_nature').show();
		 $("#type_nature").prop('required',true);
	 }else{
		 $('.confirm_order').hide();
		 //$("#order_pt").prop('required',false);
		 $("#order_pt").val('');
		 $('.type_nature').hide();
		 $("#type_nature").prop('required',false);
	 }
	});

	var screen_pt_from_db = <?php if(isset($data->screen_pt)) { echo $data->screen_pt; } ?>;
	if(screen_pt_from_db==1){
		$('.screen_type1').show();
		$('.screen_type2').hide();
		$('.screen_type3').hide();
		$('.screen_type4').hide();
	}else if(screen_pt_from_db==2){
		$('.screen_type2').show();
		$('.screen_type1').hide();
		$('.screen_type3').hide();
		$('.screen_type4').hide();
	}else if(screen_pt_from_db==3){
		$('.screen_type3').show();
		$('.screen_type2').hide();
		$('.screen_type1').hide();
		$('.screen_type4').hide();
	}else{
		$('.screen_type4').show();
		$('.screen_type2').hide();
		$('.screen_type1').hide();
		$('.screen_type3').hide();
	}

	$("#customControlValidation_rd1").click(function(){
			$('.screen_type1').show();
			$('.screen_type2').hide();
			$('.screen_type3').hide();
			$('.screen_type4').hide();
			$('#walkinplace_hosp_province').val(null).trigger('change');
			$('#walkinplace_hosp_code').val(null).trigger('change');
			$('#community_name').val('');
			$('#contact_sat_id').val('');
	});
	$("#customControlValidation_rd2").click(function(){
			$('.screen_type2').show();
			$('.screen_type1').hide();
			$('.screen_type3').hide();
			$('.screen_type4').hide();
			$('#airports_code').val(null).trigger('change');
			$('#community_name').val('');
			$('#contact_sat_id').val('');
	});
	$("#customControlValidation_rd3").click(function(){
			$('.screen_type3').show();
			$('.screen_type1').hide();
			$('.screen_type2').hide();
			$('.screen_type4').hide();
			$('#airports_code').val(null).trigger('change');
			$('#walkinplace_hosp_province').val(null).trigger('change');
			$('#walkinplace_hosp_code').val(null).trigger('change');
			$('#community_name').val('');
	});
	$("#customControlValidation_rd4").click(function(){
			$('.screen_type4').show();
			$('.screen_type1').hide();
			$('.screen_type2').hide();
			$('.screen_type3').hide();
			$('#airports_code').val(null).trigger('change');
			$('#walkinplace_hosp_province').val(null).trigger('change');
			$('#walkinplace_hosp_code').val(null).trigger('change');
			$('#contact_sat_id').val('');
	});

	$('#walkinplace_hosp_province').change(function() {
		if ($(this).val() != '') {
			var select = $(this).val();
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: "{{route('screenpui.fetchHos')}}",
				method: "POST",
				data: {
					select: select,
					_token: _token
				},
				success: function(result) {
					$('#walkinplace_hosp_code').html(result);
					$('#walkinplace_hosp_code').selectpicker("refresh");
				}
			})
		}
	});

	$('#isolated_province').change(function() {
		if ($(this).val() != '') {
			var select = $(this).val();
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: "{{route('screenpui.fetchHos')}}",
				method: "POST",
				data: {
					select: select,
					_token: _token
				},
				success: function(result) {
					$('#isolated_hosp_code').html(result);
					$('#isolated_hosp_code').selectpicker("refresh");
				}
			})
		}
	});

});

$('.disch_st_date').hide();

$('#disch_st').change(function() {
	var disch_st = $('#disch_st').val();
	if(disch_st==1 || disch_st==3){
		//console.log(disch_st);
		$('.disch_st_date').show();
		//alert('dsdds');
	}else{
		$('.disch_st_date').hide();
		$('#disch_st_date').val('');
	}
});

var disch_st_db = <?php echo $data->disch_st; ?>;
if(disch_st_db ==1 || disch_st_db ==3){
	//console.log(disch_st);
	$('.disch_st_date').show();
	//alert('dsdds');
}else{
	$('.disch_st_date').hide();
	$('#disch_st_date').val('');
}

function check_uncheck_checkbox(isChecked) {
	if(isChecked) {
		$('.sym_othertext').show();
	} else {
		$('.sym_othertext').hide();
		$('#sym_othertext').val('');
	}
}

</script>
@endsection
