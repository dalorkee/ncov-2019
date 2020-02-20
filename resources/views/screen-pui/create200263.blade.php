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
<?php

//dd($airportlists);
$config = [
    'table' => 'invest_pt',
    'length' => 11,
		'field' => 'sat_id_temp',
    'prefix' => $prefix_sat_id."O".date('d').date('m'),
];
$sat_id = Haruncpi\LaravelIdGenerator\IdGenerator::generate($config);

//dd($id);
?>
@endsection
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contents')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Create New SAT Form</h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Create New SAT Form</li>
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
					<form action="<?php echo url()->current(); ?>" method="POST" class="form-horizontal">
						{{ csrf_field() }}
						<h3 class="text-primary">ส่วนที่ 1</h3>
						<div class="bd-callout bd-callout-info" style="margin-top:0;position:relative">
							<div style="position:absolute;top:10px;right:10px;z-index:1">
								<a type="button" href="{{ route('satList') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back To Lists PUI</a>
								<a type="button" href="{{ route('screenpui.create') }}" class="btn btn-info"><i class="fas fa-user-plus"></i> New patient</a>
							</div>
							<div class="card">
								<div class="card-body">
									<h1 class="text-info">1. ข้อมูลทั่วไปของผู้ป่วย</h1>
									<div class="form-group row">
                                    <!-- <label class="col-md-3">PUI Code</label> -->
                                    <div class="col-md-9">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input check-auto is-invalid" id="pui_code_gen_rd1" value="1" {{ old('pui_code_gen') == 1 ? 'checked' : ''}} name="pui_code_gen" required="">
                                            <label class="custom-control-label" for="pui_code_gen_rd1">PUI Code(Auto Generate)</label>
                                        </div>
                                         <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input check-manual is-invalid" id="pui_code_gen_rd2" value="2" {{ old('pui_code_gen') == 2 ? 'checked' : ''}} name="pui_code_gen" required="">
                                            <label class="custom-control-label" for="pui_code_gen_rd2">PUI Code(Manual)</label>
                                        </div>
                                    </div>
                  </div>
									<div class="form-group row" id="pui_gen_auto">
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
											<div class="form-group">
												<label for="houseNo">PUI Code(Auto Generate)</label>
												<input type="text" name="sat_id" class="form-control is-invalid" value="{{ $sat_id }}" readonly>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
											<div class="form-group">
												<label for="houseNo" class="text-danger">ชนิดผู้ป่วย</label>
												<select name="patient_type_sat_id" class="form-control selectpicker show-tick is-invalid" id="patient_type_sat_id">
													<option value="">-- โปรดเลือก --</option>
													<option value="A">PUI</option>
													<option value="S">Special</option>
												</select>
											</div>
										</div>
									</div>
									<div class="form-group row" id="pui_gen_manual">
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
											<div class="form-group">
												<label for="houseNo" class="text-danger">PUI Code(Manual)</label>
												<input type="text" name="sat_id" id="sat_id_manual" class="form-control is-invalid" value="{{ old('sat_id') }}">
											</div>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
											<label for="workPhone" class="text-danger">วันที่ได้รับแจ้ง</label>
											<input type="text" name="notify_date" id="notify_date" value="{{ old('notify_date') }}" class="form-control is-invalid" required="">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-2">
											<label for="workPhone">เวลาได้รับแจ้ง</label>
											<input type="text" class="form-control time" data-mask="00:00" name="notify_time" value="{{ old('notify_time') }}" placeholder="10:15">
										</div>
									</div>
									<div class="form-group row">
                                    <label class="col-md-3">การคัดกรอง</label>
                                    <div class="col-md-9">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input is-invalid" id="customControlValidation_rd1" value="1" {{ old('screen_pt') == 1 ? 'checked' : ''}} name="screen_pt" required="">
                                            <label class="custom-control-label" for="customControlValidation_rd1">คัดกรองที่สนามบิน</label>
                                        </div>
                                         <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input is-invalid" id="customControlValidation_rd2" value="2" {{ old('screen_pt') == 2 ? 'checked' : ''}} name="screen_pt" required="">
                                            <label class="custom-control-label" for="customControlValidation_rd2">Walkin มาที่ รพ.</label>
                                        </div>
																				<div class="custom-control custom-radio">
																					 <input type="radio" class="custom-control-input is-invalid" id="customControlValidation_rd3" value="3" {{ old('screen_pt') == 3 ? 'checked' : ''}} name="screen_pt" required="">
																					 <label class="custom-control-label" for="customControlValidation_rd3">อื่นๆ</label>
																			 </div>
                                    </div>
                  </div>

									<div class="form-group screen_type1">
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
											<label for="dowork">ชื่อสนามบิน</label>
											<select name="airports_code" class="form-control selectpicker show-tick" data-live-search="true" id="airports_code">
												<option value="">-- โปรดเลือก --</option>
												@foreach ($airportlists as $key => $value)
													<option value="{{ $value['list'] }}">สนามบิน{{ $value['right'] }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="form-group screen_type2">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
												<label for="dowork">จังหวัดที่เข้ารับการคัดกรอง</label>
													<select name="walkinplace_hosp_province" class="form-control selectpicker " data-live-search="true" id="walkinplace_hosp_province">
														<option value="">-- โปรดเลือก --</option>
															@foreach($provinces as $key5=>$val5) {
																<option value="{{ $val5['province_id'] }}" {{ old('walkinplace_hosp_province') == $val5['province_id'] ? 'selected' : ''}}>{{ $val5['province_name'] }}</option>
															@endforeach
													</select>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-4">
												<label for="chospital_new_label">โรงพยาบาลที่เข้ารับการคัดกรอง</label>
					              <select name="walkinplace_hosp_code" id="walkinplace_hosp_code" class="form-control selectpicker" data-live-search="true" >
					  							<option value="">เลือกโรงพยาบาลที่เข้ารับการคัดกรอง</option>
					  						</select>
										 </div>
										</div>
									</div>

									<div class="form-group screen_type3">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
												<label for="dowork">อื่นๆ(ชื่อสถานที่)</label>
													<input type="text" name="community_name" class="form-control" id="community_name" value="{{ old('community_name') }}" placeholder="อื่นๆ(ชื่อสถานที่)">
											</div>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-4">
											<label for="dowork">จังหวัด ที่ผู้ป่วย Isolated</label>
											<select name="isolated_province" class="form-control selectpicker show-tick" data-live-search="true" id="isolated_province">
												<option value="">-- โปรดเลือก --</option>
													@foreach($provinces as $key5=>$val5) {
														<option value="{{ $val5['province_id'] }}" {{ old('isolated_province') == $val5['province_id'] ? 'selected' : ''}}>{{ $val5['province_name'] }}</option>
													@endforeach
											</select>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-4">
											<label for="dowork">ผู้ป่วย Isolated ที่ รพ.</label>
											<select name="isolated_hosp_code" id="isolated_hosp_code" class="form-control selectpicker" data-live-search="true">
												<option value="">เลือกโรงพยาบาลที่ผู้ป่วย Isolated</option>
											</select>
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
													<option value="">-- เลือกประเทศ --</option>
													@foreach ($globalcountry as $key => $value)
														<option value="{{ $value['country_id'] }}" {{ old('travel_from_country') == $value['country_id'] ? 'selected' : ''}}>{{ $value['country_name'] }}</option>
													@endforeach
												</select>
										</div>

										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
												<label for="country">เมืองที่เดินทาง</label>
												<select name="travel_from_city" class="form-control selectpicker show-tick" data-live-search="true" id="select_travel_from_city">
													<option value="">-- โปรดเลือก --</option>
												</select>
										</div>

										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
											<label for="workPhone">วันที่มาถึงไทย</label>
											<input type="text" name="risk2_6arrive_date" value="{{ old('risk2_6arrive_date') }}" id="datepicker1" class="form-control">
										</div>
									</div>
										<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
											<label for="workPhone">สายการบิน</label>
											<input type="text" name="risk2_6airline_input" value="{{ old('risk2_6airline_input') }}" class="form-control" placeholder="สายการบิน">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
											<label for="workPhone">เที่ยวบิน</label>
											<input type="text" name="risk2_6flight_no_input" value="{{ old('risk2_6flight_no_input') }}" class="form-control" placeholder="เที่ยวบิน">
										</div>
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
											<label for="workPhone"><small>จำนวนผู้ร่วมเดินทางในกลุ่มเดียวกัน(คน)</small></label>
											<input type="text" name="total_travel_in_group" value="{{ old('total_travel_in_group') }}"  class="form-control" placeholder="จำนวนคน">
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="titleName" class="text-danger">คำนำหน้าชื่อ</label>
												<select name="title_name" class="form-control selectpicker show-tick select-title-name is-invalid" data-live-search="true" id="title_name_input" required>
													<option value="">-- โปรดเลือก --</option>
														@foreach($titleName as $key=>$val) {
															<option value="{{ $val['id'] }}" {{ old('title_name') == $val['id'] ? 'selected' : ''}}>{{ $val['title_name'] }}</option>
														@endforeach
												</select>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group {{ $errors->has('firstNameInput') ? 'has-error' : '' }}">
												<label for="firstName" class="text-danger">ชื่อจริง</label>
												<input type="text" name="first_name" class="form-control is-invalid" id="first_name_input" value="{{ old('first_name') }}" placeholder="ชื่อ" required>
											</div>
											<span class="text-danger">{{ $errors->first('firstNameInput') }}</span>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
											<div class="form-group">
												<label for="midName">ชื่อกลาง</label>
												<input type="text" name="mid_name" class="form-control" id="mid_name_input" value="{{ old('mid_name') }}" placeholder="ชื่อกลาง">
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
											<div class="form-group {{ $errors->has('lastNameInput') ? 'has-error' : '' }}">
												<label for="lastName" class="text-danger">นามสกุล</label>
												<input type="text" name="last_name" class="form-control is-invalid" id="last_name_input" value="{{ old('last_name') }}" placeholder="นามสกุล" required>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group {{ $errors->has('sexInput') ? 'has-error' : '' }}">
												<label for="sex" class="text-danger">เพศ</label>
												<select name="sex" class="form-control selectpicker show-tick is-invalid" required="">
													<option value="">-- โปรดเลือก --</option>
													<option value="ชาย" {{ old('sex') == 'ชาย' ? 'selected' : ''}}>ชาย</option>
													<option value="หญิง" {{ old('sex') == 'หญิง' ? 'selected' : ''}}>หญิง</option>
												</select>
											</div>
											<span class="text-danger">{{ $errors->first('sexInput') }}</span>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-1 col-xl-1 mb-3">
											<div class="form-group">
												<label for="age" class="text-danger">อายุ/ปี</label>
												<input type="text" name="age" value="{{ old('age') }}" class="form-control is-invalid" id="age_year_input" required>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="nationality">สัญชาติ</label>
												<select name="nation" class="form-control selectpicker show-tick" data-live-search="true" id="select_nationality">
													<option value="">-- โปรดเลือก --</option>
													@foreach($globalcountry as $val)
													<option value="{{ $val->country_id }}" {{ old('nation') == $val->country_id ? 'selected' : ''}}>{{ $val->country_name }}</option>
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
													<option value="{{ $val->country_id }}" {{ old('race') == $val->country_id ? 'selected' : ''}} >{{ $val->country_name }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 mb-2">
											<label for="occupation">อาชีพ</label>
											<select name="occupation" class="form-control selectpicker show-tick select-title-name" data-live-search="true" >
												<option value="0">-- โปรดเลือก --</option>
													@foreach($occupation as $key5=>$val5) {
														<option value="{{ $val5['id'] }}" {{ old('occupation') == $val5['id'] ? 'selected' : ''}}>{{ $val5['occu_name_th'] }}</option>
													@endforeach
											</select>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
											<label for="occupation_oth">อาชีพอื่นๆ</label>
											<input type="text" name="occupation_oth" value="{{ old('occupation_oth') }}"  class="form-control" id="occupation_oth">
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
												<input type="checkbox" name="data3_3chk" value="n" class="custom-control-input chk_risk3_3" id="data3_3chkNo" {{ old('data3_3chk') == 'n' ? 'checked' : ''}}>
												<label for="data3_3chkNo" class="custom-control-label normal-label">ไม่มี</label>
											</div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="data3_3chk" value="y" class="custom-control-input chk_risk3_3" id="data3_3chkYes" {{ old('data3_3chk') == 'y' ? 'checked' : ''}}>
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
																	<input type="checkbox" name="data3_3chk_lung" value="y" class="custom-control-input" id="data3_3chk_lung" {{ old('data3_3chk_lung') == 'y' ? 'checked' : ''}}>
																	<label for="data3_3chk_lung" class="custom-control-label normal-label">
																		โรคปอดเรื้อรัง เช่น COPD, chronic bronchitis, chronic bronchiectasis, BPD, หรือหอบ (asthma) ที่กำลังรักษา
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr2">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_heart" value="y" class="custom-control-input" id="data3_3chk_heart" {{ old('data3_3chk_heart') == 'y' ? 'checked' : ''}}>
																	<label for="data3_3chk_heart" class="custom-control-label normal-label">
																		โรคหัวใจ เช่น หัวใจพิการแต่กำเนิด, โรคหลอดเลือดหัวใจ หรือ Congestive heart failure
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr3">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_cirrhosis" value="y" class="custom-control-input" id="data3_3chk_cirrhosis" {{ old('data3_3chk_cirrhosis') == 'y' ? 'checked' : ''}}>
																	<label for="data3_3chk_cirrhosis" class="custom-control-label normal-label">
																		โรคตับเรื้อรัง เช่น ตับแข็ง (Cirrhosis)
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr4">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_kidney" value="y" class="custom-control-input" id="data3_3chk_kidney" {{ old('data3_3chk_kidney') == 'y' ? 'checked' : ''}}>
																	<label for="data3_3chk_kidney" class="custom-control-label normal-label">
																		โรคไต, ไตวาย
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr5">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_diabetes" value="y" class="custom-control-input" id="data3_3chk_diabetes" {{ old('data3_3chk_diabetes') == 'y' ? 'checked' : ''}}>
																	<label for="data3_3chk_diabetes" class="custom-control-label normal-label">
																		เบาหวาน
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr6">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_blood" value="y" class="custom-control-input" id="data3_3chk_blood" {{ old('data3_3chk_blood') == 'y' ? 'checked' : ''}}>
																	<label for="data3_3chk_blood" class="custom-control-label normal-label">
																		ความดันโลหิตสูง
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr7">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_immune" value="y" class="custom-control-input" id="data3_3chk_immune" {{ old('data3_3chk_immune') == 'y' ? 'checked' : ''}}>
																	<label for="data3_3chk_immune" class="custom-control-label normal-label">
																		ภูมิคุ้มกันบกพร่อง
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr8">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_anaemia" value="y" class="custom-control-input" id="data3_3chk_anaemia" {{ old('data3_3chk_anaemia') == 'y' ? 'checked' : ''}}>
																	<label for="data3_3chk_anaemia" class="custom-control-label normal-label">
																		โลหิตจาง (ธาลัสซีเมีย, sickle cell anemia)
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr9">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_cerebral" value="y" class="custom-control-input" id="data3_3chk_cerebral" {{ old('data3_3chk_cerebral') == 'y' ? 'checked' : ''}}>
																	<label for="data3_3chk_cerebral" class="custom-control-label normal-label">
																		พิการทางสมอง ช่วยเหลือตัวเองไม่ได้
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr10">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_pregnant" value="y" class="custom-control-input" id="data3_3chk_pregnant" {{ old('data3_3chk_pregnant') == 'y' ? 'checked' : ''}}>
																	<label for="data3_3chk_pregnant" class="custom-control-label normal-label">
																		ตั้งครรภ์
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr11">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_fat" value="y" class="custom-control-input" id="data3_3chk_fat" {{ old('data3_3chk_fat') == 'y' ? 'checked' : ''}}>
																	<label for="data3_3chk_fat" class="custom-control-label normal-label">
																		อ้วน
																	</label>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr12">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_cancer" value="y" class="custom-control-input" id="data3_3chk_cancer" {{ old('data3_3chk_cancer') == 'y' ? 'checked' : ''}}>
																	<label for="data3_3chk_cancer" class="custom-control-label normal-label">
																		มะเร็ง
																	</label>
																	<div class="row mt-2">
																		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
																			<div class="form-group">
																				<input type="text" name="data3_3chk_cancer_name" class="form-control" placeholder="ประเภทมะเร็ง" value="{{ old('data3_3chk_cancer_name') }}">
																			</div>
																		</div>
																	</div>
																</div>
															</td>
														</tr>
														<tr id="risk3_3table_tr13">
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="data3_3chk_other" value="y" class="custom-control-input" id="data3_3chk_other" {{ old('data3_3chk_other') == 'y' ? 'checked' : ''}}>
																	<label for="data3_3chk_other" class="custom-control-label normal-label">
																		อื่นๆ
																	</label>
																	<div class="row mt-2">
																		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
																			<div class="form-group">
																				<input type="text" name="data3_3input_other"  class="form-control" placeholder="อื่นๆ โปรดระบุ" value="{{ old('data3_3input_other') }}">
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
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
											<h1 class="text-info">3. ข้อมูลอาการผู้ป่วย</h1>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
											<div class="form-group">
												<label for="houseNo">วันที่เริ่มป่วย</label>
												<input type="text" id="datepicker2" name="data3_1date_sickdate" value="{{ old('data3_1date_sickdate') }}" class="form-control">
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-1 col-xl-1 mb-3">
											<div class="form-group">
												<label for="villageNo">ประวัติมีไข้</label>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="fever_history" value="y" class="custom-control-input fever_history" id="fever_history" {{ old('fever_history') == 'n' ? 'checked' : ''}}>
													<label for="fever_history" class="custom-control-label normal-label">มีไข้</label>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-1 col-xl-1 mb-3">
											<div class="form-group">
												<label for="villageNo">ไข้(องศา)</label>
												<input type="text" name="fever" value="{{ old('fever') }}"  class="form-control">
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
											<div class="form-group">
												<label for="informant">อาการ</label>
												<div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="sym_cough" value="y" class="custom-control-input pt-type" id="coughChk" {{ old('sym_cough') == 'y' ? 'checked' : ''}}>
														<label for="coughChk" class="custom-control-label normal-label">ไอ</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="sym_snot" value="y" class="custom-control-input pt-type" id="snotChk" {{ old('sym_snot') == 'y' ? 'checked' : ''}}>
														<label for="snotChk" class="custom-control-label normal-label">น้ำมูก</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="sym_sore" value="y" class="custom-control-input pt-type" id="soreChk" {{ old('sym_sore') == 'y' ? 'checked' : ''}}>
														<label for="soreChk" class="custom-control-label normal-label">เจ็บคอ</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="sym_dyspnea" value="y" class="custom-control-input pt-type" id="dyspneaChk" {{ old('sym_dyspnea') == 'y' ? 'checked' : ''}}>
														<label for="dyspneaChk" class="custom-control-label normal-label">หายใจเหนื่อย</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="sym_breathe" value="y" class="custom-control-input pt-type" id="breatheChk" {{ old('sym_breathe') == 'y' ? 'checked' : ''}}>
														<label for="breatheChk" class="custom-control-label normal-label">หายใจลำบาก</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="sym_stufefy" value="y" class="custom-control-input pt-type" id="stufefyChk" {{ old('sym_stufefy') == 'y' ? 'checked' : ''}}>
														<label for="stufefyChk" class="custom-control-label normal-label">ซึม</label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
											<div class="form-group">
												<label for="lane">RR(ครั้ง/นาที)</label>
												<input type="text" name="rr_rpm" value="{{ old('rr_rpm') }}" class="form-control">
											</div>
										</div>


										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
										 <h1 class="text-info">4. ข้อมูลผลทางห้องปฏิบัติการ</h1>
										</div>

										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-6">
											<div class="form-group">
												<label for="district">ผลการฉายรังสี(ถ้ามี)</label>
												<textarea class="form-control" name="xray_result">{{ old('xray_result') }}</textarea>
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
												<textarea class="form-control" name="rapid_test_result">{{ old('rapid_test_result') }}</textarea>
											</div>
										</div>

										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-6">
											<div class="form-group">
												<label for="subDistrict">อื่นๆ</label>
												<textarea class="form-control" name="lab_test_result_other">{{ old('lab_test_result_other') }}</textarea>
											</div>
										</div>

										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
											<div class="form-group">
												<label for="subDistrict">แพทย์วินิจฉัยเบื้องต้น</label>
												<textarea class="form-control" name="first_diag">{{ old('first_diag') }}</textarea>
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
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="subDistrict">หน่วยงานที่จะส่งหนังสือ</label>
										<select name="letter_division_code" class="form-control selectpicker show-tick" id="division_code">
											<option value="">-- โปรดเลือก --</option>
											<option value="TRC" {{ old('letter_division_code') == 'TRC' ? 'selected' : ''}}>TRC</option>
											<option value="NIH" {{ old('letter_division_code') == 'NIH' ? 'selected' : ''}}>NIH</option>
											<option value="BIDI" {{ old('letter_division_code') == 'BIDI' ? 'selected' : ''}}>BIDI</option>
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="subDistrict">เลขหนังสือ</label>
										<input type="text" name="letter_code" class="form-control" value="{{ old('letter_code') }}">
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
												<input type="checkbox" name="refer_bidi" value="Y" class="custom-control-input pt-type" id="referChk" {{ old('refer_bidi') == 'Y' ? 'checked' : ''}}>
												<label for="referChk" class="custom-control-label normal-label">รับ Refer</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
									<div class="form-group">
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" name="refer_lab" value="Y" class="custom-control-input pt-type" id="refer_labChk" {{ old('refer_lab') == 'Y' ? 'checked' : ''}}>
												<label for="refer_labChk" class="custom-control-label normal-label">รับ Lab </label>
											</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="lane">ส่งมาเมื่อ</label>
										<input type="text" name="lab_send_detail" class="form-control time" data-mask="00:00" value="{{ old('lab_send_detail') }}" placeholder="10:15">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="lane">วันที่</label>
										<input type="text" id="datepicker3" name="lab_send_date" value="{{ old('lab_send_date') }}" class="form-control">
									</div>
								</div>

						</div>
						<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="lane">ไม่แจ้งบำราศ เนื่องจาก</label>
										<textarea class="form-control" name="not_send_bidi">{{ old('not_send_bidi') }}</textarea>
									</div>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-4">
									<div class="form-group">
										<label for="informant">แจ้งทีม Operation</label>
										<div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" value="Y" class="custom-control-input" id="customControlValidation9" name="op_opt" {{ old('op_opt') == 'Y' ? 'checked' : ''}}>
												<label class="custom-control-label" for="customControlValidation9">ทีม Operation ลงเอง</label>
											</div>
											 <div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" value="Y" class="custom-control-input" id="customControlValidation10" name="op_dpc" {{ old('op_dpc') == 'Y' ? 'checked' : ''}}>
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
										<select name="pt_status" id="pt_status" data-live-search="true" class="form-control is-invalid  show-tick" required>
											<option value="">-- โปรดเลือก --</option>
											@foreach($arr['pt_status'] as $key => $val)
											<option value="{{ $key }}" {{ old('pt_status') == $key ? 'selected' : ''}}>{{ $val }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="pt_type">PUI TYPE</label>
										<select name="pui_type" data-live-search="true" class="form-control  show-tick">
											<option value="">-- โปรดเลือก --</option>
											@foreach($arr['pui_type'] as $key => $val)
											<option value="{{ $key }}" {{ old('pui_type') == $key ? 'selected' : ''}}>{{ $val }}</option>
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
											<option value="{{ $key }}" {{ old('news_st') == $key ? 'selected' : ''}}>{{ $val }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="disch_st">สถานะการรักษา</label>
										<select name="disch_st" class="form-control  show-tick">
											<option value="">-- โปรดเลือก --</option>
											@foreach($arr['disch_st'] as $key => $val)
											<option value="{{ $key }}" {{ old('disch_st') == $key ? 'selected' : ''}}>{{ $val }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="row confirm_order">
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="subDistrict">ผู้ป่วย Confirm ลำดับที่</label>
										<input type="text" name="order_pt" value="{{ old('order_pt') }}" id="order_pt" class="form-control" placeholder="ลำดับผู้ป่วย">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
								 <h1 class="text-info">6. ข้อมูลผู้แจ้ง</h1>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="subDistrict">เบอร์ติดต่อ</label>
										<input type="text" name="coordinator_tel" value="{{ old('coordinator_tel') }}" id="coordinator_tel" class="form-control" placeholder="เบอร์ติดต่อ">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="subDistrict">ชื่อผู้แจ้งข้อมูล</label>
										<input type="text" name="send_information" value="{{ old('send_information') }}" class="form-control" placeholder="ชื่อผู้แจ้งข้อมูล">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="subDistrict">หน่วยงาน</label>
										<input type="text" name="send_information_div" value="{{ old('send_information_div') }}" class="form-control" placeholder="หน่วยงาน">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
									<div class="form-group">
										<label for="subDistrict">ชื่อผู้รับแจ้ง</label>
										<input type="text" name="receive_information" value="{{ old('receive_information') }}"  class="form-control" placeholder="ชื่อผู้รับแจ้ง">
									</div>
								</div>

							</div>
						</div><!-- bd-collout2 -->
						<div class="border-top">
                  <div class="card-body">
										    <input type="hidden" name="entry_user" value="{{ $entry_user }}"  />
                        <button type="submit" class="btn btn-primary">Save</button>
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
	<!-- <script src="https://www.jqueryscript.net/demo/jQuery-Plugin-To-Auto-Format-Time-Format-timepicker-js/timepicker.js"></script> -->
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
	$('.time').mask('00:00');

	$('.selectpicker').selectpicker();
	/* date of birth */
	$('#datepicker1,#datepicker2,#datepicker3,.datepicker,#notify_date').datepicker({
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


	$('#pui_gen_auto').hide();
	$('#pui_gen_manual').hide();

	$(".check-auto").click(function(){
	        $("#pui_code_gen_rd1").prop("checked", true);
					$("#patient_type_sat_id").prop('required',true);
					$('#pui_gen_auto').show();
					$('#pui_gen_manual').hide();
					//$('#sat_id').val('');
	});
	$(".check-manual").click(function(){
	        $("#pui_code_gen_rd2").prop("checked", true);
					$("#patient_type_sat_id").prop('required',false);
					$("#sat_id_manual").prop('required',true);
					$('#sat_id_manual').val('');
					$('#pui_gen_auto').hide();
					$('#pui_gen_manual').show();
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

	$('.confirm_order').hide();
	$('#pt_status').change(function() {
	 var pt_status = $('#pt_status').val();
	 //console.log(pt_status);
	 if(pt_status==2){
		 $('.confirm_order').show();
		 $("#order_pt").prop('required',true);
	 }else{
		 $('.confirm_order').hide();
		 $("#order_pt").prop('required',false);
	 }
	});


	$('.screen_type1').hide();
	$('.screen_type2').hide();
	$('.screen_type3').hide();
	$("#customControlValidation_rd1").click(function(){
			$('.screen_type1').show();
			$('.screen_type2').hide();
			$('.screen_type3').hide();
			$('#walkinplace_hosp_province').val(null).trigger('change');
			$('#walkinplace_hosp_code').val(null).trigger('change');
			$('#community_name').val('');
	});
	$("#customControlValidation_rd2").click(function(){
			$('.screen_type2').show();
			$('.screen_type1').hide();
			$('.screen_type3').hide();
			$('#airports_code').val(null).trigger('change');
			$('#community_name').val('');
	});
	$("#customControlValidation_rd3").click(function(){
			$('.screen_type3').show();
			$('.screen_type1').hide();
			$('.screen_type2').hide();
			$('#airports_code').val(null).trigger('change');
			$('#walkinplace_hosp_province').val(null).trigger('change');
			$('#walkinplace_hosp_code').val(null).trigger('change');
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
</script>
@endsection
