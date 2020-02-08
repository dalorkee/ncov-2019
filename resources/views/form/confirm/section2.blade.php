<div class="card">
	<div class="card-body" style="margin:0;padding-top:10px;padding-bottom:0">
		<h1 class="card-title m-b-0 m-t-0 text-danger">2. ประวัติเสี่ยงต่อการติดเชื้อ</h1>
	</div>
	<ul class="list-style-none">
		<li class="card-body">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="">2.1 ประวัติการได้รับวัคซีนไข้หวัดใหญ่</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control">
								<input type="checkbox" name="fluVaccineChk" value="n" @if ($invest_pt[0]['flu_vaccine_chk'] == 'n') checked @endif class="custom-control-input flu-vaccine-chk" id="fluVaccineChkNo">
								<label for="fluVaccineChkNo" class="custom-control-label normal-label">ไม่เคยได้รับ</label>
							</div>
							<div class="custom-control custom-checkbox custom-control">
								<input type="checkbox" name="fluVaccineChk" value="y" @if ($invest_pt[0]['flu_vaccine_chk'] == 'y') checked @endif class="custom-control-input flu-vaccine-chk" id="fluVaccineChkYes">
								<label for="fluVaccineChkYes" class="custom-control-label normal-label">เคยได้รับ </label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="treatDateInput">เคยได้รับ ครั้งล่าสุดเมื่อ</label>
						<div class="input-group date" data-provide="datepicke" id="flu_vaccine_chk_date">
							<div class="input-group">
								<input type="text" name="flu_vaccine_chk_date" value="{{ $data['flu_vaccine_chk_date'] }}" class="form-control" readonly>
								<div class="input-group-append">
									<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
								</div>
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
						<label for="">2.2 ใส่ท่อช่วยหายใจ</label>
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
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="">2.3 ภาวะแทรกซ้อน</label>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="complicationChk" value="n" @if ($invest_pt[0]['complication_chk'] == 'n') checked @endif class="custom-control-input chk_complication" id="complicationChkYes">
								<label for="complicationChkYes" class="custom-control-label normal-label">ไม่มี</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="complicationChk" value="y" @if ($invest_pt[0]['complication_chk'] == 'y') checked @endif class="custom-control-input chk_complication" id="complicationChkNo">
								<label for="complicationChkNo" class="custom-control-label normal-label">มี (กรุณาทำเครื่องหมายด้านล่าง)</label>
							</div>
						</div>
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
											<input type="checkbox" name="complicationRespiratoryFailure" value="y" @if ($invest_pt[0]['complication_respiratory_failure'] == 'y') checked @endif class="custom-control-input" id="complication_respiratory_failure">
											<label for="complication_respiratory_failure" class="custom-control-label normal-label">
												Respiratory Failure
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr2">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="complicationSepticShock" value="y" @if ($invest_pt[0]['complication_septic_shock'] == 'y') checked @endif class="custom-control-input" id="complication_septic_shock">
											<label for="complication_septic_shock" class="custom-control-label normal-label">
												Septic Shock
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr3">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="complicationLiverFailure" value="y" @if ($invest_pt[0]['complication_liver_failure'] == 'y') checked @endif class="custom-control-input" id="risk3_3CirrhosisChk">
											<label for="complication_liver_failure" class="custom-control-label normal-label">
												Liver Failure
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr4">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="complicationKidneyFailure" value="y" @if ($invest_pt[0]['complication_kidney_failure'] == 'y') checked @endif class="custom-control-input" id="complication_kidney_failure">
											<label for="complication_kidney_failure" class="custom-control-label normal-label">
												Kidney Failure
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr5">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="complicationEncephalitis" value="y" @if ($invest_pt[0]['complication_encephalitis'] == 'y') checked @endif class="custom-control-input" id="complication_encephalitis">
											<label for="complication_encephalitis" class="custom-control-label normal-label">
												Encephalitis
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr6">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="complicationMyocarditis" value="y" @if ($invest_pt[0]['complication_myocarditis'] == 'y') checked @endif class="custom-control-input" id="complication_myocarditis">
											<label for="complication_myocarditis" class="custom-control-label normal-label">
												Myocarditis
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr13">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="complicationOther" value="y" @if ($invest_pt[0]['complication_other'] == 'y') checked @endif class="custom-control-input" id="complication_other">
											<label for="complication_other" class="custom-control-label normal-label">
												อื่นๆ โปรดระบุ
											</label>
											<div class="row mt-2">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
													<div class="form-group">
														<input type="text" name="complicationOtherDetail" value="{{ $invest_pt[0]['complication_other_detail'] }}" class="form-control" placeholder="อื่นๆ โปรดระบุ">
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
		<li class="card-body border-top">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="">2.4 การรักษา ได้รับย้าต้านไวรัส</label>
					<div class="card">
						<div class="custom-control custom-checkbox custom-control">
							<input type="checkbox" name="antiVirusChk" value="n" @if ($invest_pt[0]['antivirus_chk'] == 'n') checked @endif class="custom-control-input chk_antivirus" id="antiVirusChkNo">
							<label for="antiVirusChkNo" class="custom-control-label normal-label">ไม่ได้รับ</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="antiVirusChk" value="y" @if ($invest_pt[0]['antivirus_chk'] == 'y') checked @endif class="custom-control-input chk_antivirus" id="antiVirusChkYes">
							<label for="antiVirusChkYes" class="custom-control-label normal-label">ได้รับ</label>
						</div>
						<div class="card" style="margin-bottom:0;padding-bottom:0">
							<ul class="list-style-none">
								<li class="card-body" style="margin:0;padding:10px 0;">
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
											<div class="form-group">
												<label for="date">ระบุชื่อยา</label>
												<div class="input-group">
													<input type="text" name="antivirus1Name" value="{{ $invest_pt[0]['antivirus_1_name'] }}" class="form-control">
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
											<div class="form-group">
												<label for="date">ขนาดที่ได้รับ</label>
												<div class="input-group">
													<input type="text" name="antivirus1Dose" value="{{ $invest_pt[0]['antivirus_1_dose'] }}" class="form-control">
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3" >
											<div class="form-group">
												<label for="date">วันที่ให้ยา</label>
												<div class="input-group date" data-provide="datepicker" id="antivirus_1_start_date">
													<input  type="text" name="antivirus1StartDate" value="{{ $data['antivirus_1_start_date'] }}" class="form-control" readonly>
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
											<div class="form-group">
												<label for="date">วันที่หยุดให้ยา</label>
												<div class="input-group date" data-provide="datepicker" id="antivirus_1_end_date">
													<input  type="text" name="antivirus1EndDate" value="{{ $data['antivirus_1_end_date'] }}" class="form-control" readonly>
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</li>

								<li class="card-body border-top" style="margin:0;padding:10px 0;">
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
											<div class="form-group">
												<label for="date">ระบุชื่อยา</label>
												<div class="input-group">
													<input type="text" name="antivirus2Name" value="{{ $invest_pt[0]['antivirus_2_name'] }}" class="form-control">
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
											<div class="form-group">
												<label for="date">ขนาดที่ได้รับ</label>
												<div class="input-group">
													<input type="text" name="antivirus2Dose" value="{{ $invest_pt[0]['antivirus_2_dose'] }}" class="form-control">
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3" >
											<div class="form-group">
												<label for="date">วันที่ให้ยา</label>
												<div class="input-group date" data-provide="datepicker" id="antivirus_2_start_date">
													<input  type="text" name="antivirus2StartDate" value="{{ $data['antivirus_2_start_date'] }}" class="form-control" readonly>
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
											<div class="form-group">
												<label for="date">วันที่หยุดให้ยา</label>
												<div class="input-group date" data-provide="datepicker" id="antivirus_2_end_date">
													<input  type="text" name="antivirus2EndDate" value="{{ $data['antivirus_2_end_date'] }}" class="form-control" readonly>
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</li>

								<li class="card-body border-top" style="margin:0;padding:10px 0;">
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
											<div class="form-group">
												<label for="date">ระบุชื่อยา</label>
												<div class="input-group">
													<input type="text" name="antivirus3Name" value="{{ $invest_pt[0]['antivirus_3_name'] }}" class="form-control">
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
											<div class="form-group">
												<label for="date">ขนาดที่ได้รับ</label>
												<div class="input-group">
													<input type="text" name="antivirus3Dose" value="{{ $invest_pt[0]['antivirus_3_dose'] }}" class="form-control">
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3" >
											<div class="form-group">
												<label for="date">วันที่ให้ยา</label>
												<div class="input-group date" data-provide="datepicker" id="antivirus_3_start_date">
													<input  type="text" name="antivirus3StartDate" value="{{ $data['antivirus_3_start_date'] }}" class="form-control" readonly>
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
											<div class="form-group">
												<label for="date">วันที่หยุดให้ยา</label>
												<div class="input-group date" data-provide="datepicker" id="antivirus_3_end_date">
													<input  type="text" name="antivirus3EndDate" value="{{ $data['antivirus_3_end_date'] }}" class="form-control" readonly>
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</li>

								<li class="card-body border-top" style="margin:0;padding:10px 0;">
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
											<div class="form-group">
												<label for="date">ระบุชื่อยา</label>
												<div class="input-group">
													<input type="text" name="antivirus4Name" value="{{ $invest_pt[0]['antivirus_4_name'] }}" class="form-control">
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
											<div class="form-group">
												<label for="date">ขนาดที่ได้รับ</label>
												<div class="input-group">
													<input type="text" name="antivirus4Dose" value="{{ $invest_pt[0]['antivirus_4_dose'] }}" class="form-control">
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3" >
											<div class="form-group">
												<label for="date">วันที่ให้ยา</label>
												<div class="input-group date" data-provide="datepicker" id="antivirus_4_start_date">
													<input  type="text" name="antivirus4StartDate" value="{{ $data['antivirus_4_start_date'] }}" class="form-control" readonly>
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
											<div class="form-group">
												<label for="date">วันที่หยุดให้ยา</label>
												<div class="input-group date" data-provide="datepicker" id="antivirus_4_end_date">
													<input  type="text" name="antivirus4EndDate" value="{{ $data['antivirus_4_end_date'] }}" class="form-control" readonly>
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</li>


							</ul>
						</div>
					</div>
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
					<label for="risk">2.5 ในช่วง 14 วันก่อนป่วย ท่านอาศัยอยู่ หรือ มีการเดินทางมาจากพื้นที่ที่มีการระบาด</label>
					<div class="card">
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="riskStayOutbreakChk" value="y" @if ($invest_pt[0]['risk_stay_outbreak_chk'] == 'y') checked @endif class="custom-control-input chk_risk_stay_outbreak" id="riskStayOutbreakChkYes">
							<label for="riskStayOutbreakChkYes" class="custom-control-label normal-label">มี ระบุรายละเอียดดังต่อไปนี้</label>
						</div>
					</div>
					<div class="card" style="margin-bottom:0;padding-bottom:0">
						<div class="form-row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
								<div class="form-group">
									<label for="outbreakCountry" class="tex-danger">ประเทศ</label>
									<select name="riskStayOutbreakCountryInput" class="form-control selectpicker show-tick" data-live-search="true" id="risk_stay_outbreak_country">
										@if (!empty($invest_pt[0]['risk_stay_outbreak_country']))
											<option value="{{ $invest_pt[0]['risk_stay_outbreak_country'] }}" selected="selected">{{ $globalCountry[$invest_pt[0]['risk_stay_outbreak_country']]['country_name'] }}</option>
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
									<select name="riskStayOutbreakCityInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-success" id="select_risk_stay_outbreak_city">
										@if (!empty($invest_pt[0]['risk_stay_outbreak_city']))
											<option value="{{ $sick_city[0]['risk_stay_outbreak_city'] }}" selected="selected">{{ $sick_city[0]['risk_stay_outbreak_city'] }}</option>
										@endif
										<option value="">-- โปรดเลือก --</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
								<div class="form-group">
									<label for="city_other" class="text-danger">เมืองอื่นๆ ระบุ</label>
									<input type="text" name="riskStayOutbreakCityOtherInput" value="{{ $invest_pt[0]['risk_stay_outbreak_city_other'] }}" class="form-control border-danger text-danger" placeholder="เมืองอื่นๆ">
								</div>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
								<div class="form-group">
									<label for="province">จังหวัด</label>
									<select name="riskStayOutbreakProvinceInput" class="form-control selectpicker show-tick" data-live-search="true" id="risk_stay_outbreak_province">
										@if (!empty($invest_pt[0]['risk_stay_outbreak_province']))
											<option value="{{ $invest_pt[0]['risk_stay_outbreak_province'] }}" selected="selected">{{ $provinces[$invest_pt[0]['risk_stay_outbreak_province']]['province_name'] }}</option>
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
									<label for="district">อำเภอx</label>
									<select name="riskStayOutbreakDistrictInput" class="form-control selectpicker show-tick" data-live-search="true" id="risk_stay_outbreak_district">
										@if (!empty($invest_pt[0]['risk_stay_outbreak_district']))
											<option value="{{ $risk_district[0]['district_id'] }}" selected="selected">{{ $risk_district[0]['district_name'] }}</option>
										@endif
										<option value="">-- โปรดเลือก --</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
								<div class="form-group">
									<label for="subDistrict">ตำบล</label>
									<select name="riskStayOutbreakSubDistrictInput" class="form-control selectpicker show-tick" data-live-search="true" id="risk_stay_outbreak_sub_district">
										@if (!empty($invest_pt[0]['risk_stay_outbreak_sub_district']))
											<option value="{{ $risk_sub_district[0]['sub_district_id'] }}" selected="selected">{{ $risk_sub_district[0]['sub_district_name'] }}</option>
										@endif
										<option value="">-- โปรดเลือก --</option>
									</select>
								</div>
							</div>
						</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
										<div class="form-group">
											<label for="city">ชื่อเมือง (กรณีอยู่ต่างประเทศ)</label>
											<input type="text" name="riskStayOutbreakCityInput" value="{{ $invest_pt[0]['risk_stay_outbreak_city'] }}" class="form-control" placeholder="ชื่อเมือง">
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
										<div class="form-group">
											<label for="date">วันที่เดินทางไปถึง</label>
											<div class="input-group date" data-provide="datepicker" id="riskStayOutbreakArriveDate">
												<input  type="text" name="riskStayOutbreakArriveDate" value="{{ $data['risk_stay_outbreak_arrive_date'] }}" class="form-control" readonly>
												<div class="input-group-append">
													<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
										<div class="form-group">
											<label for="date">วันที่เดินทางมาถึงไทย</label>
											<div class="input-group date" data-provide="datepicker" id="riskStayOutbreakArriveThaiDate">
												<input  type="text" name="riskStayOutbreakArriveThaiDate" value="{{ $data['risk_stay_outbreak_arrive_thai_date'] }}" class="form-control" readonly>
												<div class="input-group-append">
													<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
										<div class="form-group">
											<label for="contact">สายการบิน</label>
											<input type="text" name="riskStayOutbreakAirline" value="{{ $invest_pt[0]['risk_stay_outbreak_airline'] }}" class="form-control" placeholder="สายการบิน">
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
										<div class="form-group">
											<label for="contact">เที่ยวบินที่</label>
											<input type="text" name="riskStayOutbreakFlightNoInput" value="{{ $invest_pt[0]['risk_stay_outbreak_flight_no'] }}" class="form-control" placeholder="เที่ยวบินที่">
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
										<div class="form-group">
											<label for="contact">เลขที่นั่ง</label>
											<input type="text" name="riskStayOutbreakSeatNoInput" value="{{ $invest_pt[0]['risk_stay_outbreak_seat_no'] }}" class="form-control" placeholder="เลขที่นั่ง">
										</div>
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
						<label for="risk">2.6 ในช่วง 14 วันก่อนป่วย ท่านมีประวัติสัมผัสกับบุคคลที่มาจากพื้นที่ระบาดเช่น ประเทศจีน โปรดระบุรายละเอียดของผู้ที่ท่านมีประวัติสัมผัส</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="riskHistoryHumanContact" value="y" @if ($invest_pt[0]['risk_history_human_contact'] == 'y') checked @endif class="custom-control-input risk_history_human_contact" id="risk_history_human_contact">
								<label for="risk_history_human_contact" class="custom-control-label normal-label">มี ระบุรายละเอียด</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="contact">ลักษณะการสัมผัส</label>
						<input type="text" name="riskHistoryHumanContactDetail" value="{{ $invest_pt[0]['risk_history_human_contact_detail'] }}" class="form-control" placeholder="ลักษณะการสัมผัส">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="contact">ช่วงระยะเวลาที่มีการสัมผัส</label>
						<input type="text" name="riskHistoryHumanContactDuration" value="{{ $invest_pt[0]['risk_history_human_contact_duration'] }}" class="form-control" placeholder="ช่วงเวลาที่สัมผัส">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="risk">บุคคลดังกล่าวมีอาการผิดปกติทางระบบทางเดินหายใจ เช่น ไอ จาม หรือไม่</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="riskHistoryHumanContactSymptom" value="n" @if ($invest_pt[0]['risk_history_human_contact_symptom'] == 'n') checked @endif class="custom-control-input risk_history_human_contact_symptom" id="risk_history_human_contact_symptom_no">
								<label for="risk_history_human_contact_symptom_no" class="custom-control-label normal-label">ไม่มี</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="riskHistoryHumanContactSymptom" value="y" @if ($invest_pt[0]['risk_history_human_contact_symptom'] == 'y') checked @endif class="custom-control-input risk_history_human_contact_symptom" id="risk_history_human_contact_symptom_yes">
								<label for="risk_history_human_contact_symptom_yes" class="custom-control-label normal-label">มี ระบุอาการ</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="contact">ระบุอาการ</label>
						<input type="text" name="riskHistoryHumanContactSymptomDetail" value="{{ $invest_pt[0]['risk_history_human_contact_symptom_detail'] }}" class="form-control" placeholder="อาการ">
					</div>
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="risk">2.7 ในช่วง 14 วันก่อนป่วย ท่านได้รับประทานหรือปรุงอาหารที่ประกอบด้วยสัตว์ป่า เช่น งูหรือค้างคาวหรือไม่</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="riskEatCookAnimal" value="y" @if ($invest_pt[0]['risk_eat_cook_animal'] == 'y') checked @endif class="custom-control-input risk_eat_cook_animal" id="risk_eat_cook_animal">
								<label for="risk_eat_cook_animal" class="custom-control-label normal-label">มี ระบุรายละเอียด</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="contact">ชนิดสัตว์และลักษณะการสัมผัส</label>
						<input type="text" name="riskEatCookAnimalType" value="{{ $invest_pt[0]['risk_eat_cook_animal_type'] }}" class="form-control" placeholder="ชนิดสัตว์และลักษณะการสัมผัส">
					</div>
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="risk">2.8 ในช่วง 14 วันก่อนป่วย ท่านได้มีการสัมผัสสัตว์ปีก โดยการจับ ชำแหละ ฝังกลบ หรือรับประทานสุกๆ ดิบๆ เป็นต้น</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="riskContactPoultry" value="y" @if ($invest_pt[0]['risk_contact_poultry'] == 'y') checked @endif class="custom-control-input risk_contact_poultry" id="risk_contact_poultry">
								<label for="risk_contact_poultry" class="custom-control-label normal-label">มี ระบุรายละเอียด</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="contact">ระบุลักษณะการสัมผัส</label>
						<input type="text" name="riskContactPoultryDetail" value="{{ $invest_pt[0]['risk_contact_poultry_detail'] }}" class="form-control" placeholder="ลักษณะการสัมผัส">
					</div>
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="risk">2.9 ในช่วง 14 วันก่อนป่วย ท่านพักอาศัยในพื้นที่ที่มีสัตว์ปีกป่วยตายมากผิดปกติ หรือพบเชื้อในสัตว์ปีกหรือสิ่งแวดล้อม</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="riskPoultryDead" value="y" @if ($invest_pt[0]['risk_poultry_dead'] == 'y') checked @endif class="custom-control-input risk_poultry_dead" id="risk_poultry_dead">
								<label for="risk_poultry_dead" class="custom-control-label normal-label">ใช่</label>
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
						<label for="risk">2.10 ในช่วง 14 วันก่อนป่วย ไปตลาดสดที่มีการค้าสัตว์ปีก/สัตว์ป่า/สัตว์เลี้ยงลูกด้วยนม/อาหารทะเล ในเมืองอู่ฮั่น (Wuhan) มณฑลหูเป่ย (Hubei) ประเทศจีน</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="riskPoultryMarket" value="y" @if ($invest_pt[0]['risk_poultry_market'] == 'y') checked @endif class="custom-control-input risk_poultry_market" id="risk_poultry_market">
								<label for="risk_poultry_market" class="custom-control-label normal-label">มี ระบุชื่อตลาดและชนิดสัตว์</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="contact">ชื่อตลาด</label>
						<input type="text" name="riskPoultryMarketName" value="{{ $invest_pt[0]['risk_poultry_market_name'] }}" class="form-control" placeholder="ชื่อตลาด">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="contact">ชนิดสัตว์</label>
						<input type="text" name="riskPoultryAnimalName" value="{{ $invest_pt[0]['risk_poultry_animal_name'] }}" class="form-control" placeholder="ชนิดสัตว์">
					</div>
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="risk">2.11 ในช่วง 14 วันก่อนป่วย ไปตลาดสดที่มีการค้าสัตว์ปีก/สัตว์ป่า/สัตว์เลี้ยงลูกด้วยนม/อาหารทะเล นอกเหนือจากข้อ 2.10</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="riskPoultryMarketII" value="y" @if ($invest_pt[0]['risk_poultry_market_ii'] == 'y') checked @endif class="custom-control-input risk_poultry_market_ii" id="risk_poultry_market_ii">
								<label for="risk_poultry_market_ii" class="custom-control-label normal-label">มี ระบุชื่อตลาดและชนิดสัตว์</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="contact">ชื่อตลาด</label>
						<input type="text" name="riskPoultryMarketNameII" value="{{ $invest_pt[0]['risk_poultry_market_name_ii'] }}" class="form-control" placeholder="ชื่อตลาด">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="contact">ชนิดสัตว์</label>
						<input type="text" name="riskPoultryAnimalNameII" value="{{ $invest_pt[0]['risk_poultry1_animal_name_ii'] }}" class="form-control" placeholder="ชนิดสัตว์">
					</div>
				</div>
			</div>
		</li>


		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="risk">2.12 ท่านมีประวัติเข้ารับการรักษาหรือเยี่ยมผู้ป่วยในโรงพยาบาลขณะอยู่ที่ประเทศดังกล่าวหรือไม่</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="riskTreatOrVisitPatient" value="y" @if ($invest_pt[0]['risk_treat_or_visit_patient'] == 'y') checked @endif class="custom-control-input risk_treat_or_visit_patient" id="risk_treat_or_visit_patient">
								<label for="risk_treat_or_visit_patient" class="custom-control-label normal-label">ใช่</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="date">ระบุวันที่เข้าโรงพยาบาล</label>
							<div class="input-group date" data-provide="datepicker" id="risk_treat_or_visit_patient_hospital_date">
								<input  type="text" name="riskTreatOrVisitPatientHospitalDate" value="{{ $data['risk_treat_or_visit_patient_hospital_date'] }}" class="form-control" readonly>
								<div class="input-group-append">
									<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
								</div>
							</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="contact">ชื่อโรงพยาบาล</label>
						<input type="text" name="riskTreatOrVisitPatientHospitalName" value="{{ $invest_pt[0]['risk_treat_or_visit_patient_hospital_name'] }}" class="form-control" placeholder="ชนิดสัตว์">
					</div>
				</div>
			</div>
		</li>

		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="risk">2.13 ในช่วง 14 วันก่อนป่วย ท่านให้การดูแลหรือสัมผัสใกล้ชิดกับผู้ป่วยอาการคล้ายไข้หวัดใหญ่/ปอดอักเสบหรือไม่</label>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="riskCareFluPatient" value="n" @if ($invest_pt[0]['risk_care_flu_patient'] == 'y') checked @endif class="custom-control-input risk_care_flu_patient" id="risk_care_flu_patient">
								<label for="risk_care_flu_patient" class="custom-control-label normal-label">ใช่</label>
							</div>
							<div class="card" style="margin-bottom:0;padding-bottom:0">
								<ul class="list-style-none">
									<li class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
												<div class="form-group">
													<label for="">ระบุความสัมพันธ์</label>
													<input type="text" name="riskCareFluPatientRelation" value="{{ $invest_pt[0]['risk_care_flu_patient_relation'] }}" class="form-control" placeholder="ความสัมพันธ์">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
												<div class="form-group">
													<label for="contact">ระบุชื่อ (หากสามารถระบุได้)</label>
													<input type="text" name="riskCareFluPatientRelationName" value="{{ $invest_pt[0]['risk_care_flu_patient_relation_name'] }}" class="form-control" placeholder="ระบุชื่อ">
												</div>
											</div>
										</div>
									</li>
								</ul>
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
						<label for="">2.14 ในช่วง 14 วันก่อนป่วย ท่านมีประวัติสัมผัสผู้ป่วยปอดอักเสบรุนแรงหรือเสียชีวิตที่หาสาเหตุไม่ได้</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control">
								<input type="checkbox" name="riskPatientPneumoniaDead" value="y" @if ($invest_pt[0]['risk_patient_pneumonia_dead'] == 'y') checked @endif class="custom-control-input risk_patient_pneumonia_dead" id="risk_patient_pneumonia_dead_yes">
								<label for="risk_patient_pneumonia_dead_yes" class="custom-control-label normal-label">ใช่</label>
							</div>
							<div class="custom-control custom-checkbox custom-control">
								<input type="checkbox" name="riskPatientPneumoniaDead" value="n" @if ($invest_pt[0]['risk_patient_pneumonia_dead'] == 'n') checked @endif class="custom-control-input risk_patient_pneumonia_dead" id="risk_patient_pneumonia_dead_no">
								<label for="risk_patient_pneumonia_dead_no" class="custom-control-label normal-label">ไม่ใช่</label>
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
						<label for="">2.15 ในช่วง 14 วันก่อนป่วย ท่านมีบุคคลใกล้ชิดป่วยอาการคล้ายไข้หวัดใหญ่ หรือมีการระบาดของปอดอักเสบในชุมชน</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control">
								<input type="checkbox" name="riskCloseupFluOrPneumonia" value="y" @if ($invest_pt[0]['risk_closeup_flu_or_pneumonia'] == 'y') checked @endif class="custom-control-input risk_closeup_flu_or_pneumonia" id="risk_closeup_flu_or_pneumonia_yes">
								<label for="risk_closeup_flu_or_pneumonia_yes" class="custom-control-label normal-label">ใช่</label>
							</div>
							<div class="custom-control custom-checkbox custom-control">
								<input type="checkbox" name="riskCloseupFluOrPneumonia" value="n" @if ($invest_pt[0]['risk_closeup_flu_or_pneumonia'] == 'n') checked @endif class="custom-control-input risk_closeup_flu_or_pneumonia" id="risk_closeup_flu_or_pneumonia_no">
								<label for="risk_closeup_flu_or_pneumonia_no" class="custom-control-label normal-label">ไม่ใช่</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</li>














	</ul>
</div><!-- card2 -->
