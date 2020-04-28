<article class="card">
	<hgroup class="card-body">
		<h1 class="text-color-custom-5">3. ประวัติเสี่ยง</h1>
	</hgroup>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-12">
				<div class="form-group">
					<label for="risk_detail">รายละเอียดเหตุการณ์ ประวัติเสี่ยงติดเชื้อ ก่อนเริ่มป่วย</label>
					<textarea name="risk_detail" class="form-control" >{{ old('risk_detail') ?? $invest_pt[0]['risk_detail'] }}</textarea>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="risk_type">ประเภทประวัติเสี่ยง</label>
					<select name="risk_type" id="risk_type" data-live-search="true" class="form-control selectpicker show-tick">
						@if (!empty(old('risk_type')) || !empty($invest_pt[0]['risk_type']))
							<option value="{{ old('risk_type') ?? $invest_pt[0]['risk_type'] }}" selected="selected">{{ $risk_type[old('risk_type')]['risk_name'] ?? $risk_type[$invest_pt[0]['risk_type']]['risk_name'] }}</option>
						@endif
						<option value="">-- โปรดเลือก --</option>
						@foreach($risk_type as $key => $val)
							<option value="{{ $val['id'] }}">{{ $val['risk_name'] }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 risk_type_text">
				<div class="form-group">
					<label for="risk_type_text">ประเภทประวัติเสี่ยงอื่นๆ</label>
					<input type="text" name="risk_type_text" value="{{ old('risk_type_text') ?? $invest_pt[0]['risk_type_text'] }}" class="form-control" id="risk_type_text" placeholder="ประวัติเสี่ยงอื่นๆ">
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="risk">ช่วง 14 วันก่อนป่วย ท่านอาศัยอยู่ หรือ มีการเดินทางมาจากพื้นที่ที่มีการระบาด</label>
					<div class="card">
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="riskStayOutbreakChk" value="n" @if ($invest_pt[0]['risk_stay_outbreak_chk'] == 'n' || old('riskStayOutbreakChk') == 'n') checked @endif class="custom-control-input chk_risk_stay_outbreak" id="riskStayOutbreakChkNo">
							<label for="riskStayOutbreakChkNo" class="custom-control-label normal-label">ไม่ใช่</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="riskStayOutbreakChk" value="y" @if ($invest_pt[0]['risk_stay_outbreak_chk'] == 'y' || old('riskStayOutbreakChk') == 'y') checked @endif class="custom-control-input chk_risk_stay_outbreak" id="riskStayOutbreakChkYes">
							<label for="riskStayOutbreakChkYes" class="custom-control-label normal-label">ใช่ (โปรดระบุ)</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="country" class="text-info">ประเทศ</label>
					<select name="riskStayOutbreakCountryInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-info" id="risk_stay_outbreak_country">
						@if (!empty(old('riskStayOutbreakCountryInput')) || !empty($invest_pt[0]['risk_stay_outbreak_country']))
							<option value="{{ old('riskStayOutbreakCountryInput') ?? $invest_pt[0]['risk_stay_outbreak_country'] }}" selected="selected">{{ $globalCountry[$invest_pt[0]['risk_stay_outbreak_country']]['country_name'] }}</option>
						@endif
						<option value="">-- เลือกประเทศ --</option>
						@foreach ($globalCountry as $key => $value)
							<option value="{{ $value['country_id'] }}">{{ $value['country_name'] }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="country" class="text-info">เมือง (กรณี ตปท.)</label>
					<select name="riskStayOutbreakCityInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-info" id="select_risk_stay_outbreak_city">
						@if (!empty($invest_pt[0]['risk_stay_outbreak_city']))
							<option value="{{ $invest_pt[0]['risk_stay_outbreak_city'] }}" selected="selected">{{ $risk_stay_outbreak_city[0]['city_name'] }}</option>
						@endif
						<option value="">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="city_other" class="text-info">เมืองอื่นๆ (กรณี ตปท.)</label>
					<input type="text" name="riskStayOutbreakCityOtherInput" value="{{ old('riskStayOutbreakCityOtherInput') ?? $invest_pt[0]['risk_stay_outbreak_city_other'] }}" class="form-control border-info text-info" placeholder="เมืองอื่นๆ">
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="date">วันที่เดินทางไปถึง</label>
					<div class="input-group date">
						<div class="input-group-append">
							<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
						</div>
						<input  type="text" name="riskStayOutbreakArriveDate" value="{{ old('riskStayOutbreakArriveDate') ?? $data['risk_stay_outbreak_arrive_date'] }}" data-provide="datepicker" id="riskStayOutbreakArriveDate" class="form-control" readonly>
						<div class="input-group-append">
							<button type="button" class="input-group-text text-danger" id="cls_riskStayOutbreakArriveDate"><i class="fas fa-times"></i></button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="date">วันที่เดินทางมาถึงไทย</label>
					<div class="input-group date">
						<div class="input-group-append">
							<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
						</div>
						<input  type="text" name="riskStayOutbreakArriveThaiDate" value="{{ old('riskStayOutbreakArriveThaiDate') ?? $data['risk_stay_outbreak_arrive_thai_date'] }}" data-provide="datepicker" id="riskStayOutbreakArriveThaiDate" class="form-control" readonly>
						<div class="input-group-append">
							<button type="button" class="input-group-text text-danger" id="cls_risk_stay_outbreak_arrive_thai_date"><i class="fas fa-times"></i></button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="contact">สายการบิน</label>
					<input type="text" name="riskStayOutbreakAirline" value="{{ old('riskStayOutbreakAirline') ?? $invest_pt[0]['risk_stay_outbreak_airline'] }}" class="form-control" placeholder="สายการบิน">
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="contact">เที่ยวบินที่</label>
					<input type="text" name="riskStayOutbreakFlightNoInput" value="{{ old('riskStayOutbreakFlightNoInput') ?? $invest_pt[0]['risk_stay_outbreak_flight_no'] }}" class="form-control" placeholder="เที่ยวบินที่">
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="contact">เลขที่นั่ง</label>
					<input type="text" name="riskStayOutbreakSeatNoInput" value="{{ old('riskStayOutbreakSeatNoInput') ?? $invest_pt[0]['risk_stay_outbreak_seat_no'] }}" class="form-control" placeholder="เลขที่นั่ง">
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="province" class="text-info">จังหวัด (กรณี ประเทศไทย)</label>
					<select name="riskStayOutbreakProvinceInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-info" id="risk_stay_outbreak_province">
						@if (!empty(old('riskStayOutbreakProvinceInput')) || !empty($invest_pt[0]['risk_stay_outbreak_province']))
							<option value="{{ old('riskStayOutbreakProvinceInput') ?? $invest_pt[0]['risk_stay_outbreak_province'] }}" selected="selected">{{ $provinces[old('riskStayOutbreakProvinceInput')]['province_name'] ?? $provinces[$invest_pt[0]['risk_stay_outbreak_province']]['province_name'] }}</option>
						@endif
						<option value="">-- เลือกจังหวัด --</option>
						@foreach($provinces as $key=>$val)
							<option value="{{ $val['province_id'] }}" @if (old('riskStayOutbreakProvinceInput') == $val['province_id']) selected @endif>{{ $val['province_name'] }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="district" class="text-info">อำเภอ (กรณี ประเทศไทย)</label>
					<select name="riskStayOutbreakDistrictInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-info" id="risk_stay_outbreak_district">
						@if (!empty($invest_pt[0]['risk_stay_outbreak_district']))
							<option value="{{ $risk_district[0]['district_id'] }}" selected="selected">{{ $risk_district[0]['district_name'] }}</option>
						@endif
						<option value="">-- โปรดเลือก --</option>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="subDistrict" class="text-info">ตำบล (กรณี ประเทศไทย)</label>
					<select name="riskStayOutbreakSubDistrictInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-info" id="risk_stay_outbreak_sub_district">
						@if (!empty($invest_pt[0]['risk_stay_outbreak_sub_district']))
							<option value="{{ $risk_sub_district[0]['sub_district_id'] }}" selected="selected">{{ $risk_sub_district[0]['sub_district_name'] }}</option>
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
					<label for="risk">ช่วง 14 วันก่อนป่วย ท่านได้เข้ารับการรักษาหรือเยี่ยมผู้ป่วยในโรงพยาบาลของพื้นที่ที่มีการระบาด</label>
					<div class="card">
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="riskTreatOrVisitPatient" value="n" @if ($invest_pt[0]['risk_treat_or_visit_patient'] == 'n' || old('riskTreatOrVisitPatient') == 'n') checked @endif  class="custom-control-input risk_treat_or_visit_patient" id="risk_treat_or_visit_patient_no">
							<label for="risk_treat_or_visit_patient_no" class="custom-control-label normal-label">ไม่ใช่</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="riskTreatOrVisitPatient" value="y" @if ($invest_pt[0]['risk_treat_or_visit_patient'] == 'y' || old('riskTreatOrVisitPatient') == 'y') checked @endif class="custom-control-input risk_treat_or_visit_patient" id="risk_treat_or_visit_patient_yes">
							<label for="risk_treat_or_visit_patient_yes" class="custom-control-label normal-label">ใช่</label>
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
					<label for="risk">ช่วง 14 วันก่อนป่วย ท่านใด้ดูแลหรือสัมผัสใกล้ชิดกับผู้ป่วยอาการคล้ายไข้หวัดใหญ่หรือปอดอักเสบ</label>
					<div class="card">
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="riskCareFluPatient" value="n" @if ($invest_pt[0]['risk_care_flu_patient'] == 'n' || old('riskCareFluPatient') == 'n') checked @endif class="custom-control-input risk_care_flu_patient" id="risk_care_flu_patient_no">
							<label for="risk_care_flu_patient_no" class="custom-control-label normal-label">ไม่ใช่</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="riskCareFluPatient" value="y" @if ($invest_pt[0]['risk_care_flu_patient'] == 'y' || old('riskCareFluPatient') == 'y') checked @endif class="custom-control-input risk_care_flu_patient" id="risk_care_flu_patient_yes">
							<label for="risk_care_flu_patient_yes" class="custom-control-label normal-label">ใช่</label>
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
					<label for="risk">ช่วง 14 วันก่อนป่วย ท่านมีประวัติสัมผัสกับผู้ป่วยยืนยันโรคติดเชื้อไวรัสโคโรนา 2019</label>
					<div class="card">
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="risk_contact_covid_19" value="n" @if ($invest_pt[0]['risk_contact_covid_19'] == 'n' || old('risk_contact_covid_19') == 'n') checked @endif class="custom-control-input risk_contact_covid_19" id="risk_contact_covid_19_no">
							<label for="risk_contact_covid_19_no" class="custom-control-label normal-label">ไม่ใช่</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="risk_contact_covid_19" value="y" @if ($invest_pt[0]['risk_contact_covid_19'] == 'y' || old('risk_contact_covid_19') == 'y') checked @endif class="custom-control-input risk_contact_covid_19" id="risk_contact_covid_19_yes">
							<label for="risk_contact_covid_19_yes" class="custom-control-label normal-label">ใช่ (ระบุรายละเอียด)</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
					<label for="">ชื่อ-นามสกุล</label>
					<input type="text" name="risk_contact_covid_19_patient_name" value="{{ old('risk_contact_covid_19_patient_name') ?? $invest_pt[0]['risk_contact_covid_19_patient_name'] }}" class="form-control" placeholder="ชื่อ-นามสกุล ผู้ป่วยยืนยัน">
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
					<label for="contact">รหัส SAT ID</label>
					<input type="text" name="risk_contact_covid_19_sat_id" value="{{ old('risk_contact_covid_19_sat_id') ?? $invest_pt[0]['risk_contact_covid_19_sat_id'] }}" class="form-control" placeholder="SAT ID ผู้ป่วยยืนยัน">
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
					<label for="">ลักษณะการสัมผัส</label>
					<input type="text" name="risk_contact_covid_19_touch" value="{{ old('risk_contact_covid_19_touch') ?? $invest_pt[0]['risk_contact_covid_19_touch'] }}" class="form-control" placeholder="ลักษณะการสัมผัส">
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
					<label for="contact">ช่วงระยะเวลาที่มีการสัมผัส</label>
					<input type="text" name="risk_contact_covid_19_duration" value="{{ old('risk_contact_covid_19_duration') ?? $invest_pt[0]['risk_contact_covid_19_duration'] }}" class="form-control" placeholder="ช่วงระยะเวลาการสัมผัส (นาที)">
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="tourist">ช่วง 14 วันก่อนป่วย ท่านประกอบอาชีพที่สัมผัสใกล้ชิดกับนักท่องเที่ยวต่างชาติ</label>
					<div class="card">
						<div class="custom-control custom-checkbox custom-control">
							<input type="checkbox" name="risk_contact_tourist" value="n" @if ($invest_pt[0]['risk_contact_tourist'] == 'n' || old('risk_contact_tourist') == 'n') checked @endif class="custom-control-input chk-risk-contact-tourist" id="risk_contack_tourist_no">
							<label for="risk_contack_tourist_no" class="custom-control-label normal-label">ไม่ใช่</label>
						</div>
						<div class="custom-control custom-checkbox custom-control">
							<input type="checkbox" name="risk_contact_tourist" value="y" @if ($invest_pt[0]['risk_contact_tourist'] == 'y' || old('risk_contact_tourist') == 'y') checked @endif class="custom-control-input chk-risk-contact-tourist" id="risk_contack_tourist_yes">
							<label for="risk_contack_tourist_yes" class="custom-control-label normal-label">ใช่</label>
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
					<label for="">ช่วง 14 วันก่อนป่วย ท่านมีประวัติเดินทางไปในสถานที่ที่มีคนหนาแน่น เช่น ผับ สนามมวย</label>
					<div class="card">
						<div class="custom-control custom-checkbox custom-control">
							<input type="checkbox" name="risk_travel_to_arena" value="n" @if ($invest_pt[0]['risk_travel_to_arena'] == 'n' || old('risk_travel_to_arena') == 'n') checked @endif class="custom-control-input risk_travel_to_arena" id="risk_travel_to_arena_no">
							<label for="risk_travel_to_arena_no" class="custom-control-label normal-label">ไม่ใช่</label>
						</div>
						<div class="custom-control custom-checkbox custom-control">
							<input type="checkbox" name="risk_travel_to_arena" value="y" @if ($invest_pt[0]['risk_travel_to_arena'] == 'y' || old('risk_travel_to_arena') == 'y') checked @endif class="custom-control-input risk_travel_to_arena" id="risk_travel_to_arena_yes">
							<label for="risk_travel_to_arena_yes" class="custom-control-label normal-label">ใช่</label>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="">ระบุชื่อสถานที่</label>
						<input type="text" name="risk_travel_arena_name" value="{{ old('risk_travel_arena_name') ?? $invest_pt[0]['risk_travel_arena_name'] }}" class="form-control" placeholder="ระบุสถานที่">
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="">เป็นผู้ป่วยอาการทางเดินหายใจหรือปอดอักเสบเป็นกลุ่มก้อน</label>
					<div class="card">
						<div class="custom-control custom-checkbox custom-control">
							<input type="checkbox" name="be_patient_cluster" value="n" @if ($invest_pt[0]['be_patient_cluster'] == 'n' || old('be_patient_cluster') == 'n') checked @endif class="custom-control-input be_patient_cluster" id="be_patient_cluster_no">
							<label for="be_patient_cluster_no" class="custom-control-label normal-label">ไม่ใช่</label>
						</div>
						<div class="custom-control custom-checkbox custom-control">
							<input type="checkbox" name="be_patient_cluster" value="y" @if ($invest_pt[0]['be_patient_cluster'] == 'y' || old('be_patient_cluster') == 'y') checked @endif  class="custom-control-input be_patient_cluster" id="be_patient_cluster_yes">
							<label for="be_patient_cluster_yes" class="custom-control-label normal-label">ใช่</label>
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
					<label for="">เป็นผู้ป่วยปอดอักเสบรุนแรงหรือเสียชีวิตที่หาสาเหตุไม่ได้</label>
					<div class="card">
						<div class="custom-control custom-checkbox custom-control">
							<input type="checkbox" name="be_patient_critical_unknown_cause" value="n" @if ($invest_pt[0]['be_patient_critical_unknown_cause'] == 'n' || old('be_patient_critical_unknown_cause') == 'n') checked @endif class="custom-control-input be_patient_critical_unknown_cause" id="be_patient_critical_unknown_cause_no">
							<label for="be_patient_critical_unknown_cause_no" class="custom-control-label normal-label">ไม่ใช่</label>
						</div>
						<div class="custom-control custom-checkbox custom-control">
							<input type="checkbox" name="be_patient_critical_unknown_cause" value="y" @if ($invest_pt[0]['be_patient_critical_unknown_cause'] == 'y' || old('be_patient_critical_unknown_cause') == 'y') checked @endif class="custom-control-input be_patient_critical_unknown_cause" id="be_patient_critical_unknown_cause_yes">
							<label for="be_patient_critical_unknown_cause_yes" class="custom-control-label normal-label">ใช่</label>
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
					<label for="">เป็นบุคลากรทางการแพทย์และสาธารณสุขหรือเจ้าหน้าที่ห้องปฏิบัติการ</label>
					<div class="card">
						<div class="custom-control custom-checkbox custom-control">
							<input type="checkbox" name="be_health_personel" value="n" @if ($invest_pt[0]['be_health_personel'] == 'n' || old('be_health_personel') == 'n') checked @endif class="custom-control-input be_health_personel" id="be_health_personel_no">
							<label for="be_health_personel_no" class="custom-control-label normal-label">ไม่ใช่</label>
						</div>
						<div class="custom-control custom-checkbox custom-control">
							<input type="checkbox" name="be_health_personel" value="y" @if ($invest_pt[0]['be_health_personel'] == 'y' || old('be_health_personel') == 'y') checked @endif class="custom-control-input be_health_personel" id="be_health_personel_yes">
							<label for="be_health_personel_yes" class="custom-control-label normal-label">ใช่</label>
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
					<label for="">อื่นๆ โปรดระบุ</label>
					<input type="text" name="risk_other" value="{{ old('risk_other') ?? $invest_pt[0]['risk_other'] }}" class="form-control" placeholder="ระบุ">
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="">ตารางกิจกรรมและการเดินทางตั้งแต่เริ่มป่วย</label>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead class="bg-info text-light">
								<tr>
									<th>วัน</th>
									<th>วันที่</th>
									<th>กิจกรรม</th>
									<th>สถานที่</th>
									<th>จำนวนผู้ร่วมกิจกรรม</th>
									<th>ระบุบุคคล หากทำได้</th>
								</tr>
							</thead>
							<tbody>
								@for ($i=1; $i<=10; $i++)
									<tr>
										<td>
											<input type="hidden" name="idx{{ $i }}" value="{{ $i }}">
											<input type="hidden" name="acc_day{{ $i }}" value="{{ $i }}">
											{{ $i }}
										</td>
										<td>
											<div class="form-group">
												<div class="input-group date">
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
													</div>
													<input type="text" name="activityDate{{$i}}" value="{{ $pt_activity[$i]['date_activity'] ?? '' }}" data-provide="datepicker" id="activity_date_{{$i}}" class="form-control" readonly>
													<div class="input-group-append">
														<button type="button" class="input-group-text text-danger" id="cls_activity_date_{{$i}}"><i class="fas fa-times"></i></button>
													</div>
												</div>
											</div>
										</td>
										<td>
											<div class="form-group">
												<input type="text" name="activity{{$i}}" value="{{ $pt_activity[$i]['activity'] ?? '' }}" class="form-control">
											</div>
										</td>
										<td>
											<div class="form-group">
												<input type="text" name="activityPlace{{$i}}" value="{{ $pt_activity[$i]['place'] ?? '' }}" class="form-control">
											</div>
										</td>
										<td>
											<div class="form-group">
												<input type="number" name="activityAmount{{$i}}" value="{{ !empty($pt_activity[$i]['personal_amount']) ? $pt_activity[$i]['personal_amount'] : 0 }}" class="form-control">
											</div>
										</td>
										<td>
											<div class="form-group">
												<input type="text" name="activityName{{$i}}" value="{{ $pt_activity[$i]['personal_name'] ?? '' }}" class="form-control">
											</div>
										</td>
									</tr>
								@endfor
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="note">บันทึกช่วยจำ</label>
					<textarea name="invest_note" class="form-control">{{ old('invest_note') ?? $invest_pt[0]['invest_note'] }}</textarea>
				</div>
			</div>
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="investFile" class="text-primary">แนบไฟล์สอบสวนโรค</label>
					<div class="input-group">
						<div class="custom-file">
							<input type="file" name="invest_file" class="custom-file-input" id="invest_file">
							<label class="custom-file-label border-primary" for="customFile">Choose file</label>
						</div>
					</div>
				</div>
			</div>
			@if (!is_null($invest_pt[0]['invest_file']))
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="alert alert-success" role="alert">
						<h5 class="alert-heading">ไฟล์แนบของคุณ</h5>
						<ul style="list-style-type:none;">
							<li><span class="span-80">ชื่อไฟล์:</span> {{ $invest_pt[0]['invest_file'] }}</li>
							<li><span class="span-80">ขนาด:</span> {{ number_format($invest_file_size, 2, '.', '') }} KB</li>
							<li><span class="span-80">ดาวน์โหลด:</span><a href="{{ route('invest.downloadInvestFile', [$invest_pt[0]['id']]) }}">คลิกที่นี่</a></li>
						</ul>
					</div>
				</div>
			@else
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="alert alert-danger" role="alert">
						<h5 class="alert-heading">ยังไม่มีไฟล์แนบ</h5>
					</div>
				</div>
			@endif
		</div>
	</section>
	<section class="card-body border-top">
		<div class="form-row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
					<label for="firstNameInput">ผู้รายงาน</label>
					<input type="hidden" name="userIdInput" value="{{ auth()->user()->id }}">
					<input type="text" name="userInput" value="{{ auth()->user()->username }}" class="form-control" readonly>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
					<label for="user_hospital">หน่วยงาน</label>
					<input type="text" name="userHospitalInput" value="{{ auth()->user()->name }}" class="form-control" readonly>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
					<label for="user_phone">โทรศัพท์</label>
					<input type="text" name="userPhoneInput" value="{{ auth()->user()->tel }}" class="form-control" placeholder="โทรศัพท์" readonly>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
					<label for="report_date">วันที่สอบสวน</label>
					<div class="input-group date">
						<div class="input-group-append">
							<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
						</div>
						<input type="text" name="invest_date" value="{{ old('invest_date') ?? $data['invest_date'] }}" data-provide="datepicke" id="invest_date" class="form-control" readonly required>
						<div class="input-group-append">
							<button type="button" class="input-group-text text-danger" id="cls_invest_date"><i class="fas fa-times"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</article>
