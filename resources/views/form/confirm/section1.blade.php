<div class="card">
	<div class="card-body">
		<h1 class="text-info">1. ข้อมูลทั่วไปของผู้ป่วย</h1>
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
				<div class="form-group">
					<label for="titleName">คำนำหน้าชื่อ</label>
					<input type="hidden" name="id" value="{{ $invest_pt[0]['id'] }}">
					<input type="text" name="titleName" value="{{ $invest_pt[0]['title_name'] }}" class="form-control" id="title_name" placeholder="คำนำหน้าชื่อ" required>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="firstName">ชื่อจริง</label>
					<input type="text" name="firstNameInput" value="{{ $invest_pt[0]['first_name'] }}" class="form-control" id="first_name_input" placeholder="ชื่อ" required>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="midName">ชื่อกลาง</label>
					<input type="text" name="midNameInput" value="{{ $invest_pt[0]['mid_name'] }}" class="form-control" id="mid_name_input" placeholder="ชื่อกลาง">
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="lastName">นามสกุล</label>
					<input type="text" name="lastNameInput" value="{{ $invest_pt[0]['last_name'] }}" class="form-control" id="last_name_input" placeholder="นามสกุล" required>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-1 col-xl-1">
				<div class="form-group">
					<label for="sex">เพศ</label>
					<select name="sexInput" class="form-control selectpicker show-tick" id="select_sex">
						@if (trim($invest_pt[0]['sex']) == 'ชาย')
							<option value="ชาย" selected="selected">ชาย</option>
						@elseif (trim($invest_pt[0]['sex']) == 'หญิง')
							<option value="ชาย" selected="selected">หญิง</option>
						@endif
						<option value="">-- โปรดเลือก --</option>
						<option value="ชาย">ชาย</option>
						<option value="หญิง">หญิง</option>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-1 col-xl-1">
				<div class="form-group">
					<label for="ageYear">อายุ/ปี</label>
					<input type="text" name="ageYearInput" value="{{ $invest_pt[0]['age'] }}" class="form-control" id="age_year_input" required>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-1 col-xl-1">
				<div class="form-group">
					<label for="ageMonth">อายุ/เดือน</label>
					<input type="text" name="ageMonthInput" value="{{ $invest_pt[0]['age_month'] }}" class="form-control" id="age_month_input">
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
				<div class="form-group">
					<label for="nationality">สัญชาติ</label>
					<input type="text" name="nationalityInput" value="{{ $invest_pt[0]['nation'] }}" class="form-control" id="select_nationality" required>
					<!--
					<select name="nationalityInput" class="form-control selectpicker show-tick" id="select_nationality">
						<option value="0">-- โปรดเลือก --</option>
					</select>
					-->
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
				<div class="form-group">
					<label for="nationality">เชื้อชาติ</label>
					<input type="text" name="raceInput" value="{{ $invest_pt[0]['race'] }}" class="form-control" id="select_race" required>
					<!--
					<select name="raceInput" class="form-control selectpicker show-tick" id="select_race">
						<option value="0">-- โปรดเลือก --</option>
					</select>
					-->
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
				<label for="occupation">อาชีพ</label>
				<select name="occupationInput" class="form-control selectpicker show-tick" id="select_occupation">
					@if (!empty($invest_pt[0]['occupation']))
						<option value="{{ $invest_pt[0]['occupation'] }}" selected="selected">{{ $occupation[$invest_pt[0]['occupation']]['occu_name_th'] }}</option>
					@endif
					<option value="0">-- โปรดเลือก --</option>
					@foreach ($occupation as $key => $value)
						<option value="{{ $value['id'] }}">{{ $value['occu_name_th'] }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
				<label for="occupationOth">อาชีพอื่นๆ</label>
				<input type="text" name="occupationOthInput" value="{{ $invest_pt[0]['occupation_oth'] }}" class="form-control" id="select_occupation_oth">
			</div>
		</div>
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="alert alert-danger" role="alert">
					<h5 class="alert-heading">คำแนะนำ !</h5>
					<hr>
					<p class="mb-0">
						ระบุลักษณะงานที่ทำ เช่น นักเรียน, นักบวช, ทหาร, นักโทษ เป็นต้น
						และหากเป็นเจ้าหน้าที่ทางการแพทย์หรือสาธารณสุข ต้องระบุให้ชัดเจนว่าลักษณะการทำงานที่ต้องสัมผัสผู้ป่วยอย่างไร
					</p>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<label for="dowork">ลักษณะงานที่ทำ/สัมผัส</label>
				<input type="text" name="workContactInput" value="{{ $invest_pt[0]['work_contact'] }}" class="form-control" placeholder="ลักษณะงานที่ทำ/สัมผัส">
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<label for="workPlace">สถานที่ทำงาน</label>
				<input type="text" name="workOfficeInput" value="{{ $invest_pt[0]['work_office'] }}" class="form-control" placeholder="สถานที่ทำงาน">
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<label for="workPhone">โทรศัพท์ที่ทำงาน</label>
				<input type="text" name="workPhoneInput" value="{{ $invest_pt[0]['work_phone'] }}" class="form-control" placeholder="โทรศัพท์ที่ทำงาน">
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="province">จังหวัด</label>
					<select name="provinceInput" class="form-control selectpicker show-tick" id="select_province">
						@if (!empty($invest_pt[0]['work_province']))
							<option value="{{ $invest_pt[0]['work_province'] }}" selected="selected">{{ $provinces[$invest_pt[0]['work_province']]['province_name'] }}</option>
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
					<label for="district">อำเภอ</label>
					<select name="districtInput" class="form-control selectpicker show-tick" id="select_district">
						@if (!empty($invest_pt[0]['work_district']))
							<option value="{{ $pt_work_district[0]['district_id'] }}" selected="selected">{{ $pt_work_district[0]['district_name'] }}</option>
						@endif
						<option value="">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="subDistrict">ตำบล</label>
					<select name="subDistrictInput" class="form-control selectpicker show-tick" id="select_sub_district">
						@if (!empty($invest_pt[0]['work_sub_district']))
							<option value="{{ $pt_work_sub_district[0]['sub_district_id'] }}" selected="selected">{{ $pt_work_sub_district[0]['sub_district_name'] }}</option>
						@endif
						<option value="">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
				<div class="form-group">
					<label for="houseNo">ที่อยู่ขณะป่วย เลขที่</label>
					<input type="text" name="houseNoInput" value="{{ $invest_pt[0]['sick_house_no'] }}" class="form-control" placeholder="บ้านเลขที่">
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
				<div class="form-group">
					<label for="villageNo">หมู่ที่</label>
					<input type="text" name="villageNoInput" value="{{ $invest_pt[0]['sick_village_no'] }}" class="form-control" placeholder="หมู่ที่">
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<label for="village">หมู่บ้าน/ชุมชน</label>
				<input type="text" name="villageInput" value="{{ $invest_pt[0]['sick_village'] }}" class="form-control" placeholder="หมู่บ้าน">
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="lane">ซอย</label>
					<input type="text" name="laneInput" value="{{ $invest_pt[0]['sick_lane'] }}" class="form-control" placeholder="ซอย">
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="road">ถนน</label>
					<input type="text" name="roadInput" value="{{ $invest_pt[0]['sick_road'] }}" class="form-control" placeholder="ถนน">
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="province">จังหวัด</label>
					<select name="patientProvinceInput" class="form-control selectpicker show-tick" id="select_patient_province">
						@if (!empty($invest_pt[0]['sick_province']))
							<option value="{{ $invest_pt[0]['sick_province'] }}" selected="selected">{{ $provinces[$invest_pt[0]['sick_province']]['province_name'] }}</option>
						@endif
						<option value="">-- เลือกจังหวัด --</option>
						@php
							foreach($provinces as $key=>$val) {
								$htm = "<option value=\"".$val['province_id']."\"";
									if (old('patientProvinceInput') == $val['province_id']) {
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
					<label for="district">อำเภอ</label>
					<select name="patientDistrictInput" class="form-control selectpicker show-tick" id="select_patient_district">
						@if (!empty($invest_pt[0]['sick_district']))
							<option value="{{ $pt_sick_district[0]['district_id'] }}" selected="selected">{{ $pt_sick_district[0]['district_name'] }}</option>
						@endif
						<option value="">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="subDistrict">ตำบล</label>
					<select name="patientSubDistrictInput" class="form-control selectpicker show-tick" id="select_patient_sub_district">
						@if (!empty($invest_pt[0]['sick_sub_district']))
							<option value="{{ $pt_sick_sub_district[0]['sub_district_id'] }}" selected="selected">{{ $pt_sick_sub_district[0]['sub_district_name'] }}</option>
						@endif
						<option value="">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<label for="telephone">โทรศัพท์บ้าน</label>
				<input type="text" name="telePhoneInput" value="{{ $invest_pt[0]['phone'] }}" class="form-control" placeholder="โทรศัพท์บ้าน">
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<label for="mobile">โทรศัพท์มือถือ</label>
				<input type="text" name="mobilePhoneInput" value="{{ $invest_pt[0]['mobile'] }}" class="form-control" placeholder="โทรศัพท์มือถือ">
			</div>
		</div>
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
				<div class="form-group">
					<label for="informant">ผู้ให้ข้อมูล</label>
					<div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="informantPatientInput" value="y" @if ($invest_pt[0]['informant_patient'] == 'y') checked @endif class="custom-control-input" id="informantPatientInput">
							<label for="informantPatientInput" class="custom-control-label normal-label">ผู้ป่วย</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="informantRelativeInput" value="y" @if ($invest_pt[0]['informant_relative'] == 'y') checked @endif class="custom-control-input" id="informantRelativeInput">
							<label for="informantRelativeInput" class="custom-control-label normal-label">ญาติ</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="form-group">
					<label for="relativeship">ระบุความสัมพันธ์</label>
					<input type="text" name="relativeshipInput" value="{{ $invest_pt[0]['informant_relation'] }}" class="form-control" placeholder="ความสัมพันธ์">
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-1 col-xl-1">
				<div class="form-group">
					<label for="informant">&nbsp;</label>
					<div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="informantOthChk" value="y" @if ($invest_pt[0]['informant_other'] == 'y') checked @endif class="custom-control-input" id="informantOthChk">
							<label for="informantOthChk" class="custom-control-label normal-label">อื่นๆ ระบุ</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
					<label for="otherInformant">&nbsp;</label>
					<input type="text" name="otherInformantInput" value="{{ $invest_pt[0]['informant_other_text'] }}" class="form-control" placeholder="ระบุ">
				</div>
			</div>
		</div>
	</div><!-- card body#1 -->
</div><!-- card1 -->
