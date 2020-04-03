<article class="card">
	<hgroup class="card-body" style="margin:0;padding-top:10px;padding-bottom:0">
		<h1 class="card-title m-b-0 m-t-0 text-danger">2. ข้อมูลทางคลินิก</h1>
	</hgroup>
	<section class="card-body">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="sickFirstDate" class="text-danger">วันที่เริ่มป่วย</label>
					<div class="input-group date" data-provide="datepicker" id="data3_1date_sickdate">
						<div class="input-group">
							<input type="text" name="data3_1date_sickdate" value="{{ $data['data3_1date_sickdate'] }}" class="form-control border-outline border-danger">
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="provinceSickFirst" class="text-danger">จังหวัดที่เริ่มป่วย</label>
					<select name="sick_province_first" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-danger" id="select_sick_province_first">
						@if (!empty($invest_pt[0]['sick_province_first']))
							<option value="{{ $invest_pt[0]['sick_province_first'] }}" selected="selected">{{ $provinces[$invest_pt[0]['sick_province_first']]['province_name'] }}</option>
						@endif
						<option value="">-- เลือกจังหวัด --</option>
						@foreach($provinces as $key => $val)
							<option value="{{ $val['province_id'] }}" @if ($invest_pt[0]['sick_province_first'] == $val['province_id']) selected @endif>{{ $val['province_name'] }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="districtSickFirst" class="text-danger">อำเภอที่เริ่มป่วย</label>
					<select name="sick_district_first" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-danger" id="select_sick_district_first">
						@if (!empty($invest_pt[0]['sick_district_first']))
							<option value="{{ $sick_district_first[0]['district_id'] }}" selected="selected">{{ $sick_district_first[0]['district_name'] }}</option>
						@endif
						<option value="">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<div class="form-group">
					<label for="subDistrictSickFirst" class="text-danger">ตำบลที่เริ่มป่วย</label>
					<select name="sick_sub_district_first" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-danger" id="select_sick_sub_district_first">
						@if (!empty($invest_pt[0]['sick_sub_district_first']))
							<option value="{{ $sick_sub_district_first[0]['sub_district_id'] }}" selected="selected">{{ $sick_sub_district_first[0]['sub_district_name'] }}</option>
						@endif
						<option value="">-- โปรดเลือก --</option>
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
					<div class="input-group date" data-provide="datepicker" id="treat_first_date">
						<input type="text" name="treat_first_date" value="{{ $data['treat_first_date'] }}" class="form-control text-info border-outline border-cyan">
						<div class="input-group-append">
							<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
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
						@if (!empty($invest_pt[0]['treat_first_province']))
							<option value="{{ $invest_pt[0]['treat_first_province'] }}" selected="selected">{{ $provinces[$invest_pt[0]['treat_first_province']]['province_name'] }}</option>
						@endif
						<option value="">-- เลือกจังหวัด --</option>
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
						@if (!empty($invest_pt[0]['treat_first_district']))
							<option value="{{ $treat_first_district[0]['district_id'] }}" selected="selected">{{ $treat_first_district[0]['district_name'] }}</option>
						@endif
						<option value="">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="subDistrict" class="text-cyan">ตำบลที่เข้ารักษาครั้งแรก</label>
					<select name="treatFirstSubDistrictInput" class="form-control selectpicker show-tick text-info" data-live-search="true" data-style="btn btn-outline-cyan" id="treat_first_sub_district">
						@if (!empty($invest_pt[0]['treat_first_sub_district']))
							<option value="{{ $treat_first_sub_district[0]['sub_district_id'] }}" selected="selected">{{ $treat_first_sub_district[0]['sub_district_name'] }}</option>
						@endif
						<option value="">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="firstHosp" class="text-cyan">สถานพยาบาลที่รักษาครั้งแรก</label>
					<select name="treat_first_hospital" class="form-control selectpicker how-tick text-info" ata-live-search="true" data-style="btn btn-outline-cyan" id="treatFirstHospital">
						@if (!empty($invest_pt[0]['treat_first_hospital']))
							<option value="{{ $invest_pt[0]['treat_first_hospital'] }}" selected="selected">{{ $treat_first_hospital[0]['hosp_name'] }}</option>
						@endif
						<option value="">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="country" class="text-success">จังหวัดที่รักษาปัจจุบัน</label>
					<select name="treatPlaceProvinceInput" class="form-control selectpicker show-tick text-info" data-live-search="true" data-style="btn btn-outline-success" id="treat_place_province">
						@if (!empty($invest_pt[0]['treat_place_province']))
							<option value="{{ $invest_pt[0]['treat_place_province'] }}" selected="selected">{{ $provinces[$invest_pt[0]['treat_place_province']]['province_name'] }}</option>
						@endif
						<option value="">-- เลือกจังหวัด --</option>
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
						@if (!empty($invest_pt[0]['treat_place_district']))
							<option value="{{ $treat_place_district[0]['district_id'] }}" selected="selected">{{ $treat_place_district[0]['district_name'] }}</option>
						@endif
						<option value="">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="subDistrict" class="text-success">ตำบลที่รักษาปัจจุบัน</label>
					<select name="treatPlaceSubDistrictInput" class="form-control selectpicker show-tick text-info" data-live-search="true" data-style="btn btn-outline-success" id="treat_place_sub_district">
						@if (!empty($invest_pt[0]['treat_place_sub_district']))
							<option value="{{ $treat_place_sub_district[0]['sub_district_id'] }}" selected="selected">{{ $treat_place_sub_district[0]['sub_district_name'] }}</option>
						@endif
						<option value="">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="currentTreat" class="text-success">สถานที่รักษาปัจจุบัน</label>
					<select name="treat_place_hospital" class="form-control selectpicker how-tick text-info" ata-live-search="true" data-style="btn btn-outline-success" id="treatPlaceHospital">
						@if (!empty($invest_pt[0]['treat_place_hospital']))
							<option value="{{ $invest_pt[0]['treat_place_hospital'] }}" selected="selected">{{ $treat_place_hospital[0]['hosp_name'] }}</option>
						@endif
						<option value="">-- โปรดเลือก --</option>
					</select>
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
							<input type="checkbox" name="fever_history" value="n" class="custom-control-input fever_history" id="fever_history_no" @if ($invest_pt[0]['fever_history'] == 'n') checked @endif>
							<label for="fever_history_no" class="custom-control-label normal-label">ไม่มี</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="fever_history" value="y" class="custom-control-input fever_history" id="fever_history_yes" @if ($invest_pt[0]['fever_history'] == 'y') checked @endif>
							<label for="fever_history_yes" class="custom-control-label normal-label">มี</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
					<label for="body_temperature">อุณหภูมิร่างกายแรกรับ</label>
					<div class="input-group">
						<input type="text" name="body_temperature_first" value="{{ $invest_pt[0]['body_temperature_first'] }}" class="form-control">
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
						<input type="text" name="oxygen_saturate" value="{{ $invest_pt[0]['oxygen_saturate'] }}" class="form-control">
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
							<input type="checkbox" name="sym_cough" value="y" class="custom-control-input pt-type" id="coughChk" @if ($invest_pt[0]['sym_cough'] == 'y') checked @endif>
							<label for="coughChk" class="custom-control-label normal-label">ไอ</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="sym_sore" value="y" class="custom-control-input pt-type" id="soreChk" @if ($invest_pt[0]['sym_sore'] == 'y') checked @endif>
							<label for="soreChk" class="custom-control-label normal-label">เจ็บคอ</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="sym_muscle" value="y" class="custom-control-input pt-type" id="muscleChk" @if ($invest_pt[0]['sym_muscle'] == 'y') checked @endif>
							<label for="muscleChk" class="custom-control-label normal-label">ปวดกล้ามเนื้อ</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="sym_snot" value="y" class="custom-control-input pt-type" id="snotChk" @if ($invest_pt[0]['sym_snot'] == 'y') checked @endif>
							<label for="snotChk" class="custom-control-label normal-label">มีน้ำมูก</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="sym_sputum" value="y" class="custom-control-input pt-type" id="sputumChk" @if ($invest_pt[0]['sym_sputum'] == 'y') checked @endif>
							<label for="sputumChk" class="custom-control-label normal-label">มีเสมหะ</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="sym_breathe" value="y" class="custom-control-input pt-type" id="breatheChk" @if ($invest_pt[0]['sym_breathe'] == 'y') checked @endif>
							<label for="breatheChk" class="custom-control-label normal-label">หายใจลำบาก (dyspnea)</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="sym_headache" value="y" class="custom-control-input pt-type" id="headacheChk" @if ($invest_pt[0]['sym_headache'] == 'y') checked @endif>
							<label for="headacheChk" class="custom-control-label normal-label">ปวดศีรษะ</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="sym_diarrhoea" value="y" class="custom-control-input pt-type" id="diarrhoeaChk" @if ($invest_pt[0]['sym_diarrhoea'] == 'y') checked @endif>
							<label for="diarrhoeaChk" class="custom-control-label normal-label">ถ่ายเหลว</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="sym_other" value="y" class="custom-control-input pt-type" id="symOtherChk" @if ($invest_pt[0]['sym_other'] == 'y') checked @endif>
							<label for="symOtherChk" class="custom-control-label normal-label">อื่นๆ</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="lane">อาการอื่นๆ โปรดระบุ</label>
					<div class="input-group">
						<input type="text" name="sym_other_text" value="{{ $invest_pt[0]['sym_othertext'] }}" class="form-control" placeholder="โปรดระบุ">
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
							<input type="checkbox" name="breathingTubeChk" value="n" @if ($invest_pt[0]['breathing_tube_chk'] == 'n') checked @endif class="custom-control-input chk_breathing_Tube" id="breathingTubeChkNo">
							<label for="breathingTubeChkNo" class="custom-control-label normal-label">ไม่ใส่</label>
						</div>
						<div class="custom-control custom-checkbox custom-control">
							<input type="checkbox" name="breathingTubeChk" value="y" @if ($invest_pt[0]['breathing_tube_chk'] == 'y') checked @endif class="custom-control-input chk_breathing_Tube" id="breathingTubeChkYes">
							<label for="breathingTubeChkYes" class="custom-control-label normal-label">ใส่</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="date">ระบุวันที่ใส่ท่อช่วยหายใจ</label>
					<div class="input-group date" data-provide="datepicker" id="breathing_tube_date">
						<input  type="text" name="breathing_tube_date" value="{{ $data['breathing_tube_date'] }}" class="form-control" readonly>
						<div class="input-group-append">
							<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
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
					<label for="">เอ็กซเรย์ปอด (ครั้งแรก)</label>
					<div class="card">
						<div class="custom-control custom-checkbox custom-control">
							<input type="checkbox" name="lab_cxr1_chk" value="n" @if ($invest_pt[0]['lab_cxr1_chk'] == 'n') checked @endif class="custom-control-input chk_cxr" id="labCxrChkNo">
							<label for="labCxrChkNo" class="custom-control-label normal-label">ไม่ทำ</label>
						</div>
						<div class="custom-control custom-checkbox custom-control">
							<input type="checkbox" name="lab_cxr1_chk" value="y" @if ($invest_pt[0]['lab_cxr1_chk'] == 'y') checked @endif class="custom-control-input chk_cxr" id="labCxrChkYes">
							<label for="labCxrChkYes" class="custom-control-label normal-label">ทำ</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<label for="dateInput">เมื่อวันที่</label>
				<div class="input-group date" data-provide="datepicke" id="lab_cxr1_date">
					<div class="input-group">
						<input type="text" name="labCxr1Date" value="{{ $data['lab_cxr1_date'] }}" class="form-control"placeholder="ระบุวันที่" readonly>
						<div class="input-group-append">
							<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<label for="result">ผลเอ๊กเรย์</label>
				<div>
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="labCxr1Result" value="normal" @if ($invest_pt[0]['lab_cxr1_result'] == 'normal') checked @endif class="custom-control-input lab_cxr1_result" id="labCxr1ResultNormal">
						<label for="labCxr1ResultNormal" class="custom-control-label normal-label">ปกติ</label>
					</div>
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="labCxr1Result" value="unusual" @if ($invest_pt[0]['lab_cxr1_result'] == 'unusual') checked @endif class="custom-control-input lab_cxr1_result" id="labCxr1ResultUnusual">
						<label for="labCxr1ResultUnusual" class="custom-control-label normal-label">ผิดปกติ</label>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
					<label for="detail">โปรดระบุ</label>
					<div class="input-group">
						<input type="text" name="labCxr1Detail" value="{{ $invest_pt[0]['lab_cxr1_detail'] }}" class="form-control">
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="fileInput" class="text-danger">อับโหลดภาพถ่าย X-ray</label>
					<div class="input-group">
						<div class="custom-file">
							<input type="file" name="labCxr1File" class="custom-file-input" id="lab_cxr1_file">
							<label class="custom-file-label border-warning" for="customFile">Choose file</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<label for="dateInput">CBC (ครั้งแรก): วันที่</label>
				<div class="input-group date" data-provide="datepicke" id="lab_cbc_date">
					<div class="input-group">
						<input type="text" name="labCbcDate" value="{{ $data['lab_cbc_date'] }}" class="form-control" readonly>
						<div class="input-group-append">
							<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="hbInput">Hb</label>
					<div class="input-group">
						<input type="text" name="labCbcHb" value="{{ $invest_pt[0]['lab_cbc_hb'] }}" class="form-control">
						<div class="input-group-append">
							<span class="input-group-text">mg%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<label for="htcInput">Hct</label>
				<div class="input-group">
					<input type="text" name="labCbcHct" value="{{ $invest_pt[0]['lab_cbc_hct'] }}" class="form-control">
					<div class="input-group-append">
						<span class="input-group-text">%</span>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<label for="plaInput">Platelet count</label>
				<div class="input-group">
					<input type="text" name="labCbcPlateletCount" value="{{ $invest_pt[0]['lab_cbc_platelet_count'] }}" class="form-control">
					<div class="input-group-append">
						<span class="input-group-text">x10<sup>3</sup></span>
					</div>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<label for="wbcInput">WBC</label>
				<input type="text" name="labCbcWbc" value="{{ $invest_pt[0]['lab_cbc_wbc'] }}" class="form-control">
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="neuInput">N</label>
					<div class="input-group">
						<input type="text" name="labCbcNeutrophil" value="{{ $invest_pt[0]['lab_cbc_neutrophil'] }}" class="form-control">
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
						<input type="text" name="labCbcLymphocyte" value="{{ $invest_pt[0]['lab_cbc_lymphocyte'] }}" class="form-control">
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
						<input type="text" name="lab_cbc_atyp_lymph" value="{{ $invest_pt[0]['lab_cbc_atyp_lymph'] }}" class="form-control">
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
						<input type="text" name="lab_cbc_mono" value="{{ $invest_pt[0]['lab_cbc_mono'] }}" class="form-control">
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
						<input type="text" name="lab_cbc_other" value="{{ $invest_pt[0]['lab_cbc_other'] }}" class="form-control" placeholder="โปรดระบุ">
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="lane">ผลการตรวจ Influenza test (วิธีการตรวจ)</label>
					<div class="input-group">
						<input type="text" name="lab_rapid_test_method" value="{{ $invest_pt[0]['lab_rapid_test_method'] }}" class="form-control" placeholder="โปรดระบุ">
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="rapidtest">วันที่</label>
					<div class="input-group date" data-provide="datepicke" id="lab_rapid_test_date">
						<div class="input-group">
							<input type="text" name="labRapidTestDate" value="{{ $data['lab_rapid_test_date'] }}" class="form-control" readonly>
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
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
						<input type="checkbox" name="labRapidTestResult" value="nagative" @if ($invest_pt[0]['lab_rapid_test_result'] == 'nagative') checked @endif  class="custom-control-input lab_rapid_test_result" id="labRapidTestResultNagative">
						<label for="labRapidTestResultNagative" class="custom-control-label normal-label">Negative</label>
					</div>
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="labRapidTestResult" value="positive" @if ($invest_pt[0]['lab_rapid_test_result'] == 'positive') checked @endif class="custom-control-input lab_rapid_test_result" id="labRapidTestResultPositive">
						<label for="labRapidTestResultPositive" class="custom-control-label normal-label">Positive</label>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<label for="result">ชนิดเชื้อ</label>
				<div>
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="lab_rapid_test_pathogen_flu_a" value="y" @if ($invest_pt[0]['lab_rapid_test_pathogen_flu_a'] == 'y') checked @endif  class="custom-control-input lab_rapid_test_pathogen" id="labRapidTestResultFlua">
						<label for="labRapidTestResultFlua" class="custom-control-label normal-label">Influenza A</label>
					</div>
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="lab_rapid_test_pathogen_flu_b" value="y" @if ($invest_pt[0]['lab_rapid_test_pathogen_flu_b'] == 'y') checked @endif class="custom-control-input lab_rapid_test_pathogen" id="labRapidTestResultFlub">
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
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<!--<caption>PCR for COVID-19</caption>-->
						<thead class="bg-danger text-light">
							<tr>
								<th>ครั้งที่</th>
								<th>วันที่เก็บ</th>
								<th>ชนิดตัวอย่าง</th>
								<th>สถานที่ตรวจ</th>
								<th>ผลตรวจ</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $invest_pt[0]['lab_sars_cov2_no_1'] }}</td>
								<td>
									<div class="form-group">
										<div class="input-group date" data-provide="datepicke" id="sars_cov2_date1">
											<div class="input-group">
												<input type="text" name="lab_sars_cov2_no_1_date" value="{{ $data['lab_sars_cov2_no_1_date'] }}" class="form-control" readonly>
												<div class="input-group-append">
													<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
												</div>
											</div>
										</div>
									</div>
								</td>
								<td>
									<select name="lab_sars_cov2_no_1_specimen" class="form-control">
										@if (!empty($invest_pt[0]['lab_sars_cov2_no_1_specimen']))
											<option value="{{ $invest_pt[0]['lab_sars_cov2_no_1_specimen'] }}" selected="selected">{{ $ref_specimen[$invest_pt[0]['lab_sars_cov2_no_1_specimen']]['name_en'] }}</option>
										@endif
										<option value="">- โปรดเลือก -</option>
										@foreach ($ref_specimen as $key => $value)
											<option value="{{ $value['id'] }}">{{ $value['name_en'] }}</option>
										@endforeach
									</select>
								</td>
								<td>
									<div class="form-group">
										<select name="lab_sars_cov2_no_1_lab" class="form-control">
											@if (!empty($invest_pt[0]['lab_sars_cov2_no_1_lab']))
												<option value="{{ $invest_pt[0]['lab_sars_cov2_no_1_lab'] }}" selected="selected">{{ $lab_station[$invest_pt[0]['lab_sars_cov2_no_1_lab']]['th_name'] }}</option>
											@endif
											<option value="">- โปรดเลือก -</option>
											@foreach ($lab_station as $key => $value)
												<option value="{{ $value['id'] }}">{{ $value['th_name'] }}</option>
											@endforeach
										</select>
									</div>
								</td>
								<td>
									<select name="lab_sars_cov2_no_1_result" class="form-control">
										@if (!empty($invest_pt[0]['lab_sars_cov2_no_1_result']))
											<option value="{{ $invest_pt[0]['lab_sars_cov2_no_1_result'] }}" selected="selected">{{ $invest_pt[0]['lab_sars_cov2_no_1_result'] }}</option>
										@endif
										<option value="">- โปรดเลือก -</option>
										<option value="process">รอผล</option>
										<option value="Detected">Detected</option>
										<option value="Not Detected">Not detected</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>{{ $invest_pt[0]['lab_sars_cov2_no_2'] }}</td>
								<td>
									<div class="form-group">
										<div class="input-group date" data-provide="datepicke" id="sars_cov2_date2">
											<div class="input-group">
												<input type="text" name="lab_sars_cov2_no_2_date" value="{{ $data['lab_sars_cov2_no_2_date'] }}" class="form-control" readonly>
												<div class="input-group-append">
													<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
												</div>
											</div>
										</div>
									</div>
								</td>
								<td>
									<select name="lab_sars_cov2_no_2_specimen" class="form-control">
										@if (!empty($invest_pt[0]['lab_sars_cov2_no_2_specimen']))
											<option value="{{ $invest_pt[0]['lab_sars_cov2_no_2_specimen'] }}" selected="selected">{{ $ref_specimen[$invest_pt[0]['lab_sars_cov2_no_2_specimen']]['name_en'] }}</option>
										@endif
										<option value="">- โปรดเลือก -</option>
										@foreach ($ref_specimen as $key => $value)
											<option value="{{ $value['id'] }}">{{ $value['name_en'] }}</option>
										@endforeach
									</select>
								</td>
								<td>
									<div class="form-group">
										<select name="lab_sars_cov2_no_2_lab" class="form-control">
											@if (!empty($invest_pt[0]['lab_sars_cov2_no_2_lab']))
												<option value="{{ $invest_pt[0]['lab_sars_cov2_no_2_lab'] }}" selected="selected">{{ $lab_station[$invest_pt[0]['lab_sars_cov2_no_2_lab']]['th_name'] }}</option>
											@endif
											<option value="">- โปรดเลือก -</option>
											@foreach ($lab_station as $key => $value)
												<option value="{{ $value['id'] }}">{{ $value['th_name'] }}</option>
											@endforeach
										</select>
									</div>
								</td>
								<td>
									<select name="lab_sars_cov2_no_2_result" class="form-control">
										@if (!empty($invest_pt[0]['lab_sars_cov2_no_2_result']))
											<option value="{{ $invest_pt[0]['lab_sars_cov2_no_2_result'] }}" selected="selected">{{ $invest_pt[0]['lab_sars_cov2_no_2_result'] }}</option>
										@endif
										<option value="">- โปรดเลือก -</option>
										<option value="process">รอผล</option>
										<option value="Detected">Detected</option>
										<option value="Not Detected">Not detected</option>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="villageNo">2.4 ประเภทผู้ป่วย</label>
					<div class="card">
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="treat_patient_type" value="opd" class="custom-control-input treat_patient_type" id="treat_patient_type_opd" @if ($invest_pt[0]['treat_patient_type'] == 'opd') checked @endif>
							<label for="treat_patient_type_opd" class="custom-control-label normal-label">ผู้ป่วยนอก (OPD)</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="treat_patient_type" value="ipd" class="custom-control-input treat_patient_type" id="treat_patient_type_ipd" @if ($invest_pt[0]['treat_patient_type'] == 'ipd') checked @endif>
							<label for="treat_patient_type_ipd" class="custom-control-label normal-label">ผู้ป่วยใน (IPD)</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="date">Admited วันที่</label>
					<div class="input-group date" data-provide="datepicker" id="treat_place_date">
						<input type="text" name="treat_place_date" value="{{ $data['treat_place_date'] }}" class="form-control">
						<div class="input-group-append">
							<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8 col-xl-8">
				<div class="form-group">
					<label for="first_diag">การวินิจฉัยเบื้องต้น</label>
					<div class="input-group">
						<input type="text" name="firstDiagInput" value="{{ $invest_pt[0]['first_diag'] }}" class="form-control" placeholder="แพทย์วินิจฉัยเบื้องต้น">
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
						<input type="checkbox" name="covid19Drugchk" value="n" @if ($invest_pt[0]['covid19_drug_medicate'] == 'n') checked @endif class="custom-control-input chk_covid19_drug" id="covid19DrugchkNo">
						<label for="covid19DrugchkNo" class="custom-control-label normal-label">ไม่ให้</label>
					</div>
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="covid19Drugchk" value="y" @if ($invest_pt[0]['covid19_drug_medicate'] == 'y') checked @endif class="custom-control-input chk_covid19_drug" id="covid19DrugchkYes">
						<label for="covid19DrugchkYes" class="custom-control-label normal-label">ให้ (กรุณาระบุวันที่)</label>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="covidDrugDate">วันที่ให้ยาโดสแรก</label>
					<div class="input-group date" data-provide="datepicke" id="covid19_drug_medicate_first_date">
						<div class="input-group">
							<input type="text" name="covid19_drug_medicate_first_date" value="{{ $data['covid19_drug_medicate_first_date'] }}" class="form-control" placeholder="ระบุวันที่" readonly>
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
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
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="covid19_drug_medicate_name" value="Darunavir/Ritonavir (DRV/r)" @if ($invest_pt[0]['covid19_drug_medicate_name'] == 'Darunavir/Ritonavir (DRV/r)') checked @endif class="custom-control-input chk_covid_drug_name" id="drvChk"  >
							<label for="drvChk" class="custom-control-label normal-label">Darunavir/Ritonavir (DRV/r)</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="covid19_drug_medicate_name" value="Lopinavir/Ritonavir (LPV/r)" @if ($invest_pt[0]['covid19_drug_medicate_name'] == 'Lopinavir/Ritonavir (LPV/r)') checked @endif class="custom-control-input chk_covid_drug_name" id="lpvChk" >
							<label for="lpvChk" class="custom-control-label normal-label">Lopinavir/Ritonavir (LPV/r)</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="covid19_drug_medicate_name" value="Favipiravir" @if ($invest_pt[0]['covid19_drug_medicate_name'] == 'Favipiravir') checked @endif class="custom-control-input chk_covid_drug_name" id="favChk" >
							<label for="favChk" class="custom-control-label normal-label">Favipiravir</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="covid19_drug_medicate_name" value="Chloroquine" @if ($invest_pt[0]['covid19_drug_medicate_name'] == 'Chloroquine') checked @endif class="custom-control-input chk_covid_drug_name" id="chlChk" >
							<label for="chlChk" class="custom-control-label normal-label">Chloroquine</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="covid19_drug_medicate_name" value="Hydroxychloroquine" @if ($invest_pt[0]['covid19_drug_medicate_name'] == 'Hydroxychloroquine') checked @endif class="custom-control-input chk_covid_drug_name" id="hydChk" >
							<label for="hydChk" class="custom-control-label normal-label">Hydroxychloroquine</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="covid19_drug_medicate_name" value="Oseltamivir" @if ($invest_pt[0]['covid19_drug_medicate_name'] == 'Oseltamivir') checked @endif class="custom-control-input chk_covid_drug_name" id="oseChk" >
							<label for="oseChk" class="custom-control-label normal-label">Oseltamivir</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="covid19_drug_medicate_name" value="other" @if ($invest_pt[0]['covid19_drug_medicate_name'] == 'other') checked @endif class="custom-control-input chk_covid_drug_name" id="othChk" >
							<label for="othChk" class="custom-control-label normal-label">ยาอื่นๆ โปรดระบุ</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
				<div class="form-group">
					<label for="lane">ยาอื่นๆ ระบุ</label>
					<div class="input-group">
						<input type="text" name="covid19_drug_medicate_name_other" value="{{ $invest_pt[0]['covid19_drug_medicate_name_other'] }}" class="form-control" placeholder="โปรดระบุ">
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
				<label for="treatment">สถานะผู้ป่วย</label>
				<div>
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="patientTreatStatus" value="1" @if ($invest_pt[0]['patient_treat_status'] == '1') checked @endif class="custom-control-input chk-treatment" id="treatment_cured">
						<label for="treatment_cured" class="custom-control-label normal-label">หาย</label>
					</div>
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="patientTreatStatus" value="2" @if ($invest_pt[0]['patient_treat_status'] == '2') checked @endif class="custom-control-input chk-treatment" id="treatment_treat">
						<label for="treatment_treat" class="custom-control-label normal-label">อยู่ระหว่างการรักษา</label>
					</div>
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="patientTreatStatus" value="3" @if ($invest_pt[0]['patient_treat_status'] == '3') checked @endif class="custom-control-input chk-treatment" id="treatment_dead">
						<label for="treatment_dead" class="custom-control-label normal-label">เสียชีวิต</label>
					</div>
					<div class="custom-control custom-checkbox custom-control-inline" style="width:340px">
						<input type="checkbox" name="patientTreatStatus" value="4" @if ($invest_pt[0]['patient_treat_status'] == '4') checked @endif class="custom-control-input chk-treatment" id="treatment_refer">
						<label for="treatment_refer" class="custom-control-label normal-label">ส่งต่อไปรักษาที่</label>
						<input type="text" name="patient_treat_status_refer" value="{{ $invest_pt[0]['patient_treat_status_refer'] }}" class="form-control form-control-sm ml-2" style="width:200px">
					</div>
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="patientTreatStatus" value="5" @if ($invest_pt[0]['patient_treat_status'] == '5') checked @endif class="custom-control-input chk-treatment" id="treatment_other">
						<label for="treatment_other" class="custom-control-label normal-label">อื่นๆ โปรดระบุ</label>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
				<div class="form-group">
					<label for="status">สถานะอื่นๆ ระบุ</label>
					<div class="input-group">
						<input type="text" name="patient_treat_status_other" value="{{ $invest_pt[0]['patient_treat_status_other'] }}" class="form-control" placeholder="โปรดระบุ">
					</div>
				</div>
			</div>
		</div>
	</section>
</article><!-- card2 -->
