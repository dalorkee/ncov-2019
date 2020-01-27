<div class="card">
	<div class="card-body" style="margin:0;padding-top:10px;padding-bottom:0">
		<h1 class="card-title m-b-0 m-t-0 text-warning">3. ข้อมูลการเจ็บป่วย</h1>
	</div>
	<ul class="list-style-none">
		<li class="card-body">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<div class="form-group">
						<label for="sickDateInput">3.1 วันที่เริ่มป่วย</label>
						<div class="input-group date" data-provide="datepicke" id="risk3_1sickDateInput">
							<div class="input-group">
								<input type="text" name="risk3_1sickDateInput" value="{{ old('risk3_1sickDateInput') }}" class="form-control" readonly>
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
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="">3.2 สถานที่รักษาครั้งแรก</label>
						<input type="text" name="risk3_2firstTreatInput" value="{{ old('risk3_2firstTreatInput') }}" class="form-control" placeholder="สถานที่รักษา">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<div class="form-group">
						<label for="treatDateInput">วันที่รักษาครั้งแรก</label>
						<div class="input-group date" data-provide="datepicke" id="risk3_2treatDateInput">
							<div class="input-group">
								<input type="text" name="risk3_2treatDateInput" value="{{ old('risk3_2treatDateInput') }}" class="form-control" readonly>
								<div class="input-group-append">
									<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="">เป็น</label>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk3_2patientTypeChk" value="opd" class="custom-control-input chk_risk3_2_pt" id="risk3_2patientTypeChkOpd">
								<label for="risk3_2patientTypeChkOpd" class="custom-control-label normal-label">ผู้ป่วยนอก</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk3_2patientTypeChk" value="ipd" class="custom-control-input chk_risk3_2_pt" id="risk3_2patientTypeChkIpd">
								<label for="risk3_2patientTypeChkIpd" class="custom-control-label normal-label">ผู้ป่วยใน</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="">สถานที่ Admit</label>
						<input type="text" name="risk3_2admitPlaceInput" value="{{ old('risk3_admitInput') }}" class="form-control" placeholder="สถานที่ Admit">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<div class="form-group">
						<label for="treatDateInput">วันที่ Admit</label>
						<div class="input-group date" data-provide="datepicke" id="risk3_2admitDateInput">
							<div class="input-group">
								<input type="text" name="risk3_2admitDateInput" value="{{ old('risk3_admitDateInput') }}" class="form-control" readonly>
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
						<label for="">3.3 ประวัติการเจ็บป่วยในอดีตหรือโรคประจำตัว</label>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk3_3Chk" value="n" class="custom-control-input chk_risk3_3" id="risk3_3ChkNo">
								<label for="risk3_3ChkNo" class="custom-control-label normal-label">ไม่มี</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk3_3Chk" value="y" class="custom-control-input chk_risk3_3" id="risk3_3ChkYes">
								<label for="risk3_3ChkYes" class="custom-control-label normal-label">มี (กรุณาทำเครื่องหมายด้านล่าง)</label>
							</div>
						</div>
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
											<input type="checkbox" name="risk3_3LungChk" value="y" class="custom-control-input" id="risk3_3LungChk">
											<label for="risk3_3LungChk" class="custom-control-label normal-label">
												โรคปอดเรื้อรัง เช่น COPD, chronic bronchitis, chronic bronchiectasis, BPD, หรือหอบ (asthma) ที่กำลังรักษา
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr2">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="risk3_3HeartChk" value="y" class="custom-control-input" id="risk3_3HeartChk">
											<label for="risk3_3HeartChk" class="custom-control-label normal-label">
												โรคหัวใจ เช่น หัวใจพิการแต่กำเนิด, โรคหลอดเลือดหัวใจ หรือ Congestive heart failure
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr3">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="risk3_3CirrhosisChk" value="y" class="custom-control-input" id="risk3_3CirrhosisChk">
											<label for="risk3_3CirrhosisChk" class="custom-control-label normal-label">
												โรคตับเรื้อรัง เช่น ตับแข็ง (Cirrhosis)
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr4">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="risk3_3KidneyChk" value="y" class="custom-control-input" id="risk3_3KidneyChk">
											<label for="risk3_3KidneyChk" class="custom-control-label normal-label">
												โรคไต, ไตวาย
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr5">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="risk3_3DiabetesChk" value="y" class="custom-control-input" id="risk3_3DiabetesChk">
											<label for="risk3_3DiabetesChk" class="custom-control-label normal-label">
												เบาหวาน
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr6">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="risk3_3BloodChk" value="y" class="custom-control-input" id="risk3_3BloodChk">
											<label for="risk3_3BloodChk" class="custom-control-label normal-label">
												ความดันโลหิตสูง
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr7">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="risk3_3ImmuneChk" value="y" class="custom-control-input" id="risk3_3ImmuneChk">
											<label for="risk3_3ImmuneChk" class="custom-control-label normal-label">
												ภูมิคุ้มกันบกพร่อง
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr8">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="risk3_3AnaemiaChk" value="y" class="custom-control-input" id="risk3_3AnaemiaChk">
											<label for="risk3_3AnaemiaChk" class="custom-control-label normal-label">
												โลหิตจาง (ธาลัสซีเมีย, sickle cell anemia)
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr9">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="risk3_3CerebralChk" value="y" class="custom-control-input" id="risk3_3CerebralChk">
											<label for="risk3_3CerebralChk" class="custom-control-label normal-label">
												พิการทางสมอง ช่วยเหลือตัวเองไม่ได้
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr10">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="risk3_3PregnantChk" value="y" class="custom-control-input" id="risk3_3PregnantChk">
											<label for="risk3_3PregnantChk" class="custom-control-label normal-label">
												ตั้งครรภ์
											</label>
											<div class="row mt-2">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
													<div class="form-group">
														<input type="text" name="risk3_3PregnanWeekInput" value="{{ old('risk3_3PregnanWeekInput') }}" class="form-control" placeholder="อายุครรภ์">
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr11">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="risk3_3FatChk" value="y" class="custom-control-input" id="risk3_3FatChk">
											<label for="risk3_3FatChk" class="custom-control-label normal-label">
												อ้วน
											</label>
											<div class="row mt-2">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
													<div class="form-group">
														<input type="text" name="risk3_3FatHeightInput" value="{{ old('risk3_3FatHeightInput') }}" class="form-control" placeholder="ส่วนสูง">
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
													<div class="form-group">
														<input type="text" name="risk3_3FatWeightInput" value="{{ old('risk3_3FatWeightInput') }}" class="form-control" placeholder="น้ำหนัก">
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
													<div class="form-group">
														<input type="text" name="risk3_3FatBmiInput" value="{{ old('risk3_3FatBmiInput') }}" class="form-control" placeholder="BMI">
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr12">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="risk3_3CancerChk" value="y" class="custom-control-input" id="risk3_3CancerChk">
											<label for="risk3_3CancerChk" class="custom-control-label normal-label">
												มะเร็งที่กำลังรักษา ระบุประเภท
											</label>
											<div class="row mt-2">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
													<div class="form-group">
														<input type="text" name="risk3_3CancerInput" value="{{ old('risk3_3CancerInput') }}" class="form-control" placeholder="ประเภทมะเร็ง">
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr13">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="risk3_3OtherChk" value="y" class="custom-control-input" id="risk3_3OtherChk">
											<label for="risk3_3OtherChk" class="custom-control-label normal-label">
												อื่นๆ
											</label>
											<div class="row mt-2">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
													<div class="form-group">
														<input type="text" name="risk3_3OtherInput" value="{{ old('risk3_3OtherInput') }}" class="form-control" placeholder="อื่นๆ โปรดระบุ">
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
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="">ประวัติการสูบบุหรี่</label>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk3_3SmokingHistoryChk" value="n" class="custom-control-input chk_risk3_3_smoking" id="risk3_3SmokingHistoryChkNo">
								<label for="risk3_3SmokingHistoryChkNo" class="custom-control-label normal-label">ไม่สูบ</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk3_3SmokingHistoryChk" value="y" class="custom-control-input chk_risk3_3_smoking" id="risk3_3SmokingHistoryChkYes">
								<label for="risk3_3SmokingHistoryChkYes" class="custom-control-label normal-label">สูบ  (ถ้าสูบ กรุณาทำเครื่องหมายด้านล่าง)</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
					<div class="table-responsive">
						<table class="table">
							</thead></thead>
							<tfoot></tfoot>
							<tbody>
								<tr id="risk3_3table2_tr1">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="risk3_3SmokingChkYes" value="y" class="custom-control-input" id="risk3_3SmokingChkYes">
											<label for="risk3_3SmokingChkYes" class="custom-control-label normal-label">
												ยังสูบ ปริมาณ
											</label>
											<div class="row mt-2">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
													<div class="form-group">
														<input type="text" name="risk3_3SmokingChkYesInput" value="{{ old('risk3_3SmokingChkYesInput') }}" class="form-control" placeholder="มวน/ซอง ต่อ วัน/สัปดาห์">
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table2_tr2">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="risk3_3SmokingChkNo" value="y" class="custom-control-input" id="risk3_3SmokingChkNo">
											<label for="risk3_3SmokingChkNo" class="custom-control-label normal-label">
												หยุดสูบ สูบมานาน
											</label>
											<div class="row mt-2">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
													<div class="form-group">
														<input type="text" name="risk3_3SmokingChkNoInput" value="{{ old('risk3_3SmokingChkNoInput') }}" class="form-control" placeholder="สูบมานาน">
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
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="">ประวัติการดื่มสุรา</label>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk3_3DrinkHistoryChk" value="n" class="custom-control-input chk_risk3_3_drink" id="risk3_3DrinkHistoryChkNo">
								<label for="risk3_3DrinkHistoryChkNo" class="custom-control-label normal-label">ไม่ดื่ม</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk3_3DrinkHistoryChk" value="y" class="custom-control-input chk_risk3_3_drink" id="risk3_3DrinkHistoryYes">
								<label for="risk3_3DrinkHistoryYes" class="custom-control-label normal-label">ดื่ม  (ถ้าดื่ม กรุณาทำเครื่องหมายด้านล่าง)</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
					<div class="table-responsive">
						<table class="table">
							</thead></thead>
							<tfoot></tfoot>
							<tbody>
								<tr id="risk3_3table3_tr1">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="risk3_3DrinkChkYes" value="y" class="custom-control-input" id="risk3_3DrinkChkYes">
											<label for="risk3_3DrinkChkYes" class="custom-control-label normal-label">
												ยังดื่ม ปริมาณ
											</label>
											<div class="row mt-2">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
													<div class="form-group">
														<input type="text" name="risk3_3DrinkChkYesInput" value="{{ old('risk3_3DrinkChkYesInput') }}" class="form-control" placeholder="ต่อ วัน/สัปดาห์">
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table3_tr2">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="risk3_3DrinkChkNo" value="y" class="custom-control-input" id="risk3_3DrinkChkNo">
											<label for="risk3_3DrinkChkNo" class="custom-control-label normal-label">
												หยุดดื่ม ดื่มมานาน
											</label>
											<div class="row mt-2">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
													<div class="form-group">
														<input type="text" name="risk3_3DrinkChkNoInput" value="{{ old('risk3_3DrinkChkNoInput') }}" class="form-control" placeholder="ดื่มมานาน">
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
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="">3.4 ประวัติการได้รับวัคซีนไข้หวัดใหญ่</label>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk3_4influVaccineChk" value="n" class="custom-control-input chk_risk3_4" id="risk3_4influVaccineChkNo">
								<label for="risk3_4influVaccineChkNo" class="custom-control-label normal-label">ไม่เคยได้รับ</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk3_4influVaccineChk" value="y" class="custom-control-input chk_risk3_4" id="risk3_4influVaccineChkYes">
								<label for="risk3_4influVaccineChkYes" class="custom-control-label normal-label">เคยได้รับ </label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<div class="form-group">
						<label for="treatDateInput">เคยได้รับ ครั้งล่าสุดเมื่อ</label>
						<div class="input-group date" data-provide="datepicke" id="risk3_4influVaccineChkYesInput">
							<div class="input-group">
								<input type="text" name="risk3_4influVaccineChkYesInput" value="{{ old('risk3_4influVaccineChkYesInput') }}" class="form-control" readonly>
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
						<label for="">3.5 อาการสำคัญที่ทำให้มาโรงพยาบาล</label>
						<input type="text" name="risk3_5SymptomInput" value="{{ old('risk3_5SymptomInput') }}" class="form-control" placeholder="อาการสำคัญ">
					</div>
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="">3.6 อาการผู้ป่วยตั้งแต่วันเริ่มป่วยจนถึงวันสอบสวน</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
								<div class="form-group">
									<label for="sickDateInput">วันที่เริ่มป่วย</label>
									<div class="input-group date" data-provide="datepicke" id="data3_6sickDate">
										<div class="input-group">
											<input type="text" name="data3_6sickDate" value="{{ old('data3_6sickDate') }}" class="form-control" readonly>
											<div class="input-group-append">
												<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
								<div class="form-group">
									<label for="sickDateInput">อุณหภูมิร่างกาย (Temp C&#176;)</label>
									<div class="input-group">
										<input type="text" name="data3_6TempInput" value="{{ old('data3_6TempInput') }}" class="form-control">
										<div class="input-group-append">
											<span class="input-group-text">C&#176;</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<label for="sickDateInput">วันที่หลังวันเริ่มป่วย</label>
								<div class="table-responsive">
									<table class="table table-striped table-bordered" id="symptoms_table">
										<thead class="bg-custom-1 text-light">
											<tr>
												<th scope="col">อาการ</th>
												<th scope="col">#</th>
												<!--
												<th scope="col">1</th>
												<th scope="col">2</th>
												<th scope="col">3</th>
												<th scope="col">4</th>
												<th scope="col">5</th>
												<th scope="col">6</th>
												-->
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>ไข้ (ระบุ Temp C&#176;)</td>
												@for ($i=0; $i<1; $i++)
												<td>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}FeverChk" value="y" class="custom-control-input chk_data3_6_{{$i}}Fever" id="data3_6_{{$i}}FeverChkYes">
														<label for="data3_6_{{$i}}FeverChkYes" class="custom-control-label normal-label">มี</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}FeverChk" value="n" class="custom-control-input chk_data3_6_{{$i}}Fever" id="data3_6_{{$i}}FeverChkNo">
														<label for="data3_6_{{$i}}FeverChkNo" class="custom-control-label normal-label">ไม่มี</label>
													</div>
												</td>
												@endfor
											</tr>
											<tr>
												<td>ไอ</td>
												@for ($i=0; $i<1; $i++)
												<td>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}CoughChk" value="y" class="custom-control-input chk_data3_6_{{$i}}Cough" id="data3_6_{{$i}}CoughChkYes">
														<label for="data3_6_{{$i}}CoughChkYes" class="custom-control-label normal-label">มี</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}CoughChk" value="n" class="custom-control-input chk_data3_6_{{$i}}Cough" id="data3_6_{{$i}}CoughChkNo">
														<label for="data3_6_{{$i}}CoughChkNo" class="custom-control-label normal-label">ไม่มี</label>
													</div>
												</td>
												@endfor
											</tr>
											<tr>
												<td>เจ็บคอ</td>
												@for ($i=0; $i<1; $i++)
												<td>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}SoreChk" value="y" class="custom-control-input chk_data3_6_{{$i}}Sore" id="data3_6_{{$i}}SoreChkYes">
														<label for="data3_6_{{$i}}SoreChkYes" class="custom-control-label normal-label">มี</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}SoreChk" value="n" class="custom-control-input chk_data3_6_{{$i}}Sore" id="data3_6_{{$i}}SoreChkNo">
														<label for="data3_6_{{$i}}SoreChkNo" class="custom-control-label normal-label">ไม่มี</label>
													</div>
												</td>
												@endfor
											</tr>
											<tr>
												<td>มีน้ำมูก</td>
												@for ($i=0; $i<1; $i++)
												<td>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}SnotChk" value="y" class="custom-control-input chk_data3_6_{{$i}}Snot" id="data3_6_{{$i}}SnotChkYes">
														<label for="data3_6_{{$i}}SnotChkYes" class="custom-control-label normal-label">มี</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}SnotChk" value="n" class="custom-control-input chk_data3_6_{{$i}}Snot" id="data3_6_{{$i}}SnotChkNo">
														<label for="data3_6_{{$i}}SnotChkNo" class="custom-control-label normal-label">ไม่มี</label>
													</div>
												</td>
												@endfor
											</tr>
											<tr>
												<td>มีเสมหะ</td>
												@for ($i=0; $i<1; $i++)
												<td>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}SputumChk" value="y" class="custom-control-input chk_data3_6_{{$i}}Sputum" id="data3_6_{{$i}}SputumChkYes">
														<label for="data3_6_{{$i}}SputumChkYes" class="custom-control-label normal-label">มี</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}SputumChk" value="n" class="custom-control-input chk_data3_6_{{$i}}Sputum" id="data3_6_{{$i}}SputumChkNo">
														<label for="data3_6_{{$i}}SputumChkNo" class="custom-control-label normal-label">ไม่มี</label>
													</div>
												</td>
												@endfor
											</tr>
											<tr>
												<td>หายใจลำบาก</td>
												@for ($i=0; $i<1; $i++)
												<td>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}BreatheChk" value="y" class="custom-control-input chk_data3_6_{{$i}}Breate" id="data3_6_{{$i}}BreatheChkYes">
														<label for="data3_6_{{$i}}BreatheChkYes" class="custom-control-label normal-label">มี</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}BreatheChk" value="n" class="custom-control-input chk_data3_6_{{$i}}Breate" id="data3_6_{{$i}}BreatheChkNo">
														<label for="data3_6_{{$i}}BreatheChkNo" class="custom-control-label normal-label">ไม่มี</label>
													</div>
												</td>
												@endfor
											</tr>
											<tr>
												<td>หอบเหนื่อย</td>
												@for ($i=0; $i<1; $i++)
												<td>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}GaspChk" value="y" class="custom-control-input chk_data3_6_{{$i}}Gasp" id="data3_6_{{$i}}GaspChkYes">
														<label for="data3_6_{{$i}}GaspChkYes" class="custom-control-label normal-label">มี</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}GaspChk" value="n" class="custom-control-input chk_data3_6_{{$i}}Gasp" id="data3_6_{{$i}}GaspChkNo">
														<label for="data3_6_{{$i}}GaspChkNo" class="custom-control-label normal-label">ไม่มี</label>
													</div>
												</td>
												@endfor
											</tr>
											<tr>
												<td>ปวดกล้ามเนื้อ</td>
												@for ($i=0; $i<1; $i++)
												<td>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}MuscleChk" value="y" class="custom-control-input chk_data3_6_{{$i}}Muscle" id="data3_6_{{$i}}MuscleChkYes">
														<label for="data3_6_{{$i}}MuscleChkYes" class="custom-control-label normal-label">มี</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}MuscleChk" value="n" class="custom-control-input chk_data3_6_{{$i}}Muscle" id="data3_6_{{$i}}MuscleChkNo">
														<label for="data3_6_{{$i}}MuscleChkNo" class="custom-control-label normal-label">ไม่มี</label>
													</div>
												</td>
												@endfor
											</tr>
											<tr>
												<td>ปวดศรีษะ</td>
												@for ($i=0; $i<1; $i++)
												<td>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}HeadacheChk" value="y" class="custom-control-input chk_data3_6_{{$i}}Headache" id="data3_6_{{$i}}HeadacheChkYes">
														<label for="data3_6_{{$i}}HeadacheChkYes" class="custom-control-label normal-label">มี</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}HeadacheChk" value="n" class="custom-control-input chk_data3_6_{{$i}}Headache" id="data3_6_{{$i}}HeadacheChkNo">
														<label for="data3_6_{{$i}}HeadacheChkNo" class="custom-control-label normal-label">ไม่มี</label>
													</div>
												</td>
												@endfor
											</tr>
											<tr>
												<td>ถ่ายเหลว</td>
												@for ($i=0; $i<1; $i++)
												<td>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}LiquidChk" value="y" class="custom-control-input chk_data3_6_{{$i}}Liquid" id="data3_6_{{$i}}LiquidChkYes">
														<label for="data3_6_{{$i}}LiquidChkYes" class="custom-control-label normal-label">มี</label>
													</div>
													<div class="custom-control custom-checkbox custom-control-inline">
														<input type="checkbox" name="data3_6_{{$i}}LiquidChk" value="n" class="custom-control-input chk_data3_6_{{$i}}Liquid" id="data3_6_{{$i}}LiquidChkNo">
														<label for="data3_6_{{$i}}LiquidChkNo" class="custom-control-label normal-label">ไม่มี</label>
													</div>
												</td>
												@endfor
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<div class="form-group">
									<label for="sickDateInput">อาการอื่นๆ (ถ้ามี)</label>
									<div class="input-group">
										<input type="text" name="data3_6SymptomOtherInput" value="{{ old('data3_6SymptomOtherInput') }}" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<div class="form-group">
									<label for="">ใส่ท่อช่วยหายใจ</label>
									<div>
										<div class="custom-control custom-checkbox custom-control-inline">
											<input type="checkbox" name="data3_6BreathingTubeChk" value="n" class="custom-control-input chk_data3_6_Tube" id="data3_6BreathingTubeChkNo">
											<label for="data3_6BreathingTubeChkNo" class="custom-control-label normal-label">ไม่ใส่</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline">
											<input type="checkbox" name="data3_6BreathingTubeChk" value="y" class="custom-control-input chk_data3_6_Tube" id="risk3_6BreathingTubeChkYes">
											<label for="risk3_6BreathingTubeChkYes" class="custom-control-label normal-label">ใส่</label>
										</div>
										<div class="card" style="margin-bottom:0;padding-bottom:0">
											<ul class="list-style-none">
												<li class="card-body">
													<div class="row">
														<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
															<div class="form-group">
																<label for="date">ระบุวันที่ใส่ท่อช่วยหายใจ</label>
																<div class="input-group date" data-provide="datepicker" id="data3_6BreathingTubeDate">
																	<input  type="text" name="data3_6BreathingTubeDate" class="form-control">
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
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<div class="form-group">
									<label for="">การรักษา ได้รับย้าต้านไวรัส</label>
									<div>
										<div class="custom-control custom-checkbox custom-control-inline">
											<input type="checkbox" name="data3_6AntiVirusDrugChk" value="n" class="custom-control-input chk_data3_6_Antiv" id="data3_6AntiVirusDrugChkNo">
											<label for="data3_6AntiVirusDrugChkNo" class="custom-control-label normal-label">ไม่ได้รับ</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline">
											<input type="checkbox" name="data3_6AntiVirusDrugChk" value="y" class="custom-control-input chk_data3_6_Antiv" id="data3_6AntiVirusDrugChkYes">
											<label for="data3_6AntiVirusDrugChkYes" class="custom-control-label normal-label">ได้รับ</label>
										</div>
										<div class="card" style="margin-bottom:0;padding-bottom:0">
											<ul class="list-style-none">
												<li class="card-body">
													<div class="row">
														<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
															<div class="form-group">
																<label for="date">ระบุชื่อยา</label>
																<div class="input-group">
																	<input type="text" name="data3_6AntiVirusDrugInput" value="{{ old('data3_6AntiVirusDrugInput') }}" class="form-control">
																</div>
															</div>
														</div>
														<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
															<div class="form-group">
																<label for="date">ขนาดที่ได้รับ</label>
																<div class="input-group">
																	<input type="text" name="data3_6AntiVirusDrugSizeInput" value="{{ old('data3_6AntiVirusDrugSizeInput') }}" class="form-control">
																</div>
															</div>
														</div>
														<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
															<div class="form-group">
																<label for="date">วันที่ให้ยา</label>
																<div class="input-group date" data-provide="datepicker" id="data3_6AntiVirusDrugStartDate">
																	<input  type="text" name="data3_6AntiVirusDrugStartDate" class="form-control">
																	<div class="input-group-append">
																		<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
															<div class="form-group">
																<label for="date">วันที่หยุดให้ยา</label>
																<div class="input-group date" data-provide="datepicker" id="data3_6AntiVirusDrugEndDate">
																	<input  type="text" name="data3_6AntiVirusDrugEndDate" class="form-control">
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




						</div>
					</div>
				</div>
			</div>
		</li>

	</ul>
</div><!-- card -->
