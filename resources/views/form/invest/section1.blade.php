<div class="card">
	<div class="card-body">
		<h1 class="text-info">1. ข้อมูลทั่วไปของผู้ป่วย</h1>
		<input type="hidden" name="id" value="{{ $invest_pt[0]['id'] }}">
		<div class="card">
			<div class="card-body" style="margin:0; padding:0 0 30px 0;">
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="idcard" class="text-primary">เลขบัตรประจำตัวประชาชน&nbsp;&#42;</label>
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text text-primary"><i class="far fa-id-card"></i></span>
								</div>
								<input type="text" name="idcardInput" value="{{ old('idcardInput') ?? $invest_pt[0]['card_id'] }}" class="form-control text-info font-weight-bold font-fira" id="idcardInput">
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="passport" class="text-primary">พาสปอร์ต&nbsp;&#42;</label>
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text text-primary"><i class="fas fa-globe"></i></span>
								</div>
								<input type="text" name="passportInput" value="{{ old('passportInput') ?? $invest_pt[0]['passport'] }}" class="form-control text-info font-weight-bold font-fira" id="passport">
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="hn" class="text-primary">HN&nbsp;&#42;</label>
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text text-primary"><i class="fas fa-h-square"></i></span>
								</div>
								<input type="text" name="hn" value="{{ old('hn') ?? $invest_pt[0]['hn'] }}" class="form-control text-info font-weight-bold font-fira" id="hn">
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="titleName">คำนำหน้าชื่อ</label>
							<select name="titleName" class="form-control selectpicker show-tick" id="title_name">
								@if ((!empty(old('titleName'))) || (!is_null($invest_pt[0]['title_name']) && !empty($invest_pt[0]['title_name']) && $invest_pt[0]['title_name'] != '0'))
									<option value="{{ old('titleName') ?? $invest_pt[0]['title_name'] }}" selected="selected">{{ $titleName[old('titleName')]['title_name'] ?? $titleName[$invest_pt[0]['title_name']]['title_name'] }}</option>
								@endif
								<option value="0">-- โปรดเลือก --</option>
								@foreach ($titleName as $key => $value)
									<option value="{{ $value['id'] }}">{{ $value['title_name'] }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="firstName">ชื่อจริง</label>
							<input type="text" name="firstNameInput" value="{{ old('firstNameInput') ?? $invest_pt[0]['first_name'] }}" class="form-control" id="first_name_input" placeholder="ชื่อ" required>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="lastName">นามสกุล</label>
							<input type="text" name="lastNameInput" value="{{ old('lastNameInput') ?? $invest_pt[0]['last_name'] }}" class="form-control" id="last_name_input" placeholder="นามสกุล" required>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
						<div class="form-group">
							<label for="sex">เพศ</label>
							<select name="sexInput" class="form-control selectpicker show-tick" id="select_sex">
								@if ((!empty(old('sexInput'))) || (!is_null($invest_pt[0]['sex']) && !empty($invest_pt[0]['sex']) && $invest_pt[0]['sex'] != '0'))
									<option value="{{ old('sexInput') ?? $invest_pt[0]['sex'] }}" selected="selected">{{ old('sexInput') ?? $invest_pt[0]['sex'] }}</option>
								@endif
								<option value="0">-- โปรดเลือก --</option>
								<option value="ชาย">ชาย</option>
								<option value="หญิง">หญิง</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
						<div class="form-group">
							<label for="ageYear">อายุ/ปี</label>
							<input type="text" name="ageYearInput" value="{{ old('ageYearInput') ?? $invest_pt[0]['age'] }}" class="form-control" id="age_year_input" required>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
						<div class="form-group">
							<label for="ageMonth">อายุ/เดือน</label>
							<input type="text" name="ageMonthInput" value="{{ old('ageMonthInput') ?? $invest_pt[0]['age_month'] }}" class="form-control" id="age_month_input">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
						<div class="form-group">
							<label for="ageDay">อายุ/วัน</label>
							<input type="text" name="ageDayInput" value="{{ old('ageDayInput') ?? $invest_pt[0]['age_days'] }}" class="form-control" id="age_day_input">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="nationality">สัญชาติ</label>
							<select name="nationalityInput" class="form-control selectpicker show-tick" id="select_nationality">
								@if ((!empty(old('nationalityInput'))) || (!is_null($invest_pt[0]['nation']) && !empty($invest_pt[0]['nation']) && $invest_pt[0]['nation'] != '0'))
									<option value="{{ old('nationalityInput') ?? $invest_pt[0]['nation'] }}" selected="selected">{{ $globalCountry[old('nationalityInput')]['country_name'] ?? $globalCountry[$invest_pt[0]['nation']]['country_name'] }}</option>
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
								@if ((!empty(old('occupationInput'))) || (!is_null($invest_pt[0]['occupation']) && !empty($invest_pt[0]['occupation']) && $invest_pt[0]['occupation'] != 0))
									<option value="{{ old('occupationInput') ?? $invest_pt[0]['occupation'] }}" selected="selected">{{ $occupation[old('occupationInput')]['occu_name_th'] ?? $occupation[$invest_pt[0]['occupation']]['occu_name_th'] }}</option>
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
							<input type="text" name="occupationOthInput" value="{{ old('occupationOthInput') ?? $invest_pt[0]['occupation_oth'] }}" class="form-control" id="select_occupation_oth">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="alert alert-warning" role="alert">
							<span class="text-danger">ระบุลักษณะงานที่ทำอย่างละเอียด เช่น บุคลากรทางการแพทย์ เจ้าหน้าที่ที่สัมผัสกับนักท่องเที่ยว</span>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group">
							<label for="workPlace">สถานที่ทำงาน/สถานศึกษา</label>
							<input type="text" name="workOfficeInput" value="{{ old('workOfficeInput') ?? $invest_pt[0]['work_office'] }}" class="form-control" placeholder="สถานที่ทำงาน">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group">
							<label for="dowork">ลักษณะงานที่เสี่ยงติดโรค</label>
							<input type="text" name="workContactInput" value="{{ old('workContactInput') ?? $invest_pt[0]['work_contact'] }}" class="form-control" placeholder="งานที่เสี่ยงติดโรค">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
						<div class="form-group">
							<label for="workPhone">โทรศัพท์ที่ติดต่อได้</label>
							<input type="text" name="workPhoneInput" value="{{ old ('workPhoneInput') ?? $invest_pt[0]['work_phone'] }}" class="form-control" placeholder="โทรศัพท์ที่ติดต่อได้">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="form-group">
							<label for="">ที่อยู่ขณะป่วย (ปัจจุบัน)</label>
							<div class="card">
								<div class="custom-control custom-checkbox custom-control">
									<input type="checkbox" name="sickStayTypeChk" value="home" class="custom-control-input sick_stay_type-chk" @if ($invest_pt[0]['sick_stay_type'] == 'home' || old('sickStayTypeChk') == 'home') checked @endif id="sickStayTypeChkNo">
									<label for="sickStayTypeChkNo" class="custom-control-label normal-label">บ้าน</label>
								</div>
								<div class="custom-control custom-checkbox custom-control">
									<input type="checkbox" name="sickStayTypeChk" value="other" class="custom-control-input sick_stay_type-chk" @if ($invest_pt[0]['sick_stay_type'] == 'other' || old('sickStayTypeChk') == 'other') checked @endif id="sickStayTypeChkOther">
									<label for="sickStayTypeChkOther" class="custom-control-label normal-label">อื่นๆ โปรดระบุ</label>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="form-group">
							<label for="houseNo">ที่อยู่ขณะป่วย (ปัจจุบัน) อื่นๆ ระบุ</label>
							<input type="text" name="sickStayTypeOtherInput" value="{{ old('sickStayTypeOtherInput') ?? $invest_pt[0]['sick_stay_type_other'] }}" class="form-control" placeholder="ระบุ">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
						<div class="form-group">
							<label for="houseNo">บ้านเลขที่</label>
							<input type="text" name="sickHouseNoInput" value="{{ old('sickHouseNoInput') ?? $invest_pt[0]['sick_house_no'] }}" class="form-control" placeholder="บ้านเลขที่">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-1 col-xl-1">
						<div class="form-group">
							<label for="villageNo">หมู่ที่</label>
							<input type="text" name="sickVillageNoInput" value="{{ old('sickVillageNoInput') ?? $invest_pt[0]['sick_village_no'] }}" class="form-control" placeholder="หมู่ที่">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
						<label for="village">หมู่บ้าน/ชุมชน</label>
						<input type="text" name="sickVillageInput" value="{{ old('sickVillageInput') ?? $invest_pt[0]['sick_village'] }}" class="form-control" placeholder="หมู่บ้าน">
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
						<div class="form-group">
							<label for="lane">ซอย</label>
							<input type="text" name="sickLaneInput" value="{{ old('sickLaneInput') ?? $invest_pt[0]['sick_lane'] }}" class="form-control" placeholder="ซอย">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
						<div class="form-group">
							<label for="road">ถนน</label>
							<input type="text" name="sickRoadInput" value="{{ old('sickRoadInput') ?? $invest_pt[0]['sick_road'] }}" class="form-control" placeholder="ถนน">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="sickProvince" class="text-primary">จังหวัด</label>
							<select name="sickProvinceInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-primary" id="select_sick_province">
								@if ((!empty(old('sickProvinceInput'))) || (!is_null($invest_pt[0]['sick_province']) && !empty($invest_pt[0]['sick_province']) && $invest_pt[0]['sick_province'] != 0))
									<option value="{{ old('sickProvinceInput') ?? $invest_pt[0]['sick_province'] }}" selected="selected">{{ $provinces[old('sickProvinceInput')]['province_name'] ?? $provinces[$invest_pt[0]['sick_province']]['province_name'] }}</option>
								@endif
								<option value="0">-- เลือกจังหวัด --</option>
								@foreach($provinces as $key => $val)
									<option value="{{ $val['province_id'] }}" @if ($invest_pt[0]['sick_province'] == $val['province_id']) selected @endif>{{ $val['province_name'] }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="sickDistrict" class="text-primary">อำเภอ</label>
							<select name="sickDistrictInput" class="form-control selectpicker show-tick" data-style="btn-outline-primary" id="select_sick_district">
								@if (!empty($invest_pt[0]['sick_district']) && !is_null($invest_pt[0]['sick_district']) && $invest_pt[0]['sick_district'] != 0)
									<option value="{{ $sick_district[0]['district_id'] }}" selected="selected">{{ $sick_district[0]['district_name'] }}</option>
								@endif
								<option value="0">-- โปรดเลือก --</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="sickSubDistrict" class="text-primary">ตำบล</label>
							<select name="sickSubDistrictInput" class="form-control selectpicker show-tick" data-style="btn-outline-primary" id="select_sick_sub_district">
								@if (!empty($invest_pt[0]['sick_sub_district']) && !is_null($invest_pt[0]['sick_sub_district']) && $invest_pt[0]['sick_sub_district'] != 0)
									<option value="{{ $sick_sub_district[0]['sub_district_id'] }}" selected="selected">{{ $sick_sub_district[0]['sub_district_name'] }}</option>
								@endif
								<option value="0">-- โปรดเลือก --</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<label for="occupation">โรคประจำตัว</label>
					</div>
					<div class="card">
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="data3_3chk" value="n" @if ($invest_pt[0]['data3_3chk'] == 'n' || old('data3_3chk') == 'n') checked @endif class="custom-control-input chk_risk3_3" id="data3_3chkNo">
							<label for="data3_3chkNo" class="custom-control-label normal-label">ไม่มี</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="data3_3chk" value="y" @if ($invest_pt[0]['data3_3chk'] == 'y' || old('data3_3chk') == 'y') checked @endif class="custom-control-input chk_risk3_3" id="data3_3chkYes">
							<label for="data3_3chkYes" class="custom-control-label normal-label">มี (กรุณาทำเครื่องหมายด้านล่าง)</label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="table-responsive">
							<table class="table">
								<thead></thead>
								<tfoot></tfoot>
								<tbody>
									<tr id="risk3_3table_tr1">
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="data3_3chk_lung" value="y" @if($invest_pt[0]['data3_3chk_lung'] == 'y' || old('data3_3chk_lung') == 'y') checked @endif class="custom-control-input" id="data3_3chk_lung">
												<label for="data3_3chk_lung" class="custom-control-label normal-label">
													โรคปอดเรื้อรัง เช่น COPD, chronic bronchitis, chronic bronchiectasis, BPD, หรือหอบ (asthma) ที่กำลังรักษา
												</label>
											</div>
										</td>
									</tr>
									<tr id="risk3_3table_tr2">
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="data3_3chk_heart" value="y" @if ($invest_pt[0]['data3_3chk_heart'] == 'y' || old('data3_3chk_heart') == 'y') checked @endif class="custom-control-input" id="data3_3chk_heart">
												<label for="data3_3chk_heart" class="custom-control-label normal-label">
													โรคหัวใจ เช่น หัวใจพิการแต่กำเนิด, โรคหลอดเลือดหัวใจ หรือ Congestive heart failure
												</label>
											</div>
										</td>
									</tr>
									<tr id="risk3_3table_tr3">
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="data3_3chk_cirrhosis" value="y" @if ($invest_pt[0]['data3_3chk_cirrhosis'] == 'y' || old('data3_3chk_cirrhosis') == 'y') checked @endif class="custom-control-input" id="data3_3chk_cirrhosis">
												<label for="data3_3chk_cirrhosis" class="custom-control-label normal-label">
													โรคตับเรื้อรัง เช่น ตับแข็ง (Cirrhosis)
												</label>
											</div>
										</td>
									</tr>
									<tr id="risk3_3table_tr4">
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="data3_3chk_kidney" value="y" @if ($invest_pt[0]['data3_3chk_kidney'] == 'y' || old('data3_3chk_kidney') == 'y') checked @endif class="custom-control-input" id="data3_3chk_kidney">
												<label for="data3_3chk_kidney" class="custom-control-label normal-label">
													โรคไต, ไตวาย
												</label>
											</div>
										</td>
									</tr>
									<tr id="risk3_3table_tr5">
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="data3_3chk_diabetes" value="y" @if ($invest_pt[0]['data3_3chk_diabetes'] == 'y' || old('data3_3chk_diabetes') == 'y') checked @endif class="custom-control-input" id="data3_3chk_diabetes">
												<label for="data3_3chk_diabetes" class="custom-control-label normal-label">
													เบาหวาน
												</label>
											</div>
										</td>
									</tr>
									<tr id="risk3_3table_tr6">
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="data3_3chk_blood" value="y" @if ($invest_pt[0]['data3_3chk_blood'] == 'y' || old('data3_3chk_blood') == 'y') checked @endif class="custom-control-input" id="data3_3chk_blood">
												<label for="data3_3chk_blood" class="custom-control-label normal-label">
													ความดันโลหิตสูง
												</label>
											</div>
										</td>
									</tr>
									<tr id="risk3_3table_tr7">
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="data3_3chk_immune" value="y" @if ($invest_pt[0]['data3_3chk_immune'] == 'y' || old('data3_3chk_immune') == 'y') checked @endif class="custom-control-input" id="data3_3chk_immune">
												<label for="data3_3chk_immune" class="custom-control-label normal-label">
													ภูมิคุ้มกันบกพร่อง
												</label>
											</div>
										</td>
									</tr>
									<tr id="risk3_3table_tr8">
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="data3_3chk_anaemia" value="y" @if ($invest_pt[0]['data3_3chk_anaemia'] == 'y' || old('data3_3chk_anaemia') == 'y') checked @endif class="custom-control-input" id="data3_3chk_anaemia">
												<label for="data3_3chk_anaemia" class="custom-control-label normal-label">
													โลหิตจาง (ธาลัสซีเมีย, sickle cell anemia)
												</label>
											</div>
										</td>
									</tr>
									<tr id="risk3_3table_tr9">
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="data3_3chk_cerebral" value="y"  @if ($invest_pt[0]['data3_3chk_cerebral'] == 'y' || old('data3_3chk_cerebral') == 'y') checked @endif class="custom-control-input" id="data3_3chk_cerebral">
												<label for="data3_3chk_cerebral" class="custom-control-label normal-label">
													พิการทางสมอง ช่วยเหลือตัวเองไม่ได้
												</label>
											</div>
										</td>
									</tr>
									<tr id="risk3_3table_tr10">
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="data3_3chk_pregnant" value="y" @if ($invest_pt[0]['data3_3chk_pregnant'] == 'y' || old('data3_3chk_pregnant') == 'y') checked @endif class="custom-control-input" id="data3_3chk_pregnant">
												<label for="data3_3chk_pregnant" class="custom-control-label normal-label">
													ตั้งครรภ์
												</label>
											</div>
										</td>
									</tr>
									<tr id="risk3_3table_tr11">
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="data3_3chk_fat" value="y" @if ($invest_pt[0]['data3_3chk_fat'] == 'y' || old('data3_3chk_fat') == 'y') checked @endif class="custom-control-input" id="data3_3chk_fat">
												<label for="data3_3chk_fat" class="custom-control-label normal-label">
													อ้วน
												</label>
											</div>
										</td>
									</tr>
									<tr id="risk3_3table_tr12">
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="data3_3chk_cancer" value="y" @if ($invest_pt[0]['data3_3chk_cancer'] == 'y' || old('data3_3chk_cancer') == 'y') checked @endif class="custom-control-input" id="data3_3chk_cancer">
												<label for="data3_3chk_cancer" class="custom-control-label normal-label">
													มะเร็ง
												</label>
												<div class="row mt-2">
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
														<div class="form-group">
															<input type="text" name="data3_3chk_cancer_name" value="{{ old('data3_3chk_cancer_name') ?? $invest_pt[0]['data3_3chk_cancer_name'] }}" class="form-control" placeholder="ประเภทมะเร็ง">
														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>
									<tr id="risk3_3table_tr13">
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="data3_3chk_other" value="y" class="custom-control-input" @if ($invest_pt[0]['data3_3chk_other'] == 'y' || old('data3_3chk_other') == 'y') checked @endif id="data3_3chk_other">
												<label for="data3_3chk_other" class="custom-control-label normal-label">
													อื่นๆ
												</label>
												<div class="row mt-2">
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
														<div class="form-group">
															<input type="text" name="data3_3input_other"  class="form-control" value="{{ old('data3_3input_other') ?? $invest_pt[0]['data3_3input_other'] }}" placeholder="อื่นๆ โปรดระบุ">
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
			</div>
		</div>
	</div>
</div>
