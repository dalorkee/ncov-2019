<article class="card">
	<hgroup class="card-body" style="margin:0;padding-top:10px;padding-bottom:0">
		<h1 class="card-title m-b-0 m-t-0 text-danger">2. ข้อมูลทางคลินิก</h1>
	</hgroup>
	<section class="card-body">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="ScreenPatient" class="text-danger">ประเภทผู้ป่วย</label>
					<select name="screen_pt" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-danger" id="screen_pt">
						@if ((!empty(old('screen_pt')) || !is_null($invest_pt[0]['screen_pt'])) && !empty($invest_pt[0]['screen_pt']) && $invest_pt[0]['screen_pt'] != '0')
							<option value="{{ old('screen_pt') ?? $invest_pt[0]['screen_pt'] }}" selected="selected">{{ $screen_pt[old('screen_pt')] ?? $screen_pt[$invest_pt[0]['screen_pt']] }}</option>
						@endif
						<option value="0">-- เลือกประเภทผู้ป่วย --</option>
						@foreach ($screen_pt as $key => $value)
							<option value="{{ $key }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="sickFirstDate" class="text-danger">วันที่เริ่มป่วย</label>
					<div class="input-group date">
						<div class="input-group">
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
							<input type="text" name="data3_1date_sickdate" value="{{ old('data3_1date_sickdate') ?? $data['data3_1date_sickdate'] }}" data-provide="datepicker" class="form-control border-outline border-danger" id="data3_1date_sickdate" readonly>
							<div class="input-group-append">
								<button type="button" class="input-group-text text-danger" id="cls_data3_1date_sickdate"><i class="fas fa-times"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="provinceSickFirst" class="text-danger">จังหวัดที่เริ่มป่วย</label>
					<select name="sick_province_first" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-danger" id="select_sick_province_first">
						@if ((!empty(old('sick_province_first')) || !is_null($invest_pt[0]['sick_province_first'])) && !empty($invest_pt[0]['sick_province_first']) && $invest_pt[0]['sick_province_first'] != '0')
							<option value="{{ old('sick_province_first') ?? $invest_pt[0]['sick_province_first'] }}" selected="selected">{{ $provinces[old('sick_province_first')]['province_name'] ?? $provinces[$invest_pt[0]['sick_province_first']]['province_name'] }}</option>
						@endif
						<option value="0">-- เลือกจังหวัด --</option>
						@foreach ($provinces as $key => $val)
							<option value="{{ $val['province_id'] }}" @if ($invest_pt[0]['sick_province_first'] == $val['province_id']) selected @endif>{{ $val['province_name'] }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="districtSickFirst" class="text-danger">อำเภอที่เริ่มป่วย</label>
					<select name="sick_district_first" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-danger" id="select_sick_district_first">
						@if (!is_null($invest_pt[0]['sick_district_first']) && !empty($invest_pt[0]['sick_district_first']) && $invest_pt[0]['sick_district_first'] != '0')
							<option value="{{ $sick_district_first[0]['district_id'] }}" selected="selected">{{ $sick_district_first[0]['district_name'] }}</option>
						@endif
						<option value="0">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<div class="form-group">
					<label for="subDistrictSickFirst" class="text-danger">ตำบลที่เริ่มป่วย</label>
					<select name="sick_sub_district_first" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-danger" id="select_sick_sub_district_first">
						@if (!is_null($invest_pt[0]['sick_sub_district_first']) && !empty($invest_pt[0]['sick_sub_district_first']) && $invest_pt[0]['sick_sub_district_first'] != '0')
							<option value="{{ $sick_sub_district_first[0]['sub_district_id'] }}" selected="selected">{{ $sick_sub_district_first[0]['sub_district_name'] }}</option>
						@endif
						<option value="0">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="date" class="text-cyan">วันที่เข้ารักษาครั้งแรก</label>
					<div class="input-group date">
						<div class="input-group-append">
							<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
						</div>
						<input type="text" name="treat_first_date" value="{{ old('treat_first_date') ?? $data['treat_first_date'] }}" data-provide="datepicker" class="form-control text-info border-outline border-cyan" id="treat_first_date" readonly>
						<div class="input-group-append">
							<button type="button" class="input-group-text text-danger" id="cls_treat_first_date"><i class="fas fa-times"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="provinceFirst" class="text-cyan">จังหวัดที่เข้ารักษาครั้งแรก</label>
					<select name="treatFirstProvinceInput" class="form-control selectpicker show-tick text-info" data-live-search="true" data-style="btn btn-outline-cyan" id="treat_first_province">
						@if ((!empty(old('treatFirstProvinceInput')) || !is_null($invest_pt[0]['treat_first_province'])) && !empty($invest_pt[0]['treat_first_province']) && $invest_pt[0]['treat_first_province'] != '0')
							<option value="{{ old('treatFirstProvinceInput') ?? $invest_pt[0]['treat_first_province'] }}" selected="selected">{{ $provinces[old('treatFirstProvinceInput')]['province_name'] ?? $provinces[$invest_pt[0]['treat_first_province']]['province_name'] }}</option>
						@endif
						<option value="0">-- เลือกจังหวัด --</option>
							@foreach($provinces as $key=>$val)
								<option value="{{ $val['province_id'] }}" @if ($invest_pt[0]['treat_first_province'] == $val['province_id']) selected @endif>{{ $val['province_name'] }}</option>
							@endforeach
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="district" class="text-cyan">อำเภอที่เข้ารักษาครั้งแรก</label>
					<select name="treatFirstDistrictInput" class="form-control selectpicker show-tick text-info" data-live-search="true" data-style="btn btn-outline-cyan" id="treat_first_district">
						@if (!empty($invest_pt[0]['treat_first_district']) && !is_null($invest_pt[0]['treat_first_district']) && $invest_pt[0]['treat_first_district'] != '0')
							<option value="{{ $treat_first_district[0]['district_id'] }}" selected="selected">{{ $treat_first_district[0]['district_name'] }}</option>
						@endif
						<option value="0">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="subDistrict" class="text-cyan">ตำบลที่เข้ารักษาครั้งแรก</label>
					<select name="treatFirstSubDistrictInput" class="form-control selectpicker show-tick text-info" data-live-search="true" data-style="btn btn-outline-cyan" id="treat_first_sub_district">
						@if (!empty($invest_pt[0]['treat_first_sub_district']) && !is_null($invest_pt[0]['treat_first_sub_district']) && $invest_pt[0]['treat_first_sub_district'] != '0')
							<option value="{{ $treat_first_sub_district[0]['sub_district_id'] }}" selected="selected">{{ $treat_first_sub_district[0]['sub_district_name'] }}</option>
						@endif
						<option value="0">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="treatFirstHosp" class="text-cyan">สถานพยาบาลที่รักษาครั้งแรก</label>
					<select name="treat_first_hospital" class="form-control selectpicker show-tick text-info" data-live-search="true" data-style="btn btn-outline-cyan" id="treatFirstHospital">
						@if (!empty($invest_pt[0]['treat_first_hospital']) && !is_null($invest_pt[0]['treat_first_hospital']) && $invest_pt[0]['treat_first_hospital'] != '0')
							<option value="{{ $invest_pt[0]['treat_first_hospital'] }}" selected="selected">{{ $treat_first_hospital[0]['hosp_name'] }}</option>
						@endif
						<option value="0">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="alert alert-success text-info">*** ข้อมูล <span class="text-danger">การรักษาปัจจุบัน</span> จะเปลี่ยนตามข้อมูล <span class="text-danger">การส่งต่อผู้ป่วย</span> โปรดตรวจสอบก่อนบันทึกข้อมูล</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="country" class="text-success">จังหวัดที่รักษาปัจจุบัน</label>
					<select name="treatPlaceProvinceInput" class="form-control selectpicker show-tick text-info" data-live-search="true" data-style="btn btn-outline-success" id="treat_place_province">
						@if ((!empty(old('treatPlaceProvinceInput')) || !is_null($invest_pt[0]['treat_place_province'])) && !empty($invest_pt[0]['treat_place_province']) && $invest_pt[0]['treat_place_province'] != '0')
							<option value="{{ old('treatPlaceProvinceInput') ?? $invest_pt[0]['treat_place_province'] }}" selected="selected">{{ $provinces[old('treatPlaceProvinceInput')]['province_name'] ?? $provinces[$invest_pt[0]['treat_place_province']]['province_name'] }}</option>
						@endif
						<option value="0">-- เลือกจังหวัด --</option>
						@php
							foreach($provinces as $key=>$val) {
								$htm = "<option value=\"".$val['province_id']."\"";
									if (old('provinceInput') == $val['province_id']) {
										$htm .= " selected=\"selected\"";
									}
								$htm .= ">".$val['province_name']."</option>\n";
								echo $htm;
							}
						@endphp
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="district" class="text-success">อำเภอที่รักษาปัจจุบัน</label>
					<select name="treatPlaceDistrictInput" class="form-control selectpicker show-tick text-info" data-live-search="true" data-style="btn btn-outline-success" id="treat_place_district">
						@if (!empty($invest_pt[0]['treat_place_district']) && !is_null($invest_pt[0]['treat_place_district']) && $invest_pt[0]['treat_place_district'] != '0')
							<option value="{{ $treat_place_district[0]['district_id'] }}" selected="selected">{{ $treat_place_district[0]['district_name'] }}</option>
						@endif
						<option value="0">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="subDistrict" class="text-success">ตำบลที่รักษาปัจจุบัน</label>
					<select name="treatPlaceSubDistrictInput" class="form-control selectpicker show-tick text-info" data-live-search="true" data-style="btn btn-outline-success" id="treat_place_sub_district">
						@if (!empty($invest_pt[0]['treat_place_sub_district']) && !is_null($invest_pt[0]['treat_place_sub_district']) && $invest_pt[0]['treat_place_sub_district'] != '0')
							<option value="{{ $treat_place_sub_district[0]['sub_district_id'] }}" selected="selected">{{ $treat_place_sub_district[0]['sub_district_name'] }}</option>
						@endif
						<option value="0">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="currentTreat" class="text-success">สถานที่รักษาปัจจุบัน</label>
					<select name="treat_place_hospital" class="form-control selectpicker show-tick text-info" data-live-search="true" data-style="btn btn-outline-success" id="treatPlaceHospital">
						@if (!empty($invest_pt[0]['treat_place_hospital']) && !is_null($invest_pt[0]['treat_place_hospital']) && $invest_pt[0]['treat_place_hospital'] != '0')
							<option value="{{ $invest_pt[0]['treat_place_hospital'] }}" selected="selected">{{ $treat_place_hospital[0]['hosp_name'] }}</option>
						@endif
						<option value="0">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="treatment">สถานะผู้ป่วย</label>
					<div class="card">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" name="patientTreatStatus" value="1" @if ($invest_pt[0]['patient_treat_status'] == '1' || old('patientTreatStatus') == '1') checked @endif class="custom-control-input chk-treatment" id="treatment_cured">
							<label for="treatment_cured" class="custom-control-label normal-label">หาย</label>
						</div>
						<div class="custom-control custom-checkbox">
							<input type="checkbox" name="patientTreatStatus" value="2" @if ($invest_pt[0]['patient_treat_status'] == '2' || old('patientTreatStatus') == '2') checked @endif class="custom-control-input chk-treatment" id="treatment_treat">
							<label for="treatment_treat" class="custom-control-label normal-label">อยู่ระหว่างการรักษา</label>
						</div>
						<div class="custom-control custom-checkbox">
							<input type="checkbox" name="patientTreatStatus" value="3" @if ($invest_pt[0]['patient_treat_status'] == '3' || old('patientTreatStatus') == '3') checked @endif class="custom-control-input chk-treatment" id="treatment_dead">
							<label for="treatment_dead" class="custom-control-label normal-label">เสียชีวิต</label>
						</div>
						<div class="custom-control custom-checkbox">
							<input type="checkbox" name="patientTreatStatus" value="4" @if ($invest_pt[0]['patient_treat_status'] == '4' || old('patientTreatStatus') == '4') checked @endif class="custom-control-input chk-treatment" id="treatment_refer">
							<label for="treatment_refer" class="custom-control-label normal-label text-danger">ส่งต่อไปรักษาที่ *** สัมพันธ์กับข้อมูลการรักษาปัจจุบัน</label>
						</div>
						<div class="child-box form-row alert alert-success">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
								<div class="form-group">
									<label for="referProvince" class="text-danger">จังหวัดที่ส่งต่อไปรักษา</label>
									<select name="patient_treat_status_refer_province" class="form-control selectpicker show-tick" data-live-search="true" id="patient_treat_status_refer_province">
										@if ((!empty(old('patient_treat_status_refer_province')) || !is_null($invest_pt[0]['patient_treat_status_refer_province'])) && !empty($invest_pt[0]['patient_treat_status_refer_province']) && $invest_pt[0]['patient_treat_status_refer_province'] != '0')
											<option value="{{ old('patient_treat_status_refer_province') ?? $invest_pt[0]['patient_treat_status_refer_province'] }}" selected="selected">{{ $provinces[old('patient_treat_status_refer_province')]['province_name'] ?? $provinces[$invest_pt[0]['patient_treat_status_refer_province']]['province_name'] }}</option>
										@endif
										<option value="0">-- เลือกจังหวัด --</option>
										@php
											foreach($provinces as $key=>$val) {
												$htm = "<option value=\"".$val['province_id']."\"";
													if (old('provinceInput') == $val['province_id']) {
														$htm .= " selected=\"selected\"";
													}
												$htm .= ">".$val['province_name']."</option>\n";
												echo $htm;
											}
										@endphp
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
								<div class="form-group">
									<label for="referDistrict" class="text-danger">อำเภอที่ส่งต่อไปรักษา</label>
									<select name="patient_treat_status_refer_district" class="form-control selectpicker show-tick" data-live-search="true" id="refer_district">
										@if (!empty($invest_pt[0]['patient_treat_status_refer_district']) && !is_null($invest_pt[0]['patient_treat_status_refer_district']) && $invest_pt[0]['patient_treat_status_refer_district'] != '0')
											<option value="{{ $refer_district[0]['district_id'] }}" selected="selected">{{ $refer_district[0]['district_name'] }}</option>
										@endif
										<option value="0">-- โปรดเลือก --</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
								<div class="form-group">
									<label for="refersubDistrict" class="text-danger">ตำบลที่ส่งต่อไปรักษา</label>
									<select name="patient_treat_status_refer_sub_district" class="form-control selectpicker show-tick" data-live-search="true" id="refer_sub_district">
										@if (!empty($invest_pt[0]['patient_treat_status_refer_sub_district']) && !is_null($invest_pt[0]['patient_treat_status_refer_sub_district']) && $invest_pt[0]['patient_treat_status_refer_sub_district'] != '0')
											<option value="{{ $refer_sub_district[0]['sub_district_id'] }}" selected="selected">{{ $refer_sub_district[0]['sub_district_name'] }}</option>
										@endif
										<option value="0">-- โปรดเลือก --</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
								<div class="form-group">
									<label for="referHosp" class="text-danger">สถานพยาบาลที่ส่งต่อไปรักษา</label>
									<select name="patient_treat_status_refer" class="form-control selectpicker show-tick" data-live-search="true" id="patient_treat_status_refer">
										@if (!empty($invest_pt[0]['patient_treat_status_refer']) && !is_null($invest_pt[0]['patient_treat_status_refer']) && $invest_pt[0]['patient_treat_status_refer'] != '0')
											<option value="{{ $invest_pt[0]['patient_treat_status_refer'] }}" selected="selected">{{ $patient_treat_status_refer[0]['hosp_name'] }}</option>
										@endif
										<option value="0">-- โปรดเลือก --</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
								<div class="form-group">
									<label for="referDate" class="text-danger">วันที่ส่งต่อไปรักษา</label>
									<div class="input-group date">
										<div class="input-group-append">
											<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
										</div>
										<input type="text" name="patient_treat_status_refer_date" value="{{ old('patient_treat_status_refer_date') ?? $data['patient_treat_status_refer_date'] }}" data-provide="datepicke" id="patient_treat_status_refer_date" class="form-control" readonly>
										<div class="input-group-append">
											<button type="button" class="input-group-text text-danger" id="cls_patient_treat_status_refer_date"><i class="fas fa-times"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="custom-control custom-checkbox">
							<input type="checkbox" name="patientTreatStatus" value="5" @if ($invest_pt[0]['patient_treat_status'] == '5'  || old('patientTreatStatus') == '5') checked @endif class="custom-control-input chk-treatment" id="treatment_other">
							<label for="treatment_other" class="custom-control-label normal-label">อื่นๆ โปรดระบุ</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
				<div class="form-group">
					<label for="status">สถานะอื่นๆ ระบุ</label>
					<div class="input-group">
						<input type="text" name="patient_treat_status_other" value="{{ old('patient_treat_status_other') ?? $invest_pt[0]['patient_treat_status_other'] }}" class="form-control" placeholder="โปรดระบุ">
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="villageNo">ประวัติมีไข้</label>
					<div class="card">
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="fever_history" value="n" class="custom-control-input fever_history" id="fever_history_no" @if ($invest_pt[0]['fever_history'] == 'n' || old('fever_history') =="n") checked @endif>
							<label for="fever_history_no" class="custom-control-label normal-label">ไม่มี</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="fever_history" value="y" class="custom-control-input fever_history" id="fever_history_yes" @if ($invest_pt[0]['fever_history'] == 'y' || old('fever_history') == 'y') checked @endif>
							<label for="fever_history_yes" class="custom-control-label normal-label">มี</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
					<label for="body_temperature">อุณหภูมิร่างกายแรกรับ</label>
					<div class="input-group">
						<input type="text" name="body_temperature_first" value="{{ old('body_temperature_first') ?? $invest_pt[0]['body_temperature_first'] }}" class="form-control">
						<div class="input-group-append">
							<span class="input-group-text">C&#176;</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
					<label for="oxygen">ความเข้มข้นของ Oxygen (O2Sat)</label>
					<div class="input-group">
						<input type="text" name="oxygen_saturate" value="{{ old('oxygen_saturate') ?? $invest_pt[0]['oxygen_saturate'] }}" class="form-control">
						<div class="input-group-append">
							<span class="input-group-text">%</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="informant">อาการ</label>
					<div class="card">
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="sym_cough" value="y" class="custom-control-input pt-type" id="coughChk" @if ($invest_pt[0]['sym_cough'] == 'y' || old('sym_cough') == 'y') checked @endif>
							<label for="coughChk" class="custom-control-label normal-label">ไอ</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="sym_sore" value="y" class="custom-control-input pt-type" id="soreChk" @if ($invest_pt[0]['sym_sore'] == 'y' || old('sym_sore') == 'y') checked @endif>
							<label for="soreChk" class="custom-control-label normal-label">เจ็บคอ</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="sym_muscle" value="y" class="custom-control-input pt-type" id="muscleChk" @if ($invest_pt[0]['sym_muscle'] == 'y' || old('sym_muscle') == 'y') checked @endif>
							<label for="muscleChk" class="custom-control-label normal-label">ปวดกล้ามเนื้อ</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="sym_snot" value="y" class="custom-control-input pt-type" id="snotChk" @if ($invest_pt[0]['sym_snot'] == 'y' || old('sym_snot') == 'y') checked @endif>
							<label for="snotChk" class="custom-control-label normal-label">มีน้ำมูก</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="sym_sputum" value="y" class="custom-control-input pt-type" id="sputumChk" @if ($invest_pt[0]['sym_sputum'] == 'y' || old('sym_sputum') == 'y') checked @endif>
							<label for="sputumChk" class="custom-control-label normal-label">มีเสมหะ</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="sym_breathe" value="y" class="custom-control-input pt-type" id="breatheChk" @if ($invest_pt[0]['sym_breathe'] == 'y' || old('sym_breathe') == 'y') checked @endif>
							<label for="breatheChk" class="custom-control-label normal-label">หายใจลำบาก (dyspnea)</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="sym_headache" value="y" class="custom-control-input pt-type" id="headacheChk" @if ($invest_pt[0]['sym_headache'] == 'y' || old('sym_headache') == 'y') checked @endif>
							<label for="headacheChk" class="custom-control-label normal-label">ปวดศีรษะ</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="sym_diarrhoea" value="y" class="custom-control-input pt-type" id="diarrhoeaChk" @if ($invest_pt[0]['sym_diarrhoea'] == 'y' || old('sym_diarrhoea') == 'y') checked @endif>
							<label for="diarrhoeaChk" class="custom-control-label normal-label">ถ่ายเหลว</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="sym_other" value="y" class="custom-control-input pt-type" id="symOtherChk" @if ($invest_pt[0]['sym_other'] == 'y' || old('sym_other') == 'y') checked @endif>
							<label for="symOtherChk" class="custom-control-label normal-label">อาการอื่นๆ</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="lane">อาการอื่นๆ โปรดระบุ</label>
					<div class="input-group">
						<input type="text" name="sym_other_text" value="{{ old('sym_other_text') ?? $invest_pt[0]['sym_othertext'] }}" class="form-control" placeholder="โปรดระบุ">
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="">ใส่ท่อช่วยหายใจ</label>
					<div class="card">
						<div class="custom-control custom-checkbox custom-control">
							<input type="checkbox" name="breathingTubeChk" value="n" @if ($invest_pt[0]['breathing_tube_chk'] == 'n' || old('breathingTubeChk') == 'n') checked @endif class="custom-control-input chk_breathing_Tube" id="breathingTubeChkNo">
							<label for="breathingTubeChkNo" class="custom-control-label normal-label">ไม่ใส่</label>
						</div>
						<div class="custom-control custom-checkbox custom-control">
							<input type="checkbox" name="breathingTubeChk" value="y" @if ($invest_pt[0]['breathing_tube_chk'] == 'y' || old('breathingTubeChk') == 'y') checked @endif class="custom-control-input chk_breathing_Tube" id="breathingTubeChkYes">
							<label for="breathingTubeChkYes" class="custom-control-label normal-label">ใส่</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="date">ระบุวันที่ใส่ท่อช่วยหายใจ</label>
					<div class="input-group date">
						<div class="input-group-append">
							<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
						</div>
						<input type="text" name="breathing_tube_date" value="{{ old('breathing_tube_date') ?? $data['breathing_tube_date'] }}" data-provide="datepicker" id="breathing_tube_date" class="form-control" readonly>
						<div class="input-group-append">
							<button type="button" class="input-group-text text-danger" id="cls_breathing_tube_date"><i class="fas fa-times"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="xrayCxr">เอ็กซเรย์ปอด (ครั้งแรก)</label>
					<div class="card">
						<div class="custom-control custom-checkbox custom-control">
							<input type="checkbox" name="lab_cxr1_chk" value="n" @if ($invest_pt[0]['lab_cxr1_chk'] == 'n' || old('lab_cxr1_chk') == 'n') checked @endif class="custom-control-input chk_cxr" id="labCxrChkNo">
							<label for="labCxrChkNo" class="custom-control-label normal-label">ไม่ทำ</label>
						</div>
						<div class="custom-control custom-checkbox custom-control">
							<input type="checkbox" name="lab_cxr1_chk" value="y" @if ($invest_pt[0]['lab_cxr1_chk'] == 'y' || old('lab_cxr1_chk') == 'y') checked @endif class="custom-control-input chk_cxr" id="labCxrChkYes">
							<label for="labCxrChkYes" class="custom-control-label normal-label">ทำ</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="xRaydateInput">เมื่อวันที่</label>
					<div class="input-group date">
						<div class="input-group-append">
							<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
						</div>
						<input type="text" name="labCxr1Date" value="{{ old('labCxr1Date') ?? $data['lab_cxr1_date'] }}" data-provide="datepicke" id="lab_cxr1_date" class="form-control" readonly>
						<div class="input-group-append">
							<button type="button" class="input-group-text text-danger" id="cls_lab_cxr1_date"><i class="fas fa-times"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<label for="xrayResult">ผลเอ็กเรย์</label>
				<div class="card">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" name="labCxr1Result" value="normal" @if ($invest_pt[0]['lab_cxr1_result'] == 'normal' || old('labCxr1Result') == 'normal') checked @endif class="custom-control-input lab_cxr1_result" id="labCxr1ResultNormal">
						<label for="labCxr1ResultNormal" class="custom-control-label normal-label">ปกติ</label>
					</div>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" name="labCxr1Result" value="unusual" @if ($invest_pt[0]['lab_cxr1_result'] == 'unusual' || old('labCxr1Result') == 'unusual') checked @endif class="custom-control-input lab_cxr1_result" id="labCxr1ResultUnusual">
						<label for="labCxr1ResultUnusual" class="custom-control-label normal-label">ผิดปกติ</label>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="xrayOtherDetail">ผลเอ็กเรย์อื่นๆ โปรดระบุ</label>
					<div class="input-group">
						<input type="text" name="labCxr1Detail" value="{{ old('labCxr1Detail') ?? $invest_pt[0]['lab_cxr1_detail'] }}" class="form-control">
					</div>
				</div>
			</div>
			<!--
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="fileInput" class="text-danger">อับโหลดภาพเอ็กเรย์ (ใช้เมนูอับโหลดไฟล์)</label>
					<div class="input-group">
						<div class="custom-file">
							<input type="file" name="labCxr1File" class="custom-file-input" id="lab_cxr1_file">
							<label class="custom-file-label border-warning" for="customFile">Choose file</label>
						</div>
					</div>
				</div>
			</div>

			if (!is_null($invest_pt[0]['lab_cxr1_file']))
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="alert alert-primary" role="alert">
						<h5 class="alert-heading">ไฟล์แนบของคุณ</h5>
						<ul style="list-style-type:none;">
							<li><span class="span-80">ชื่อไฟล์:</span> { $invest_pt[0]['lab_cxr1_file'] }}</li>
							<li><span class="span-80">ขนาด:</span> { number_format($xray_file_size, 2, '.', '') }} KB</li>
							<li><span class="span-80">ดาวน์โหลด:</span><a href="{ route('invest.downloadXrayFile', [$invest_pt[0]['id']]) }}">คลิกที่นี่</a></li>
						</ul>
					</div>
				</div>
			else
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="alert alert-warning" role="alert">
						<h5 class="alert-heading">ยังไม่มีไฟล์แนบ</h5>
					</div>
				</div>
			endif
			-->
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="cbcDateInput">CBC (ครั้งแรก): วันที่</label>
					<div class="input-group date">
						<div class="input-group-append">
							<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
						</div>
						<input type="text" name="labCbcDate" value="{{ old('labCbcDate') ?? $data['lab_cbc_date'] }}" data-provide="datepicke" id="lab_cbc_date" class="form-control" readonly>
						<div class="input-group-append">
							<button type="button" class="input-group-text text-danger" id="cls_lab_cbc_date"><i class="fas fa-times"></i></button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="hbInput">Hb</label>
					<div class="input-group">
						<input type="text" name="labCbcHb" value="{{ old('labCbcHb') ?? $invest_pt[0]['lab_cbc_hb'] }}" class="form-control">
						<div class="input-group-append">
							<span class="input-group-text">mg%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<label for="htcInput">Hct</label>
				<div class="input-group">
					<input type="text" name="labCbcHct" value="{{ old('labCbcHct') ?? $invest_pt[0]['lab_cbc_hct'] }}" class="form-control">
					<div class="input-group-append">
						<span class="input-group-text">%</span>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<label for="plaInput">Platelet count</label>
				<div class="input-group">
					<input type="text" name="labCbcPlateletCount" value="{{ old('labCbcPlateletCount') ?? $invest_pt[0]['lab_cbc_platelet_count'] }}" class="form-control">
					<div class="input-group-append">
						<span class="input-group-text">x10<sup>3</sup></span>
					</div>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<label for="wbcInput">WBC</label>
				<input type="text" name="labCbcWbc" value="{{ old('labCbcWbc') ?? $invest_pt[0]['lab_cbc_wbc'] }}" class="form-control">
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="neuInput">N</label>
					<div class="input-group">
						<input type="text" name="labCbcNeutrophil" value="{{ old('labCbcNeutrophil') ?? $invest_pt[0]['lab_cbc_neutrophil'] }}" class="form-control">
						<div class="input-group-append">
							<span class="input-group-text">%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="lmpInput">L</label>
					<div class="input-group">
						<input type="text" name="labCbcLymphocyte" value="{{ old('labCbcLymphocyte') ?? $invest_pt[0]['lab_cbc_lymphocyte'] }}" class="form-control">
						<div class="input-group-append">
							<span class="input-group-text">%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="atypInput">Atyp lymph</label>
					<div class="input-group">
						<input type="text" name="lab_cbc_atyp_lymph" value="{{ old('lab_cbc_atyp_lymph') ?? $invest_pt[0]['lab_cbc_atyp_lymph'] }}" class="form-control">
						<div class="input-group-append">
							<span class="input-group-text">%</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="atypInput">Mono</label>
					<div class="input-group">
						<input type="text" name="lab_cbc_mono" value="{{ old('lab_cbc_mono') ?? $invest_pt[0]['lab_cbc_mono'] }}" class="form-control">
						<div class="input-group-append">
							<span class="input-group-text">%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-9 col-xl-9">
				<div class="form-group">
					<label for="lane">อื่นๆ โปรดระบุ</label>
					<div class="input-group">
						<input type="text" name="lab_cbc_other" value="{{ old('lab_cbc_other') ?? $invest_pt[0]['lab_cbc_other'] }}" class="form-control" placeholder="โปรดระบุ">
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
					<label for="lane">ผลการตรวจ Influenza test (วิธีการตรวจ)</label>
					<div class="input-group">
						<input type="text" name="lab_rapid_test_method" value="{{ old('lab_rapid_test_method') ?? $invest_pt[0]['lab_rapid_test_method'] }}" class="form-control" placeholder="โปรดระบุ">
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
					<label for="rapidtest">ตรวจเมื่อวันที่</label>
					<div class="input-group date">
						<div class="input-group-append">
							<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
						</div>
						<input type="text" name="labRapidTestDate" value="{{ old('labRapidTestDate') ?? $data['lab_rapid_test_date'] }}" data-provide="datepicke" id="lab_rapid_test_date" class="form-control" readonly>
						<div class="input-group-append">
							<button type="button" class="input-group-text text-danger" id="cls_lab_rapid_test_date"><i class="fas fa-times"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<label for="result">ผลการตรวจ</label>
				<div>
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="labRapidTestResult" value="nagative" @if ($invest_pt[0]['lab_rapid_test_result'] == 'nagative' || old('labRapidTestResult') == 'nagative') checked @endif  class="custom-control-input lab_rapid_test_result" id="labRapidTestResultNagative">
						<label for="labRapidTestResultNagative" class="custom-control-label normal-label">Negative</label>
					</div>
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="labRapidTestResult" value="positive" @if ($invest_pt[0]['lab_rapid_test_result'] == 'positive' || old('labRapidTestResult') == 'positive') checked @endif class="custom-control-input lab_rapid_test_result" id="labRapidTestResultPositive">
						<label for="labRapidTestResultPositive" class="custom-control-label normal-label">Positive</label>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<label for="result">ชนิดเชื้อ (เลือกได้มากกว่า 1 เชื้อ)</label>
				<div>
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="lab_rapid_test_pathogen_flu_a" value="y" @if ($invest_pt[0]['lab_rapid_test_pathogen_flu_a'] == 'y' || old('lab_rapid_test_pathogen_flu_a') == 'y') checked @endif  class="custom-control-input lab_rapid_test_pathogen" id="labRapidTestResultFlua">
						<label for="labRapidTestResultFlua" class="custom-control-label normal-label">Influenza A</label>
					</div>
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="lab_rapid_test_pathogen_flu_b" value="y" @if ($invest_pt[0]['lab_rapid_test_pathogen_flu_b'] == 'y' || old('lab_rapid_test_pathogen_flu_b') == 'y') checked @endif class="custom-control-input lab_rapid_test_pathogen" id="labRapidTestResultFlub">
						<label for="labRapidTestResultFlub" class="custom-control-label normal-label">Influenza B</label>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<label for="result">PCR for COVID-19</label>
				<table class="table table-striped table-bordered">
					<!--<caption>PCR for COVID-19</caption>-->
					<thead class="bg-custom-1 text-light">
						<tr>
							<th scope="col">ครั้งที่</th>
							<th scope="col">วันที่เก็บ</th>
							<th scope="col">ชนิดตัวอย่าง</th>
							<th scope="col">สถานที่ตรวจ</th>
							<th scope="col">ผลตรวจ</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td scope="row">1</td>
							<td>
								<div class="form-group">
									<div class="input-group date">
										<div class="input-group-append">
											<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
										</div>
										<input type="text" name="lab_sars_cov2_no_1_date" value="{{ old('lab_sars_cov2_no_1_date') ?? $data['lab_sars_cov2_no_1_date'] }}" data-provide="datepicke" id="sars_cov2_date1" class="form-control" readonly>
										<div class="input-group-append">
											<button type="button" class="input-group-text text-danger" id="cls_sars_cov2_date1"><i class="fas fa-times"></i></button>
										</div>
									</div>
								</div>
							</td>
							<td>
								<select name="lab_sars_cov2_no_1_specimen" class="form-control selectpicker show-tick text-info" data-live-search="true">
									@if ((!empty(old('lab_sars_cov2_no_1_specimen')) || !is_null($invest_pt[0]['lab_sars_cov2_no_1_specimen'])) && !empty($invest_pt[0]['lab_sars_cov2_no_1_specimen']) && $invest_pt[0]['lab_sars_cov2_no_1_specimen'] != '0')
										<option value="{{ old('lab_sars_cov2_no_1_specimen') ?? $invest_pt[0]['lab_sars_cov2_no_1_specimen'] }}" selected="selected">{{ $ref_specimen[old('lab_sars_cov2_no_1_specimen')]['name_en'] ?? $ref_specimen[$invest_pt[0]['lab_sars_cov2_no_1_specimen']]['name_en'] }}</option>
									@endif
									<option value="0">- โปรดเลือก -</option>
									@foreach ($ref_specimen as $key => $value)
										<option value="{{ $value['id'] }}">{{ $value['name_en'] }}</option>
									@endforeach
								</select>
							</td>
							<td>
								<div class="form-group">
									<select name="lab_sars_cov2_no_1_lab" class="form-control selectpicker show-tick text-info" data-live-search="true">
										@if ((!empty(old('lab_sars_cov2_no_1_lab')) || !is_null($invest_pt[0]['lab_sars_cov2_no_1_lab'])) && !empty($invest_pt[0]['lab_sars_cov2_no_1_lab']) && $invest_pt[0]['lab_sars_cov2_no_1_lab'] != '0')
											<option value="{{ old('lab_sars_cov2_no_1_lab') ?? $invest_pt[0]['lab_sars_cov2_no_1_lab'] }}" selected="selected">{{ $lab_station[old('lab_sars_cov2_no_1_lab')]['th_name'] ?? $lab_station[$invest_pt[0]['lab_sars_cov2_no_1_lab']]['th_name'] }}</option>
										@endif
										<option value="0">- โปรดเลือก -</option>
										@foreach ($lab_station as $key => $value)
											<option value="{{ $value['id'] }}">{{ $value['th_name'] }}</option>
										@endforeach
									</select>
								</div>
							</td>
							<td>
								<select name="lab_sars_cov2_no_1_result" class="form-control selectpicker show-tick text-info" data-live-search="true">
									@if ((!empty(old('lab_sars_cov2_no_1_result')) || !is_null($invest_pt[0]['lab_sars_cov2_no_1_result'])) && !empty($invest_pt[0]['lab_sars_cov2_no_1_result']) && $invest_pt[0]['lab_sars_cov2_no_1_result'] != '0')
										<option value="{{ old('lab_sars_cov2_no_1_result') ?? $invest_pt[0]['lab_sars_cov2_no_1_result'] }}" selected="selected">{{ $lab_status[old('lab_sars_cov2_no_1_result')] ?? $lab_status[$invest_pt[0]['lab_sars_cov2_no_1_result']] }}</option>
									@endif
									<option value="0">- โปรดเลือก -</option>
									<option value="Process">รอผล</option>
									<option value="Detected">Detected</option>
									<option value="Not detected">Not detected</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>2</td>
							<td>
								<div class="form-group">
									<div class="input-group date">
										<div class="input-group-append">
											<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
										</div>
										<input type="text" name="lab_sars_cov2_no_2_date" value="{{ old('lab_sars_cov2_no_2_date') ?? $data['lab_sars_cov2_no_2_date'] }}" data-provide="datepicke" id="sars_cov2_date2" class="form-control" readonly>
										<div class="input-group-append">
											<button type="button" class="input-group-text text-danger" id="cls_sars_cov2_date2"><i class="fas fa-times"></i></button>
										</div>
									</div>
								</div>
							</td>
							<td>
								<select name="lab_sars_cov2_no_2_specimen" class="form-control selectpicker show-tick text-info" data-live-search="true">
									@if ((!empty(old('lab_sars_cov2_no_2_specimen')) || !is_null($invest_pt[0]['lab_sars_cov2_no_2_specimen'])) && !empty($invest_pt[0]['lab_sars_cov2_no_2_specimen']) && $invest_pt[0]['lab_sars_cov2_no_2_specimen'] != '0')
										<option value="{{ old('lab_sars_cov2_no_2_specimen') ?? $invest_pt[0]['lab_sars_cov2_no_2_specimen'] }}" selected="selected">{{ $ref_specimen[old('lab_sars_cov2_no_2_specimen')]['name_en'] ?? $ref_specimen[$invest_pt[0]['lab_sars_cov2_no_2_specimen']]['name_en'] }}</option>
									@endif
									<option value="0">- โปรดเลือก -</option>
									@foreach ($ref_specimen as $key => $value)
										<option value="{{ $value['id'] }}">{{ $value['name_en'] }}</option>
									@endforeach
								</select>
							</td>
							<td>
								<div class="form-group">
									<select name="lab_sars_cov2_no_2_lab" class="form-control selectpicker show-tick text-info" data-live-search="true">
										@if ((!empty(old('lab_sars_cov2_no_2_lab')) || !is_null($invest_pt[0]['lab_sars_cov2_no_2_lab'])) && !empty($invest_pt[0]['lab_sars_cov2_no_2_lab']) && $invest_pt[0]['lab_sars_cov2_no_2_lab'] != '0')
											<option value="{{ old('lab_sars_cov2_no_2_lab') ?? $invest_pt[0]['lab_sars_cov2_no_2_lab'] }}" selected="selected">{{ $lab_station[old('lab_sars_cov2_no_2_lab')]['th_name'] ?? $lab_station[$invest_pt[0]['lab_sars_cov2_no_2_lab']]['th_name'] }}</option>
										@endif
										<option value="0">- โปรดเลือก -</option>
										@foreach ($lab_station as $key => $value)
											<option value="{{ $value['id'] }}">{{ $value['th_name'] }}</option>
										@endforeach
									</select>
								</div>
							</td>
							<td>
								<select name="lab_sars_cov2_no_2_result" class="form-control selectpicker show-tick text-info" data-live-search="true">
									@if ((!empty(old('lab_sars_cov2_no_2_result')) || !is_null($invest_pt[0]['lab_sars_cov2_no_2_result'])) && !empty($invest_pt[0]['lab_sars_cov2_no_2_result']) && $invest_pt[0]['lab_sars_cov2_no_2_result'] != '0')
										<option value="{{ old('lab_sars_cov2_no_2_result') ?? $invest_pt[0]['lab_sars_cov2_no_2_result'] }}" selected="selected">{{ $lab_status[old('lab_sars_cov2_no_2_result')] ?? $lab_status[$invest_pt[0]['lab_sars_cov2_no_2_result']] }}</option>
									@endif
									<option value="0">- โปรดเลือก -</option>
									<option value="Process">รอผล</option>
									<option value="Detected">Detected</option>
									<option value="Not detected">Not detected</option>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="villageNo">ประเภทผู้ป่วย</label>
					<div class="card">
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="treat_patient_type" value="opd" class="custom-control-input treat_patient_type" id="treat_patient_type_opd" @if ($invest_pt[0]['treat_patient_type'] == 'opd' || old('treat_patient_type') == 'opd') checked @endif>
							<label for="treat_patient_type_opd" class="custom-control-label normal-label">ผู้ป่วยนอก (OPD)</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="treat_patient_type" value="ipd" class="custom-control-input treat_patient_type" id="treat_patient_type_ipd" @if ($invest_pt[0]['treat_patient_type'] == 'ipd' || old('treat_patient_type') == 'ipd') checked @endif>
							<label for="treat_patient_type_ipd" class="custom-control-label normal-label">ผู้ป่วยใน (IPD)</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="date">Admited วันที่</label>
					<div class="input-group date">
						<div class="input-group-append">
							<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
						</div>
						<input type="text" name="treat_place_date" value="{{ old('treat_place_date') ?? $data['treat_place_date'] }}" data-provide="datepicker" id="treat_place_date" class="form-control" readonly>
						<div class="input-group-append">
							<button type="button" class="input-group-text text-danger" id="cls_treat_place_date"><i class="fas fa-times"></i></button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8 col-xl-8">
				<div class="form-group">
					<label for="first_diag">การวินิจฉัยเบื้องต้น</label>
					<div class="input-group">
						<input type="text" name="firstDiagInput" value="{{ old('firstDiagInput') ?? $invest_pt[0]['first_diag'] }}" class="form-control" placeholder="แพทย์วินิจฉัยเบื้องต้น">
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<label for="coronaDrug">การให้ยารักษาโรคติดเชื้อไวรัสโคโรนา 2019</label>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="card">
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="covid19Drugchk" value="n" @if ($invest_pt[0]['covid19_drug_medicate'] == 'n' || old('covid19Drugchk') == 'n') checked @endif class="custom-control-input chk_covid19_drug" id="covid19DrugchkNo">
						<label for="covid19DrugchkNo" class="custom-control-label normal-label">ไม่ให้</label>
					</div>
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="covid19Drugchk" value="y" @if ($invest_pt[0]['covid19_drug_medicate'] == 'y' || old('covid19Drugchk') == 'y') checked @endif class="custom-control-input chk_covid19_drug" id="covid19DrugchkYes">
						<label for="covid19DrugchkYes" class="custom-control-label normal-label">ให้ (กรุณาระบุวันที่)</label>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="covidDrugDate">วันที่ให้ยาโดสแรก</label>
					<div class="input-group date">
						<div class="input-group-append">
							<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
						</div>
						<input type="text" name="covid19_drug_medicate_first_date" value="{{ old('covid19_drug_medicate_first_date') ?? $data['covid19_drug_medicate_first_date'] }}" data-provide="datepicke" id="covid19_drug_medicate_first_date" class="form-control" readonly>
						<div class="input-group-append">
							<button type="button" class="input-group-text text-danger" id="cls_covid19_drug_medicate_first_date"><i class="fas fa-times"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="covidDrug">ชนิดยารักษาโรคติดเชื้อไวรัสโคโรนา 2019</label>
					<div class="card">
						@foreach ($covid19_drug_medicate_name as $key => $value)
							@php
								$i = ((int)$key-1);
							@endphp
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="covid19_drug_medicate_name[]" value="{{ old('covid19_drug_medicate_name.'.$i) ?? $key }}" @if ($key == old('covid19_drug_medicate_name.'.$i) || $key == $drug_result[$key]) checked @endif class="custom-control-input chk_covid_drug_name" id="drugName{{$value}}"  >
								<label for="drugName{{$value}}" class="custom-control-label normal-label">{{ $value }}</label>
							</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
				<div class="form-group">
					<label for="lane">ยาอื่นๆ ระบุ</label>
					<div class="input-group">
						<input type="text" name="covid19_drug_medicate_name_other" value="{{ old('covid19_drug_medicate_name_other') ?? $invest_pt[0]['covid19_drug_medicate_name_other'] }}" class="form-control" placeholder="โปรดระบุ">
					</div>
				</div>
			</div>
		</div>
	</section>
</article><!-- card2 -->
