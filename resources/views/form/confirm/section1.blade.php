<div class="card">
	<div class="card-body">
		<h1 class="text-info">1. ข้อมูลทั่วไปของผู้ป่วย</h1>
		<input type="hidden" name="id" value="{{ $invest_pt[0]['id'] }}">
		<div class="card">
			<div class="card-body" style="margin:0; padding:0 0 30px 0;">
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
						<div class="form-group">
							<label for="titleName">คำนำหน้าชื่อ</label>
							<select name="titleName" class="form-control selectpicker show-tick" id="title_name">
								@if (!empty($invest_pt[0]['title_name']))
									<option value="{{ $invest_pt[0]['title_name'] }}" selected="selected">{{ $titleName[$invest_pt[0]['title_name']]['title_name'] }}</option>
								@endif
								<option value="">-- โปรดเลือก --</option>
								@foreach ($titleName as $key => $value)
									<option value="{{ $value['id'] }}">{{ $value['title_name'] }}</option>
								@endforeach
							</select>
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
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
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
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
						<div class="form-group">
							<label for="ageYear">อายุ/ปี</label>
							<input type="text" name="ageYearInput" value="{{ $invest_pt[0]['age'] }}" class="form-control" id="age_year_input" required>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
						<div class="form-group">
							<label for="ageMonth">อายุ/เดือน</label>
							<input type="text" name="ageMonthInput" value="{{ $invest_pt[0]['age_month'] }}" class="form-control" id="age_month_input">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
						<div class="form-group">
							<label for="ageDay">อายุ/วัน</label>
							<input type="text" name="ageDayInput" value="{{ $invest_pt[0]['age_days'] }}" class="form-control" id="age_day_input">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="nationality">สัญชาติ</label>
							<select name="nationalityInput" class="form-control selectpicker show-tick" id="select_nationality">
								@if (!empty($invest_pt[0]['nation']))
									<option value="{{ $invest_pt[0]['nation'] }}" selected="selected">{{ $globalCountry[$invest_pt[0]['nation']]['country_name'] }}</option>
								@endif
								<option value="">-- โปรดเลือก --</option>
								@foreach ($globalCountry as $key => $value)
									<option value="{{ $value['country_id'] }}">{{ $value['country_name'] }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="nationality">เชื้อชาติ</label>
							<select name="raceInput" class="form-control selectpicker show-tick" id="select_race">
								@if (!empty($invest_pt[0]['race']))
									<option value="{{ $invest_pt[0]['race'] }}" selected="selected">{{ $globalCountry[$invest_pt[0]['race']]['country_name'] }}</option>
								@endif
								<option value="0">-- โปรดเลือก --</option>
								@foreach ($globalCountry as $key => $value)
									<option value="{{ $value['country_id'] }}">{{ $value['country_name'] }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
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
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8 col-xl-8">
						<div class="form-group">
							<label for="occupationOth">อาชีพอื่นๆ</label>
							<input type="text" name="occupationOthInput" value="{{ $invest_pt[0]['occupation_oth'] }}" class="form-control" id="select_occupation_oth">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group">
							<label for="dowork">ลักษณะงานที่เสี่ยงติดโรค</label>
							<input type="text" name="workContactInput" value="{{ $invest_pt[0]['work_contact'] }}" class="form-control" placeholder="งานที่เสี่ยงติดโรค">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="workPlace">สถานที่ทำงาน (ระบุชื่อ)</label>
							<input type="text" name="workOfficeInput" value="{{ $invest_pt[0]['work_office'] }}" class="form-control" placeholder="สถานที่ทำงาน">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
						<div class="form-group">
							<label for="workPhone">โทรศัพท์ที่ทำงาน</label>
							<input type="text" name="workPhoneInput" value="{{ $invest_pt[0]['work_phone'] }}" class="form-control" placeholder="โทรศัพท์ที่ทำงาน">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="country" class="text-danger">ประเทศ</label>
							<select name="workCountryInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-danger" id="select_work_country">
								@if (!empty($invest_pt[0]['work_country']))
									<option value="{{ $invest_pt[0]['work_country'] }}" selected="selected">{{ $globalCountry[$invest_pt[0]['work_country']]['country_name'] }}</option>
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
							<label for="country" class="text-danger">เมือง (กรณี ตปท.)</label>
							<select name="workCityInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-danger" id="select_work_city">
								@if (!empty($invest_pt[0]['work_city']))
									<option value="{{ $work_city[0]['city_id'] }}" selected="selected">{{ $work_city[0]['city_name'] }}</option>
								@endif
								<option value="">-- โปรดเลือก --</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="city_other" class="text-danger">เมืองอื่นๆ ระบุ (กรณี ตปท.)</label>
							<input type="text" name="workCityOtherInput" value="{{ $invest_pt[0]['work_city_other'] }}" class="form-control border-danger text-danger" placeholder="เมืองอื่นๆ">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="province" class="text-danger">จังหวัด (กรณี ประเทศไทย)</label>
							<select name="workProvinceInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-danger" id="select_work_province">
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
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="district" class="text-danger">อำเภอ</label>
							<select name="workDistrictInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-danger" id="select_work_district">
								@if (!empty($invest_pt[0]['work_district']))
									<option value="{{ $work_district[0]['district_id'] }}" selected="selected">{{ $work_district[0]['district_name'] }}</option>
								@endif
								<option value="">-- โปรดเลือก --</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="subDistrict" class="text-danger">ตำบล</label>
							<select name="workSubDistrictInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-danger" id="select_work_sub_district">
								@if (!empty($invest_pt[0]['work_sub_district']))
									<option value="{{ $work_sub_district[0]['sub_district_id'] }}" selected="selected">{{ $work_sub_district[0]['sub_district_name'] }}</option>
								@endif
								<option value="">-- โปรดเลือก --</option>
							</select>
						</div>
					</div>
				</div>
			</div>


			<div class="card-body border-top" style="margin:0; padding:30px 0 30px 0;">
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
						<div class="form-group">
							<label for="houseNo">ที่อยู่ปัจจุบัน เลขที่</label>
							<input type="text" name="curHouseNoInput" value="{{ $invest_pt[0]['cur_house_no'] }}" class="form-control" placeholder="บ้านเลขที่">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-1 col-xl-1">
						<div class="form-group">
							<label for="villageNo">หมู่ที่</label>
							<input type="text" name="curVillageNoInput" value="{{ $invest_pt[0]['cur_village_no'] }}" class="form-control" placeholder="หมู่ที่">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
						<label for="village">หมู่บ้าน/ชุมชน</label>
						<input type="text" name="curVillageInput" value="{{ $invest_pt[0]['cur_village'] }}" class="form-control" placeholder="หมู่บ้าน">
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
						<div class="form-group">
							<label for="lane">ซอย</label>
							<input type="text" name="curLaneInput" value="{{ $invest_pt[0]['cur_lane'] }}" class="form-control" placeholder="ซอย">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
						<div class="form-group">
							<label for="road">ถนน</label>
							<input type="text" name="curRoadInput" value="{{ $invest_pt[0]['cur_road'] }}" class="form-control" placeholder="ถนน">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="country" class="text-primary">ประเทศ</label>
							<select name="curCountryInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-primary" id="select_cur_country">
								@if (!empty($invest_pt[0]['cur_country']))
									<option value="{{ $invest_pt[0]['cur_country'] }}" selected="selected">{{ $globalCountry[$invest_pt[0]['cur_country']]['country_name'] }}</option>
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
							<label for="country" class="text-primary">เมือง</label>
							<select name="curCityInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-primary" id="select_cur_city">
								@if (!empty($invest_pt[0]['cur_city']))
									<option value="{{ $cur_city[0]['city_id'] }}" selected="selected">{{ $cur_city[0]['city_name'] }}</option>
								@endif
								<option value="">-- โปรดเลือก --</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="city_other" class="text-primary">เมืองอื่นๆ ระบุ</label>
							<input type="text" name="curCityOtherInput" value="{{ $invest_pt[0]['cur_city_other'] }}" class="form-control border-primary text-primary" placeholder="เมืองอื่นๆ">
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="province" class="text-primary">จังหวัด</label>
							<select name="curProvinceInput" class="form-control selectpicker show-tick" data-style="btn-outline-primary" id="select_cur_province">
								@if (!empty($invest_pt[0]['cur_province']))
									<option value="{{ $invest_pt[0]['cur_province'] }}" selected="selected">{{ $provinces[$invest_pt[0]['cur_province']]['province_name'] }}</option>
								@endif
								<option value="">-- เลือกจังหวัด --</option>
								@php
									foreach($provinces as $key=>$val) {
										$htm = "<option value=\"".$val['province_id']."\"";
											if (old('curProvinceInput') == $val['province_id']) {
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
							<label for="district" class="text-primary">อำเภอ</label>
							<select name="curDistrictInput" class="form-control selectpicker show-tick" data-style="btn-outline-primary" id="select_cur_district">
								@if (!empty($invest_pt[0]['cur_district']))
									<option value="{{ $cur_district[0]['district_id'] }}" selected="selected">{{ $cur_district[0]['district_name'] }}</option>
								@endif
								<option value="">-- โปรดเลือก --</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="subDistrict" class="text-primary">ตำบล</label>
							<select name="curSubDistrictInput" class="form-control selectpicker show-tick" data-style="btn-outline-primary" id="select_cur_sub_district">
								@if (!empty($invest_pt[0]['cur_sub_district']))
									<option value="{{ $cur_sub_district[0]['sub_district_id'] }}" selected="selected">{{ $cur_sub_district[0]['sub_district_name'] }}</option>
								@endif
								<option value="">-- โปรดเลือก --</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="telephone">โทรศัพท์</label>
							<input type="text" name="curPhoneInput" value="{{ $invest_pt[0]['cur_phone'] }}" class="form-control" placeholder="โทรศัพท์บ้าน">
						</div>
					</div>
				</div>
			</div>


			<div class="card-body border-top" style="margin:0; padding:30px 0 0 0;">
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
						<div class="form-group">
							<label for="houseNo">ที่อยู่ขณะป่วย เลขที่</label>
							<input type="text" name="sickHouseNoInput" value="{{ $invest_pt[0]['sick_house_no'] }}" class="form-control" placeholder="บ้านเลขที่">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-1 col-xl-1">
						<div class="form-group">
							<label for="villageNo">หมู่ที่</label>
							<input type="text" name="sickVillageNoInput" value="{{ $invest_pt[0]['sick_village_no'] }}" class="form-control" placeholder="หมู่ที่">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
						<label for="village">หมู่บ้าน/ชุมชน</label>
						<input type="text" name="sickVillageInput" value="{{ $invest_pt[0]['sick_village'] }}" class="form-control" placeholder="หมู่บ้าน">
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
						<div class="form-group">
							<label for="lane">ซอย</label>
							<input type="text" name="sickLaneInput" value="{{ $invest_pt[0]['sick_lane'] }}" class="form-control" placeholder="ซอย">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
						<div class="form-group">
							<label for="road">ถนน</label>
							<input type="text" name="sickRoadInput" value="{{ $invest_pt[0]['sick_road'] }}" class="form-control" placeholder="ถนน">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="country">ประเทศ</label>
							<select name="sickCountryInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-success" id="select_sick_country">
								@if (!empty($invest_pt[0]['sick_country']))
									<option value="{{ $invest_pt[0]['sick_country'] }}" selected="selected">{{ $globalCountry[$invest_pt[0]['sick_country']]['country_name'] }}</option>
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
							<label for="country" class="text-success">เมือง</label>
							<select name="sickCityInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-success" id="select_sick_city">
								@if (!empty($invest_pt[0]['sick_city']))
									<option value="{{ $sick_city[0]['city_id'] }}" selected="selected">{{ $sick_city[0]['city_name'] }}</option>
								@endif
								<option value="">-- โปรดเลือก --</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="city_other" class="text-danger">เมืองอื่นๆ ระบุ</label>
							<input type="text" name="sickCityOtherInput" value="{{ $invest_pt[0]['sick_city_other'] }}" class="form-control border-danger text-danger" placeholder="เมืองอื่นๆ">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="province">จังหวัด</label>
							<select name="sickProvinceInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-success" id="select_sick_province">
								@if (!empty($invest_pt[0]['sick_province']))
									<option value="{{ $invest_pt[0]['sick_province'] }}" selected="selected">{{ $provinces[$invest_pt[0]['sick_province']]['province_name'] }}</option>
								@endif
								<option value="">-- เลือกจังหวัด --</option>
								@foreach($provinces as $key => $val)
									<option value="{{ $val['province_id'] }}" @if ($invest_pt[0]['sick_province'] == $val['province_id']) selected @endif>{{ $val['province_name'] }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="district">อำเภอ</label>
							<select name="sickDistrictInput" class="form-control selectpicker show-tick" data-style="btn-outline-success" id="select_sick_district">
								@if (!empty($invest_pt[0]['sick_district']))
									<option value="{{ $sick_district[0]['district_id'] }}" selected="selected">{{ $sick_district[0]['district_name'] }}</option>
								@endif
								<option value="">-- โปรดเลือก --</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="subDistrict">ตำบล</label>
							<select name="sickSubDistrictInput" class="form-control selectpicker show-tick" data-style="btn-outline-success" id="select_sick_sub_district">
								@if (!empty($invest_pt[0]['sick_sub_district']))
									<option value="{{ $sick_sub_district[0]['sub_district_id'] }}" selected="selected">{{ $sick_sub_district[0]['sub_district_name'] }}</option>
								@endif
								<option value="">-- โปรดเลือก --</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="telephone">โทรศัพท์</label>
							<input type="text" name="sickTelePhoneInput" value="{{ $invest_pt[0]['sick_phone'] }}" class="form-control" placeholder="โทรศัพท์">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
