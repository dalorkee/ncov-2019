<div class="card">
	<div class="card-body" style="margin:0;padding-top:10px;padding-bottom:0">
		<h1 class="card-title m-b-0 m-t-0 text-danger">2. ข้อมูลการเจ็บป่วย</h1>
	</div>
	<ul class="list-style-none">
		<li class="card-body">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="villageNo">2.1 ประวัติมีไข้</label>
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
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="villageNo">ไข้ (องศา)</label>
						<div class="input-group">
							<input type="text" name="fever" value="{{ $invest_pt[0]['fever_current'] }}" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">C&#176;</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="houseNo">วันที่เริ่มป่วย</label>
						<div class="input-group date" data-provide="datepicker" id="data3_1date_sickdate">
							<div class="input-group">
								<input type="text" name="data3_1date_sickdate" value="{{ $data['data3_1date_sickdate'] }}" class="form-control">
								<div class="input-group-append">
									<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="lane">RR</label>
						<div class="input-group">
							<input type="text" name="rr_rpm" value="{{ $invest_pt[0]['rr_rpm'] }}" class="form-control" placeholder="RR RPM">
							<div class="input-group-append">
								<span class="input-group-text">ครั้ง/นาที</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
					<div class="form-group">
						<label for="informant">2.2 อาการ</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="sym_cough" value="y" class="custom-control-input pt-type" id="coughChk" @if ($invest_pt[0]['sym_cough'] == 'y') checked @endif>
								<label for="coughChk" class="custom-control-label normal-label">ไอ</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="sym_snot" value="y" class="custom-control-input pt-type" id="snotChk" @if ($invest_pt[0]['sym_snot'] == 'y') checked @endif>
								<label for="snotChk" class="custom-control-label normal-label">น้ำมูก</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="sym_sore" value="y" class="custom-control-input pt-type" id="soreChk" @if ($invest_pt[0]['sym_sore'] == 'y') checked @endif>
								<label for="soreChk" class="custom-control-label normal-label">เจ็บคอ</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="sym_dyspnea" value="y" class="custom-control-input pt-type" id="dyspneaChk" @if ($invest_pt[0]['sym_dyspnea'] == 'y') checked @endif>
								<label for="dyspneaChk" class="custom-control-label normal-label">หายใจเหนื่อย</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="sym_breathe" value="y" class="custom-control-input pt-type" id="breatheChk" @if ($invest_pt[0]['sym_breathe'] == 'y') checked @endif>
								<label for="breatheChk" class="custom-control-label normal-label">หายใจลำบาก</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="sym_stufefy" value="y" class="custom-control-input pt-type" id="stufefyChk" @if ($invest_pt[0]['sym_stufefy'] == 'y') checked @endif>
								<label for="stufefyChk" class="custom-control-label normal-label">ซึม</label>
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
						<label for="villageNo">2.3 สถานที่รักษา (ครั้งแรก)</label>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="country">ประเทศ</label>
						<select name="treatFirstCountryInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn btn-outline-info" id="treat_first_country">
							@if (!empty($invest_pt[0]['treat_first_country']))
								<option value="{{ $invest_pt[0]['treat_first_country'] }}" selected="selected">{{ $globalCountry[$invest_pt[0]['treat_first_country']]['country_name'] }}</option>
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
						<label for="country">เมือง (กรณี ตปท.)</label>
						<select name="treatFirstCityInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn btn-outline-info" id="treat_first_city">
							@if (!empty($invest_pt[0]['treat_first_city']))
								<option value="{{ $treat_first_city[0]['city_id'] }}" selected="selected">{{ $treat_first_city[0]['city_name'] }}</option>
							@endif
							<option value="">-- โปรดเลือก --</option>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="city_other">เมืองอื่นๆ (กรณี ตปท.)</label>
						<input type="text" name="treatFirstCityOtherInput" value="{{ $invest_pt[0]['treat_first_city_other'] }}" class="form-control btn-outline-info" placeholder="เมืองอื่นๆ ระบุ">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="province">จังหวัด (กรณี ประเทศไทย)</label>
						<select name="treatFirstProvinceInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn btn-outline-info" id="treat_first_province">
							@if (!empty($invest_pt[0]['treat_first_province']))
								<option value="{{ $invest_pt[0]['treat_first_province'] }}" selected="selected">{{ $provinces[$invest_pt[0]['treat_first_province']]['province_name'] }}</option>
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
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="district">อำเภอ (กรณี ประเทศไทย)</label>
						<select name="treatFirstDistrictInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn btn-outline-info" id="treat_first_district">
							@if (!empty($invest_pt[0]['treat_first_district']))
								<option value="{{ $treat_first_district[0]['district_id'] }}" selected="selected">{{ $treat_first_district[0]['district_name'] }}</option>
							@endif
							<option value="">-- โปรดเลือก --</option>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="subDistrict">ตำบล (กรณี ประเทศไทย)</label>
						<select name="treatFirstSubDistrictInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn btn-outline-info" id="treat_first_sub_district">
							@if (!empty($invest_pt[0]['treat_first_sub_district']))
								<option value="{{ $treat_first_sub_district[0]['sub_district_id'] }}" selected="selected">{{ $treat_first_sub_district[0]['sub_district_name'] }}</option>
							@endif
							<option value="">-- โปรดเลือก --</option>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="date">วันที่เข้ารักษาครั้งแรก</label>
						<div class="input-group date" data-provide="datepicker" id="treat_first_date">
							<input type="text" name="treat_first_date" value="{{ $data['treat_first_date'] }}" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
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
						<label for="country">สถานที่รักษาปัจจุบัน ประเทศ</label>
						<select name="treatPlaceCountryInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn btn-outline-cyan" id="treat_place_country">
							@if (!empty($invest_pt[0]['treat_place_country']))
								<option value="{{ $invest_pt[0]['treat_place_country'] }}" selected="selected">{{ $globalCountry[$invest_pt[0]['treat_place_country']]['country_name'] }}</option>
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
						<label for="country">เมือง (กรณี ตปท.)</label>
						<select name="treatPlaceCityInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn btn-outline-cyan" id="treat_place_city">
							@if (!empty($invest_pt[0]['treat_place_city']))
								<option value="{{ $treat_place_city[0]['city_id'] }}" selected="selected">{{ $treat_place_city[0]['city_name'] }}</option>
							@endif
							<option value="">-- โปรดเลือก --</option>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="city_other">เมืองอื่นๆ (กรณี ตปท.)</label>
						<input type="text" name="treatPlaceCityOtherInput" value="{{ $invest_pt[0]['treat_place_city_other'] }}" class="form-control btn-outline-cyan" placeholder="เมืองอื่นๆ ระบุ">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="province">จังหวัด (กรณี ประเทศไทย)</label>
						<select name="treatPlaceProvinceInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn btn-outline-cyan" id="treat_place_province">
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
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="district">อำเภอ (กรณี ประเทศไทย)</label>
						<select name="treatPlaceDistrictInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn btn-outline-cyan" id="treat_place_district">
							@if (!empty($invest_pt[0]['treat_place_district']))
								<option value="{{ $treat_place_district[0]['district_id'] }}" selected="selected">{{ $treat_place_district[0]['district_name'] }}</option>
							@endif
							<option value="">-- โปรดเลือก --</option>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="subDistrict">ตำบล (กรณี ประเทศไทย)</label>
						<select name="treatPlaceSubDistrictInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn btn-outline-cyan" id="treat_place_sub_district">
							@if (!empty($invest_pt[0]['treat_place_sub_district']))
								<option value="{{ $treat_place_sub_district[0]['sub_district_id'] }}" selected="selected">{{ $treat_place_sub_district[0]['sub_district_name'] }}</option>
							@endif
							<option value="">-- โปรดเลือก --</option>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="date">วันที่</label>
						<div class="input-group date" data-provide="datepicker" id="treat_place_date">
							<input type="text" name="treat_place_date" value="{{ $data['treat_place_date'] }}" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<label for="occupation">2.5 โรคประจำตัว</label>
				</div>
				<div class="card">
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="data3_3chk" value="n" @if ($invest_pt[0]['data3_3chk'] == 'n') checked @endif class="custom-control-input chk_risk3_3" id="data3_3chkNo">
						<label for="data3_3chkNo" class="custom-control-label normal-label">ไม่มี</label>
					</div>
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="data3_3chk" value="y" @if ($invest_pt[0]['data3_3chk'] == 'y') checked @endif class="custom-control-input chk_risk3_3" id="data3_3chkYes">
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
											<input type="checkbox" name="data3_3chk_lung" value="y" @if($invest_pt[0]['data3_3chk_lung'] == 'y') checked @endif class="custom-control-input" id="data3_3chk_lung">
											<label for="data3_3chk_lung" class="custom-control-label normal-label">
												โรคปอดเรื้อรัง เช่น COPD, chronic bronchitis, chronic bronchiectasis, BPD, หรือหอบ (asthma) ที่กำลังรักษา
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr2">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="data3_3chk_heart" value="y" @if ($invest_pt[0]['data3_3chk_heart'] == 'y') checked @endif class="custom-control-input" id="data3_3chk_heart">
											<label for="data3_3chk_heart" class="custom-control-label normal-label">
												โรคหัวใจ เช่น หัวใจพิการแต่กำเนิด, โรคหลอดเลือดหัวใจ หรือ Congestive heart failure
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr3">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="data3_3chk_cirrhosis" value="y" @if ($invest_pt[0]['data3_3chk_cirrhosis'] == 'y') checked @endif class="custom-control-input" id="data3_3chk_cirrhosis">
											<label for="data3_3chk_cirrhosis" class="custom-control-label normal-label">
												โรคตับเรื้อรัง เช่น ตับแข็ง (Cirrhosis)
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr4">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="data3_3chk_kidney" value="y" @if ($invest_pt[0]['data3_3chk_kidney'] == 'y') checked @endif class="custom-control-input" id="data3_3chk_kidney">
											<label for="data3_3chk_kidney" class="custom-control-label normal-label">
												โรคไต, ไตวาย
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr5">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="data3_3chk_diabetes" value="y" @if ($invest_pt[0]['data3_3chk_diabetes'] == 'y') checked @endif class="custom-control-input" id="data3_3chk_diabetes">
											<label for="data3_3chk_diabetes" class="custom-control-label normal-label">
												เบาหวาน
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr6">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="data3_3chk_blood" value="y" @if ($invest_pt[0]['data3_3chk_blood'] == 'y') checked @endif class="custom-control-input" id="data3_3chk_blood">
											<label for="data3_3chk_blood" class="custom-control-label normal-label">
												ความดันโลหิตสูง
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr7">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="data3_3chk_immune" value="y" @if ($invest_pt[0]['data3_3chk_immune'] == 'y') checked @endif class="custom-control-input" id="data3_3chk_immune">
											<label for="data3_3chk_immune" class="custom-control-label normal-label">
												ภูมิคุ้มกันบกพร่อง
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr8">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="data3_3chk_anaemia" value="y" @if ($invest_pt[0]['data3_3chk_anaemia'] == 'y') checked @endif class="custom-control-input" id="data3_3chk_anaemia">
											<label for="data3_3chk_anaemia" class="custom-control-label normal-label">
												โลหิตจาง (ธาลัสซีเมีย, sickle cell anemia)
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr9">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="data3_3chk_cerebral" value="y"  @if ($invest_pt[0]['data3_3chk_cerebral'] == 'y') checked @endif class="custom-control-input" id="data3_3chk_cerebral">
											<label for="data3_3chk_cerebral" class="custom-control-label normal-label">
												พิการทางสมอง ช่วยเหลือตัวเองไม่ได้
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr10">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="data3_3chk_pregnant" value="y" @if ($invest_pt[0]['data3_3chk_pregnant'] == 'y') checked @endif class="custom-control-input" id="data3_3chk_pregnant">
											<label for="data3_3chk_pregnant" class="custom-control-label normal-label">
												ตั้งครรภ์
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr11">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="data3_3chk_fat" value="y" @if ($invest_pt[0]['data3_3chk_fat'] == 'y') checked @endif class="custom-control-input" id="data3_3chk_fat">
											<label for="data3_3chk_fat" class="custom-control-label normal-label">
												อ้วน
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr12">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="data3_3chk_cancer" value="y" @if ($invest_pt[0]['data3_3chk_cancer'] == 'y') checked @endif class="custom-control-input" id="data3_3chk_cancer">
											<label for="data3_3chk_cancer" class="custom-control-label normal-label">
												มะเร็ง
											</label>
											<div class="row mt-2">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
													<div class="form-group">
														<input type="text" name="data3_3chk_cancer_name" value="{{ $invest_pt[0]['data3_3chk_cancer_name'] }}" class="form-control" placeholder="ประเภทมะเร็ง">
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr13">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="data3_3chk_other" value="y" class="custom-control-input" @if ($invest_pt[0]['data3_3chk_other'] == 'y') checked @endif id="data3_3chk_other">
											<label for="data3_3chk_other" class="custom-control-label normal-label">
												อื่นๆ
											</label>
											<div class="row mt-2">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
													<div class="form-group">
														<input type="text" name="data3_3input_other"  class="form-control" value="{{ $invest_pt[0]['data3_3input_other'] }}" placeholder="อื่นๆ โปรดระบุ">
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
		</li>
	</ul>
</div><!-- card2 -->
