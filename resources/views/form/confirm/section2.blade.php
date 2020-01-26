<div class="card">
	<div class="card-body" style="margin:0;padding-top:10px;padding-bottom:0">
		<h1 class="card-title m-b-0 m-t-0 text-danger">2. ประวัติเสี่ยงต่อการติดเชื้อ</h1>
	</div>
	<ul class="list-style-none">
		<li class="card-body">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
					<div class="form-group">
						<label for="risk">2.1 ในช่วง 14 วันก่อนป่วย ท่านได้มีการสัมผัสสัตว์ปีก (ฟาร์ม/เลี้ยง/ในธรรมชาติ) เช่น จับ ชำแหละ ฝังกลบ หรือรับประทานสุกๆ ดิบๆ เป็นต้น</label>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_1Chk" value="n" class="custom-control-input pt-type" id="risk2_1ChkNo">
								<label for="risk2_1ChkNo" class="custom-control-label normal-label">ไม่มี</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_1Chk" value="y" class="custom-control-input pt-type" id="risk2_1ChkYes">
								<label for="risk2_1ChkYes" class="custom-control-label normal-label">มี ระบุลักษณะการสัมผัส</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
					<div class="form-group">
						<label for="contact">ระบุลักษณะการสัมผัส</label>
						<input type="text" name="risk2_1Input" value="{{ old('relativeshipInput') }}" class="form-control" placeholder="ลักษณะการสัมผัส">
					</div>
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
					<div class="form-group">
						<label for="risk">2.2 ในช่วง 14 วันก่อนป่วย ท่านได้มีการสัมผัสโดยตรงกับสุกร หรือสัตว์เลี้ยงลูกด้วยนมอื่นๆ ที่ป่วย/ตาย ผิดปกติหรือไม่ทราบสาเหตุ</label>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_2Chk" value="n" class="custom-control-input pt-type" id="risk2_2ChkNo">
								<label for="risk2_2ChkNo" class="custom-control-label normal-label">ไม่มี</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_2Chk" value="y" class="custom-control-input pt-type" id="risk2_2ChkYes">
								<label for="risk2_2ChkYes" class="custom-control-label normal-label">มี ระบุลักษณะการสัมผัส</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
					<div class="form-group">
						<label for="birthDate">ระบุ (ว/ด/ป ที่สัมผัส)</label>
						<div class="input-group date" data-provide="datepicker" id="risk2_2Date">
							<input  type="text" name="risk2_2Date" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
					<div class="form-group">
						<label for="contact">ชนิดสัตว์</label>
						<input type="text" name="risk2_2AnimalInput" class="form-control" placeholder="ชนิดสัตว์">
					</div>
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
					<div class="form-group">
						<label for="risk">2.3 ในช่วง 14 วันก่อนป่วย ท่านได้พักอาศัยในพื้นที่ที่มีสัตว์ปีกป่วยตายมากผิดปกติหรือพบเชื้อในสัตว์ปีกหรือสิ่งแวดล้อม</label>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_3Chk" value="n" class="custom-control-input pt-type" id="risk2_3ChkNo">
								<label for="risk2_3ChkNo" class="custom-control-label normal-label">ไม่มี</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_3Chk" value="y" class="custom-control-input pt-type" id="risk2_3ChkYes">
								<label for="risk2_3ChkYes" class="custom-control-label normal-label">มี</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
					<div class="form-group">
						<label for="risk">2.4 ในช่วง 14 วันก่อนป่วย ไปตลาดสดที่มีการค้าสัตว์ปีก/สัตว์ป่า/สัตว์เลี้ยงลูกด้วยนม/อาหารทะเล ในเมืองอู่ฮั่น (Wuhan) มณฑลหูเป่ย (Hubei) ประเทศจีน</label>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_4Chk" value="n" class="custom-control-input pt-type" id="risk2_4ChkNo">
								<label for="risk2_4ChkNo" class="custom-control-label normal-label">ไม่มี</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_4Chk" value="y" class="custom-control-input pt-type" id="risk2_4ChkYes">
								<label for="risk2_4ChkYes" class="custom-control-label normal-label">มี ระบุชื่อตลาดและชนิดสัตว์</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
					<div class="form-group">
						<label for="contact">ชื่อตลาด</label>
						<input type="text" name="risk2_4MarketInput" class="form-control" placeholder="ชื่อตลาด">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
					<div class="form-group">
						<label for="contact">ชนิดสัตว์</label>
						<input type="text" name="risk2_4AnimalInput" class="form-control" placeholder="ชนิดสัตว์">
					</div>
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
					<div class="form-group">
						<label for="risk">2.5 ในช่วง 14 วันก่อนป่วย ไปตลาดสดที่มีการค้าสัตว์ปีก/สัตว์ป่า/สัตว์เลี้ยงลูกด้วยนม/อาหารทะเล นอกเหนือจากข้อ 2.4</label>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_5Chk" value="n" class="custom-control-input pt-type" id="risk2_5ChkNo">
								<label for="risk2_5ChkNo" class="custom-control-label normal-label">ไม่มี</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_5Chk" value="y" class="custom-control-input pt-type" id="risk2_5ChkYes">
								<label for="risk2_5ChkYes" class="custom-control-label normal-label">มี ระบุชื่อตลาดและชนิดสัตว์</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
					<div class="form-group">
						<label for="contact">ชื่อตลาด</label>
						<input type="text" name="risk2_5MarketInput" class="form-control" placeholder="ชื่อตลาด">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
					<div class="form-group">
						<label for="contact">ชนิดสัตว์</label>
						<input type="text" name="risk2_5AnimalInput" class="form-control" placeholder="ชนิดสัตว์">
					</div>
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
					<div class="form-group">
						<label for="risk">2.6 ในช่วง 14 วันก่อนป่วย ท่านอาศัยอยู่ หรือ มีการเดินทางมาจากพื้นที่ที่มีการระบาด</label>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_6Chk" value="n" class="custom-control-input pt-type" id="risk2_6ChkNo">
								<label for="risk2_6ChkNo" class="custom-control-label normal-label">ไม่มี</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_6Chk" value="y" class="custom-control-input pt-type" id="risk2_6ChkYes">
								<label for="risk2_6ChkYes" class="custom-control-label normal-label">มี ระบุรายละเอียดดังต่อไปนี้</label>
							</div>
							<div class="card" style="margin-bottom:0;padding-bottom:0">
								<ul class="list-style-none">
									<li class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="contact">ชื่อประเทศ</label>
													<input type="text" name="risk2_6CountryInput" class="form-control" placeholder="ชื่อประเทศ">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="contact">เมือง/จังหวัด</label>
													<input type="text" name="risk2_6ProvinceInput" class="form-control" placeholder="เมือง/จังหวัด">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="contact">อำเภอ</label>
													<input type="text" name="risk2_6DistrictInput" class="form-control" placeholder="อำเภอ">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
												<div class="form-group">
													<label for="date">วันที่เดินทางไปถึง</label>
													<div class="input-group date" data-provide="datepicker" id="risk2_6DateArrive">
														<input  type="text" name="risk2_6DateArrive" class="form-control">
														<div class="input-group-append">
															<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
														</div>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-10 col-xl-10 mb-3">
												<div class="form-group">
													<label for="risk">เหตุผลของการเดินทางไปประเทศดังกล่าว</label>
													<input type="text" name="risk2_6ReasonInput" class="form-control" placeholder="เหตุผล">
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
					<div class="form-group">
						<label for="">กิจกรรมที่ทำในต่างประเทศ</label>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_6WorkChk" value="n" class="custom-control-input" id="risk2_6WorkChk">
								<label for="risk2_6WorkChk" class="custom-control-label normal-label">ไปทำงาน</label>
							</div>
							<div class="card" style="margin-bottom:0;padding-bottom:0">
								<ul class="list-style-none">
									<li class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="">ลักษณะงาน</label>
													<input type="text" name="risk2_6WorkTypeInput" class="form-control" placeholder="ลักษณะงาน">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="">สถานที่</label>
													<input type="text" name="risk2_6WorkPlaceInput" class="form-control" placeholder="สถานที่">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="">ระยะเวลา</label>
													<input type="text" name="risk2_6WorkDurationInput" class="form-control" placeholder="ระยะเวลา">
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_6MeetingChk" value="n" class="custom-control-input" id="risk2_6MeetingChk">
								<label for="risk2_6MeetingChk" class="custom-control-label normal-label">ประชุม/อบรม</label>
							</div>
							<div class="card" style="margin-bottom:0;padding-bottom:0">
								<ul class="list-style-none">
									<li class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="">สถานที่</label>
													<input type="text" name="risk2_6MeetingPlaceInput" class="form-control" placeholder="สถานที่">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-3">
												<div class="form-group">
													<label for="date">วันที่</label>
													<div class="input-group date" data-provide="datepicker" id="risk2_6WorkMeetingDate">
														<input  type="text" name="risk2_6MeetingDate" class="form-control">
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
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_6StudyChk" value="n" class="custom-control-input" id="risk2_6StudyChk">
								<label for="risk2_6StudyChk" class="custom-control-label normal-label">ไปศึกษา</label>
							</div>
							<div class="card" style="margin-bottom:0;padding-bottom:0">
								<ul class="list-style-none">
									<li class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="">โรงเรียน/มหาวิทยาลัย</label>
													<input type="text" name="risk2_6StudyNameInput" class="form-control" placeholder="โรงเรียน/มหาวิทยาลัย">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="">ระยะเวลา</label>
													<input type="text" name="risk2_6StudyDurationInput" class="form-control" placeholder="ระยะเวลา">
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_6VisitChk" value="n" class="custom-control-input" id="risk2_6VisitChk">
								<label for="risk2_6VisitChk" class="custom-control-label normal-label">ไปเยี่ยมญาติ</label>
							</div>
							<div class="card" style="margin-bottom:0;padding-bottom:0">
								<ul class="list-style-none">
									<li class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="">บ้านเลขที่</label>
													<input type="text" name="risk2_6VisitHouseNoInput" class="form-control" placeholder="บ้านเลขที่">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="">ระยะเวลา</label>
													<input type="text" name="risk2_6VisitDurationInput" class="form-control" placeholder="ระยะเวลา">
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_6TravelChk" value="n" class="custom-control-input" id="risk2_6TravelChk">
								<label for="risk2_6TravelChk" class="custom-control-label normal-label">ไปเที่ยว</label>
							</div>
							<div class="card" style="margin-bottom:0;padding-bottom:0">
								<ul class="list-style-none">
									<li class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
												<div class="form-group">
													<label for="">กิจกรรมที่ทำ</label>
													<input type="text" name="risk2_6Activity1Input" class="form-control" placeholder="กิจกรรมที่ทำ">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
												<div class="form-group">
													<label for="">สถานที่</label>
													<input type="text" name="risk2_6Activity1PlaceInput" class="form-control" placeholder="สถานที่">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
												<div class="form-group">
													<label for="date">วันที่</label>
													<div class="input-group date" data-provide="datepicker" id="risk2_6Activity1DateInput">
														<input  type="text" name="risk2_6Activity1DateInput" class="form-control">
														<div class="input-group-append">
															<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
												<div class="form-group">
													<label for="">กิจกรรมที่ทำ</label>
													<input type="text" name="risk2_6Activity2Input" class="form-control" placeholder="กิจกรรมที่ทำ">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
												<div class="form-group">
													<label for="">สถานที่</label>
													<input type="text" name="risk2_6Activity2PlaceInput" class="form-control" placeholder="สถานที่">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
												<div class="form-group">
													<label for="date">วันที่</label>
													<div class="input-group date" data-provide="datepicker" id="risk2_6Activity2DateInput">
														<input  type="text" name="risk2_6Activity2DateInput" class="form-control">
														<div class="input-group-append">
															<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
												<div class="form-group">
													<label for="">กิจกรรมที่ทำ</label>
													<input type="text" name="risk2_6Activity3Input" class="form-control" placeholder="กิจกรรมที่ทำ">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
												<div class="form-group">
													<label for="">สถานที่</label>
													<input type="text" name="risk2_6Activity3PlaceInput" class="form-control" placeholder="สถานที่">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
												<div class="form-group">
													<label for="date">วันที่</label>
													<div class="input-group date" data-provide="datepicker" id="risk2_6Activity3DateInput">
														<input  type="text" name="risk2_6Activity3DateInput" class="form-control">
														<div class="input-group-append">
															<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
												<div class="form-group">
													<label for="">กิจกรรมที่ทำ</label>
													<input type="text" name="risk2_6Activity4Input" class="form-control" placeholder="กิจกรรมที่ทำ">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
												<div class="form-group">
													<label for="">สถานที่</label>
													<input type="text" name="risk2_6Activity4PlaceInput" class="form-control" placeholder="สถานที่">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
												<div class="form-group">
													<label for="date">วันที่</label>
													<div class="input-group date" data-provide="datepicker" id="risk2_6Activity4DateInput">
														<input  type="text" name="risk2_6Activity4DateInput" class="form-control">
														<div class="input-group-append">
															<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
												<div class="form-group">
													<label for="">กิจกรรมที่ทำ</label>
													<input type="text" name="risk2_6Activity5Input" class="form-control" placeholder="กิจกรรมที่ทำ">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
												<div class="form-group">
													<label for="">สถานที่</label>
													<input type="text" name="risk2_6Activity5PlaceInput" class="form-control" placeholder="สถานที่">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
												<div class="form-group">
													<label for="date">วันที่</label>
													<div class="input-group date" data-provide="datepicker" id="risk2_6Activity5DateInput">
														<input  type="text" name="risk2_6Activity5DateInput" class="form-control">
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
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_6MeetingChk" value="y" class="custom-control-input" id="risk2_6MeetingChk">
								<label for="risk2_6MeetingChk" class="custom-control-label normal-label">อื่นๆ</label>
							</div>
							<div class="card" style="margin-bottom:0;padding-bottom:0">
								<ul class="list-style-none">
									<li class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
												<div class="form-group">
													<label for="">โปรดระบุ</label>
													<input type="text" name="risk2_6OtherInput" class="form-control" placeholder="อื่นๆ โปรดระบุ">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
												<div class="form-group">
													<label for="date">วันที่เดินทางไปถึงประเทศไทย</label>
													<div class="input-group date" data-provide="datepicker" id="risk2_6ArriveDate">
														<input  type="text" name="risk2_6ArriveDate" class="form-control">
														<div class="input-group-append">
															<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
														</div>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
												<div class="form-group">
													<label for="contact">สายการบิน</label>
													<input type="text" name="risk2_6AirlineInput" class="form-control" placeholder="สายการบิน">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
												<div class="form-group">
													<label for="contact">เที่ยวบินที่</label>
													<input type="text" name="risk2_6FlightNoInput" class="form-control" placeholder="เที่ยวบินที่">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
												<div class="form-group">
													<label for="contact">เลขที่นั่ง</label>
													<input type="text" name="risk2_6SeatNoInput" class="form-control" placeholder="เลขที่นั่ง">
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
					<div class="form-group">
						<label for="">มีประวัติเข้ารับการรักษาหรือเยี่ยมผู้ป่วยในโรงพยาบาลขณะอยู่ที่ประเทศดังกล่าวหรือไม่</label>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_6HistoryChk" value="n" class="custom-control-input pt-type" id="risk2_6HistoryChkNo">
								<label for="risk2_6HistoryChkNo" class="custom-control-label normal-label">ไม่มี</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_6HistoryChk" value="y" class="custom-control-input pt-type" id="risk2_6HistoryChkYes">
								<label for="risk2_6HistoryChkYes" class="custom-control-label normal-label">มี ระบุรายละเอียดดังต่อไปนี้</label>
							</div>
							<div class="card" style="margin-bottom:0;padding-bottom:0">
								<ul class="list-style-none">
									<li class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3">
												<div class="form-group">
													<label for="date">ระบุวันที่เข้าโรงพยาบาล</label>
													<div class="input-group date" data-provide="datepicker" id="risk2_6HistoryHospitalDate">
														<input  type="text" name="risk2_6HistoryHospitalDate" class="form-control">
														<div class="input-group-append">
															<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
														</div>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-9 col-xl-9 mb-3">
												<div class="form-group">
													<label for="contact">ชื่อโรงพยาบาล</label>
													<input type="text" name="risk2_6HistoryHospitalInput" class="form-control" placeholder="โรงพยาบาล">
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
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
					<div class="form-group">
						<label for="risk">2.7 ในช่วง 14 วันก่อนป่วย ท่านให้การดูแลหรือสัมผัสใกล้ชิดกับผู้ป่วยอาการคล้ายไข้หวัดใหญ่/ปอดอักเสบหรือไม่</label>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_7Chk" value="n" class="custom-control-input pt-type" id="risk2_7ChkNo">
								<label for="risk2_7ChkNo" class="custom-control-label normal-label">ไม่มี</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_7Chk" value="y" class="custom-control-input pt-type" id="risk2_7ChkYes">
								<label for="risk2_7ChkYes" class="custom-control-label normal-label">มี ระบุรายละเอียดดังต่อไปนี้</label>
							</div>
							<div class="card" style="margin-bottom:0;padding-bottom:0">
								<ul class="list-style-none">
									<li class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="">ระบุความสัมพันธ์</label>
													<input type="text" name="risk2_7RelationshipInput" class="form-control" placeholder="ความสัมพันธ์">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="contact">ระบุชื่อ (หากสามารถระบุได้)</label>
													<input type="text" name="risk2_7RelationNameInput" class="form-control" placeholder="ระบุชื่อ">
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
					<div class="form-group">
						<label for="">2.8 เป็นผู้ป่วยปอดอักเสบรุนแรงหรือเสียชีวิตที่หาสาเหตุไม่ได้</label>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_8Chk" value="n" class="custom-control-input pt-type" id="risk2_8ChkNo">
								<label for="risk2_8ChkNo" class="custom-control-label normal-label">ไม่ใช่</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_8Chk" value="y" class="custom-control-input pt-type" id="risk2_8ChkYes">
								<label for="risk2_8ChkYes" class="custom-control-label normal-label">ใช่</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
					<div class="form-group">
						<label for="risk">2.9 เป็นบุคลากรทางการแพทย์และสาธารณสุขหรือเจ้าหน้าที่ห้องปฎิบัติการ</label>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_9Chk" value="n" class="custom-control-input pt-type" id="risk2_9ChkNo">
								<label for="risk2_9ChkNo" class="custom-control-label normal-label">ไม่ใช่</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_9Chk" value="y" class="custom-control-input pt-type" id="risk2_9ChkYes">
								<label for="risk2_9ChkYes" class="custom-control-label normal-label">ใช่</label>
							</div>
							<div class="card" style="margin-bottom:0;padding-bottom:0">
								<ul class="list-style-none">
									<li class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="">ระบุ</label>
													<input type="text" name="risk2_9Input" class="form-control" placeholder="ระบุ">
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
					<div class="form-group">
						<label for="risk">2.10 ผู้ป่วยอาการคล้ายไข้หวัดใหญ่ หรือปอดอักเสบเป็นกลุ่มก้อน</label>
						<div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_10Chk" value="n" class="custom-control-input" id="risk2_10ChkNo">
								<label for="risk2_10ChkNo" class="custom-control-label normal-label">ไม่ใช่</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="risk2_10Chk" value="y" class="custom-control-input" id="risk2_10ChkYes">
								<label for="risk2_10ChkYes" class="custom-control-label normal-label">ใช่ ระบุรายละเอียดของผู้ป่วยปอดอักเสบรายอื่น</label>
							</div>
							<div class="card" style="margin-bottom:0;padding-bottom:0">
								<ul class="list-style-none">
									<li class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="">ชื่อ-สกุล</label>
													<input type="text" name="risk2_10NameInput" class="form-control" placeholder="ชื่อ-สกุล">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="date">วันเริ่มป่วย</label>
													<div class="input-group date" data-provide="datepicker" id="risk2_10Date">
														<input  type="text" name="risk2_10Date" class="form-control">
														<div class="input-group-append">
															<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
														</div>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="">อาการ</label>
													<input type="text" name="risk2_10SymptomInput" class="form-control" placeholder="อาการ">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="">การวินิจฉัย</label>
													<input type="text" name="risk2_10DiagInput" class="form-control" placeholder="การวินิจฉัย">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="">โรงพยาบาลที่วินิจฉัย</label>
													<input type="text" name="risk2_10HospitalInput" class="form-control" placeholder="การวินิจฉัย">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
												<div class="form-group">
													<label for="">ความเกี่ยวข้องกับผู้ป่วยรายนี้</label>
													<input type="text" name="risk2_10ConnectInput" class="form-control" placeholder="การวินิจฉัย">
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
	</ul>
</div><!-- card2 -->
