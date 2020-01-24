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
						<label for="">3.2 สถานที่รักษา (ครั้งแรก)</label>
						<input type="text" name="risk3_2firstTreatInput" value="{{ old('risk3_2firstTreatInput') }}" class="form-control" placeholder="สถานที่รักษา">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<div class="form-group">
						<label for="treatDateInput">วันที่รักษา (ครั้งแรก)</label>
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
								<input type="checkbox" name="risk3_2patientTypeChk" value="opd" class="custom-control-input pt-type" id="risk3_2patientTypeChkOpd">
								<label for="risk3_2patientTypeChkOpd" class="custom-control-label normal-label">ผู้ป่วยนอก</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk3_2patientTypeChk" value="ipd" class="custom-control-input pt-type" id="risk3_2patientTypeChkIpd">
								<label for="risk3_2patientTypeChkIpd" class="custom-control-label normal-label">ผู้ป่วยใน</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="">สถานที่ (Admit)</label>
						<input type="text" name="risk3_admitInput" value="{{ old('risk3_admitInput') }}" class="form-control" placeholder="สถานที่ (Admit)">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<div class="form-group">
						<label for="treatDateInput">วันที่ (Admit)</label>
						<div class="input-group date" data-provide="datepicke" id="risk3_admitDateInput">
							<div class="input-group">
								<input type="text" name="risk3_admitDateInput" value="{{ old('risk3_admitDateInput') }}" class="form-control" readonly>
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
								<input type="checkbox" name="risk3_3Chk" value="n" class="custom-control-input pt-type" id="risk3_3ChkNo">
								<label for="risk3_3ChkNo" class="custom-control-label normal-label">ไม่มี</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk3_3Chk" value="y" class="custom-control-input pt-type" id="risk3_3ChkYes">
								<label for="risk3_3ChkYes" class="custom-control-label normal-label">มี (กรุณาทำเครื่องหมายด้านล่าง)</label>
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
								<tr id="risk3_3table_tr1">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="contactPoultry7Input" value="y" class="custom-control-input">
											<label for="" class="custom-control-label normal-label">
												โรคปอดเรื้อรัง เช่น COPD, chronic bronchitis, chronic bronchiectasis, BPD, หรือหอบ (asthma) ที่กำลังรักษา
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr2">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="contactPoultry7Input" value="y" class="custom-control-input">
											<label for="" class="custom-control-label normal-label">
												โรคหัวใจ เช่น หัวใจพิการแต่กำเนิด, โรคหลอดเลือดหัวใจ หรือ Congestive heart failure
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr3">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="contactPoultry7Input" value="y" class="custom-control-input">
											<label for="" class="custom-control-label normal-label">
												โรคตับเรื้อรัง เช่น ตับแข็ง (Cirrhosis)
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr4">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="contactPoultry7Input" value="y" class="custom-control-input">
											<label for="" class="custom-control-label normal-label">
												โรคไต, ไตวาย
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr5">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="contactPoultry7Input" value="y" class="custom-control-input">
											<label for="" class="custom-control-label normal-label">
												เบาหวาน
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr6">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="contactPoultry7Input" value="y" class="custom-control-input">
											<label for="" class="custom-control-label normal-label">
												ความดันโลหิตสูง
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr7">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="contactPoultry7Input" value="y" class="custom-control-input">
											<label for="" class="custom-control-label normal-label">
												ภูมิคุ้มกันบกพร่อง
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr8">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="contactPoultry7Input" value="y" class="custom-control-input">
											<label for="" class="custom-control-label normal-label">
												โลหิตจาง (ธาลัสซีเมีย, sickle cell anemia)
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr9">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="contactPoultry7Input" value="y" class="custom-control-input">
											<label for="" class="custom-control-label normal-label">
												พิการทางสมอง ช่วยเหลือตัวเองไม่ได้
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr10">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="contactPoultry7Input" value="y" class="custom-control-input">
											<label for="" class="custom-control-label normal-label">
												ตั้งครรภ์
											</label>
											<div class="row mt-2">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
													<div class="form-group">
														<input type="text" name="risk3_admitInput" value="{{ old('risk3_admitInput') }}" class="form-control" placeholder="อายุครรภ์">
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr11">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="contactPoultry7Input" value="y" class="custom-control-input">
											<label for="" class="custom-control-label normal-label">
												อ้วน
											</label>
											<div class="row mt-2">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
													<div class="form-group">
														<input type="text" name="risk3_admitInput" value="{{ old('risk3_admitInput') }}" class="form-control" placeholder="ส่วนสูง">
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
													<div class="form-group">
														<input type="text" name="risk3_admitInput" value="{{ old('risk3_admitInput') }}" class="form-control" placeholder="น้ำหนัก">
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
													<div class="form-group">
														<input type="text" name="risk3_admitInput" value="{{ old('risk3_admitInput') }}" class="form-control" placeholder="BMI">
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr12">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="contactPoultry7Input" value="y" class="custom-control-input">
											<label for="" class="custom-control-label normal-label">
												มะเร็งที่กำลังรักษา ระบุประเภท
											</label>
											<div class="row mt-2">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
													<div class="form-group">
														<input type="text" name="risk3_admitInput" value="{{ old('risk3_admitInput') }}" class="form-control" placeholder="ประเภทมะเร็ง">
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr13">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="contactPoultry7Input" value="y" class="custom-control-input">
											<label for="" class="custom-control-label normal-label">
												อื่นๆ
											</label>
											<div class="row mt-2">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
													<div class="form-group">
														<input type="text" name="risk3_admitInput" value="{{ old('risk3_admitInput') }}" class="form-control" placeholder="อื่นๆ โปรดระบุ">
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
								<input type="checkbox" name="risk3_3Chk" value="n" class="custom-control-input pt-type" id="risk3_3ChkNo">
								<label for="risk3_3ChkNo" class="custom-control-label normal-label">ไม่สูบ</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk3_3Chk" value="y" class="custom-control-input pt-type" id="risk3_3ChkYes">
								<label for="risk3_3ChkYes" class="custom-control-label normal-label">สูบ  (ถ้าสูบ กรุณาทำเครื่องหมายด้านล่าง)</label>
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
											<input type="checkbox" name="contactPoultry7Input" value="y" class="custom-control-input">
											<label for="" class="custom-control-label normal-label">
												ยังสูบ ปริมาณ
											</label>
											<div class="row mt-2">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
													<div class="form-group">
														<input type="text" name="risk3_admitInput" value="{{ old('risk3_admitInput') }}" class="form-control" placeholder="มวน/ซอง ต่อ วัน/สัปดาห์">
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table2_tr1">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="contactPoultry7Input" value="y" class="custom-control-input">
											<label for="" class="custom-control-label normal-label">
												หยุดสูบ สูบมานาน
											</label>
											<div class="row mt-2">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
													<div class="form-group">
														<input type="text" name="risk3_admitInput" value="{{ old('risk3_admitInput') }}" class="form-control" placeholder="สูบมานาน">
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
</div><!-- card -->
