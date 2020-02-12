<div class="card">
	<div class="card-body" style="margin:0;padding-top:10px;padding-bottom:0">
		<h1 class="card-title m-b-0 m-t-0 text-danger">3. ข้อมูลการตรวจทางห้องปฏิบัติการ</h1>
	</div>
	<ul class="list-style-none">
		<li class="card-body">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="dateInput">3.1 CBC: วันที่</label>
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
						<label for="hbInput">ผล Hb</label>
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
					<label for="wbcInput">WBC</label>
					<input type="text" name="labCbcWbc" value="{{ $invest_pt[0]['lab_cbc_wbc'] }}" class="form-control">
				</div>
			</div>
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<div class="form-group">
						<label for="neuInput">Neutrophil</label>
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
						<label for="lmpInput">Lmphocte</label>
						<div class="input-group">
							<input type="text" name="labCbcLymphocyte" value="{{ $invest_pt[0]['lab_cbc_lymphocyte'] }}" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">%</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="plaInput">Platelet count</label>
					<div class="input-group">
						<input type="text" name="labCbcPlateletCount" value="{{ $invest_pt[0]['lab_cbc_platelet_count'] }}" class="form-control">
						<div class="input-group-append">
							<span class="input-group-text">cell/ml</span>
						</div>
					</div>
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="dateInput">3.2 Chemistry: วันที่ </label>
					<div class="input-group date" data-provide="datepicke" id="lab_chemistry_date">
						<div class="input-group">
							<input type="text" name="chemistryDateInput" value="{{ $data['lab_chemistry_date'] }}" class="form-control" readonly>
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<div class="form-group">
						<label for="bunInput">ผล BUN</label>
						<div class="input-group">
							<input type="text" name="labChemistryBun" value="{{ $invest_pt[0]['lab_chemistry_bun'] }}" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="crInput">Cr</label>
					<div class="input-group">
						<input type="text" name="labChemistryCr" value="{{ $invest_pt[0]['lab_chemistry_cr'] }}" class="form-control">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="gfrInput">GFR</label>
					<input type="text" name="labChemistryGfr" value="{{ $invest_pt[0]['lab_chemistry_gfr'] }}" class="form-control">
				</div>
			</div>
		</li>

		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="dateInput">3.3 Liver function test: วันที่ </label>
					<div class="input-group date" data-provide="datepicke" id="lab_liver_function_test_date">
						<div class="input-group">
							<input type="text" name="labLiverFunctionTestDate" value="{{ $data['lab_liver_function_test_date'] }}" class="form-control" readonly>
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<div class="form-group">
						<label for="sgotInput">ผล SGOT</label>
						<div class="input-group">
							<input type="text" name="labLiverFunctionTestSgot" value="{{ $invest_pt[0]['lab_liver_function_test_sgot'] }}" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="sgptInput">SGPT</label>
					<div class="input-group">
						<input type="text" name="labLiverFunctionTestSgpt" value="{{ $invest_pt[0]['lab_liver_function_test_sgpt'] }}" class="form-control">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="alpInput">ALP</label>
					<input type="text" name="labLiverFunctionTestAlp" value="{{ $invest_pt[0]['lab_liver_function_test_alp'] }}" class="form-control">
				</div>
			</div>
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<div class="form-group">
						<label for="tbInput">Total Bilirubin</label>
						<div class="input-group">
							<input type="text" name="labLiverFunctionTestTotalBilirubin" value="{{ $invest_pt[0]['lab_liver_function_test_total_bilirubin'] }}" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="dbInput">Direct Bilirubin</label>
					<div class="input-group">
						<input type="text" name="labLiverFunctionTestDirectBilirubin" value="{{ $invest_pt[0]['lab_liver_function_test_direct_bilirubin'] }}" class="form-control">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="tpInput">Total Protein</label>
					<input type="text" name="labLiverFunctionTestTotalProtein" value="{{ $invest_pt[0]['lab_liver_function_test_total_protein'] }}" class="form-control">
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="albInput">Albumin</label>
					<input type="text" name="labLiverFunctionTestAlbumin" value="{{ $invest_pt[0]['lab_liver_function_test_albumin'] }}" class="form-control">
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="gloInput">Globulin</label>
					<input type="text" name="labLiverFunctionTestGlobulin" value="{{ $invest_pt[0]['lab_liver_function_test_globulin'] }}" class="form-control">
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="dateInput">3.4 Sputum AFB: วันที่ </label>
					<div class="input-group date" data-provide="datepicke" id="lab_sputum_afb_date">
						<div class="input-group">
							<input type="text" name="labSputumAfbDate" value="{{ $data['lab_sputum_afb_date'] }}" class="form-control" readonly>
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-9 col-xl-9">
					<div class="form-group">
						<label for="rsInput">ผล t</label>
						<div class="input-group">
							<input type="text" name="labSputumAfbt" value="{{ $invest_pt[0]['lab_sputum_afb_t'] }}" class="form-control">
						</div>
					</div>
				</div>
			</div>
		</li>

		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="scDateInput">3.5 Sputum culture: วันที่ </label>
					<div class="input-group date" data-provide="datepicke" id="lab_sputum_culture_date">
						<div class="input-group">
							<input type="text" name="labSputumCultureDate" value="{{ $data['lab_sputum_culture_date'] }}" class="form-control" readonly>
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="cbcDateInput">ผล</label>
					<div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="labSputumCultureResult" value="negative" @if ($invest_pt[0]['lab_sputum_culture_result'] == 'negative') checked @endif class="custom-control-input lab_sputum_culture_result" id="labSputumCultureNagative">
							<label for="labSputumCultureNagative" class="custom-control-label normal-label">Negative</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="labSputumCultureResult" value="positive" @if ($invest_pt[0]['lab_sputum_culture_result'] == 'positive') checked @endif class="custom-control-input lab_sputum_culture_result" id="labSputumCulturePositive">
							<label for="labSputumCulturePositive" class="custom-control-label normal-label">Positive</label>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="rsInput">โปรดระบุเชื้อ</label>
						<div class="input-group">
							<input type="text" name="labSputumCultureGerm" value="{{ $invest_pt[0]['lab_sputum_culture_germ'] }}" class="form-control">
						</div>
					</div>
				</div>
			</div>
		</li>

		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="dateInput">3.6 Hemoculture: วันที่ </label>
					<div class="input-group date" data-provide="datepicke" id="lab_hemoculture_date">
						<div class="input-group">
							<input type="text" name="labHemocultureDate" value="{{ $data['lab_hemoculture_date'] }}" class="form-control" readonly>
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="result">ผล</label>
					<div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="labHemocultureResult" value="negative" @if ($invest_pt[0]['lab_hemoculture_result'] == 'negative') checked @endif class="custom-control-input lab_hemoculture_result" id="labHemocultureResultNetative">
							<label for="labHemocultureResultNetative" class="custom-control-label normal-label">Negative</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="labHemocultureResult" value="positive" @if ($invest_pt[0]['lab_hemoculture_result'] == 'positive') checked @endif class="custom-control-input lab_hemoculture_result" id="labHemoculturePositive">
							<label for="labHemoculturePositive" class="custom-control-label normal-label">Positive</label>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="germ">โปรดระบุเชื้อ</label>
						<div class="input-group">
							<input type="text" name="labHemocultureGerm" value="{{ $invest_pt[0]['lab_hemoculture_germ'] }}" class="form-control">
						</div>
					</div>
				</div>
			</div>
		</li>

		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="dateInput">3.7 CXR: ครั้งที่ 1 วันที่ </label>
					<div class="input-group date" data-provide="datepicke" id="lab_cxr1_date">
						<div class="input-group">
							<input type="text" name="labCxr1Date" value="{{ $data['lab_cxr1_date'] }}" class="form-control" readonly>
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="result">ผล</label>
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
						<label for="fileInput" class="text-danger">CXR1: File</label>
						<div class="input-group">
							<div class="custom-file">
								<input type="file" name="labCxr1File" class="custom-file-input" id="lab_cxr1_file">
								<label class="custom-file-label border-warning" for="customFile">Choose file</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</li>

		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="dateInput">3.8 CXR: ครั้งที่ 2 วันที่ </label>
					<div class="input-group date" data-provide="datepicke" id="lab_cxr2_date">
						<div class="input-group">
							<input type="text" name="labCxr2Date" value="{{ $data['lab_cxr2_date'] }}" class="form-control" readonly>
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="result">ผล</label>
					<div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="labCxr2Result" value="normal" @if ($invest_pt[0]['lab_cxr2_result'] == 'normal') checked @endif class="custom-control-input lab_cxr2_result" id="labCxr2ResultNormal">
							<label for="labCxr2ResultNormal" class="custom-control-label normal-label">ปกติ</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="labCxr2Result" value="unusual" @if ($invest_pt[0]['lab_cxr2_result'] == 'unusual') checked @endif class="custom-control-input lab_cxr2_result" id="labCxr2ResultUnusual">
							<label for="labCxr2ResultUnusual" class="custom-control-label normal-label">ผิดปกติ</label>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="detail">โปรดระบุ</label>
						<div class="input-group">
							<input type="text" name="labCxr2Detail" value="{{ $invest_pt[0]['lab_cxr2_detail'] }}" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="result" class="text-danger">CXR2: File</label>
						<div class="input-group">
							<div class="custom-file">
								<input type="file" name="labCxr2File" class="custom-file-input" id="lab_cxr2_file">
								<label class="custom-file-label border-warning" for="customFile">Choose file</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</li>

		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="rapidtest">3.9 Rapid test สำหรับไข้หวัด</label>
						<div class="input-group">
							<input type="text" name="labRapidTestName" value="{{ $invest_pt[0]['lab_rapid_test_name'] }}" class="form-control" placeholder="ระบุชื่อชุดทดสอบ">
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<label for="dateInput">วันที่</label>
					<div class="input-group date" data-provide="datepicke" id="lab_rapid_test_date">
						<div class="input-group">
							<input type="text" name="labRapidTestDate" value="{{ $data['lab_rapid_test_date'] }}" class="form-control" readonly>
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<label for="result">ผล</label>
					<div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="labRapidTestResult" value="normal" @if ($invest_pt[0]['lab_rapid_test_result'] == 'normal') checked @endif class="custom-control-input lab_rapid_test_result" id="labRapidTestResultNagative">
							<label for="labRapidTestResultNagative" class="custom-control-label normal-label">ปกติ</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="labRapidTestResult" value="unusual" @if ($invest_pt[0]['lab_rapid_test_result'] == 'unusual') checked @endif class="custom-control-input lab_rapid_test_result" id="labRapidTestResultPositive">
							<label for="labRapidTestResultPositive" class="custom-control-label normal-label">ผิดปกติ</label>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8 col-xl-8">
					<div class="form-group">
						<label for="other">อื่นๆ โปรดระบุ</label>
						<div class="input-group">
							<input type="text" name="labRapidTestOther" value="{{ $invest_pt[0]['lab_rapid_test_other'] }}" class="form-control">
						</div>
					</div>
				</div>
			</div>
		</li>

		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="rapidtest">3.10 ผลการตรวจห้องปฏิบัติการอื่นๆ ระบุ</label>
						<div class="input-group">
							<input type="text" name="labOtherName" value="{{ $invest_pt[0]['lab_other_name'] }}" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="exam">ชนิดตัวอย่าง</label>
						<div class="input-group">
							<input type="text" name="labOtherSpecimen" value="{{ $invest_pt[0]['lab_other_specimen'] }}" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<label for="dateInput">วันที่</label>
					<div class="input-group date" data-provide="datepicke" id="lab_other_date">
						<div class="input-group">
							<input type="text" name="labOtherDate" value="{{ $data['lab_other_date'] }}" class="form-control" readonly>
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-9 col-xl-9">
					<div class="form-group">
						<label for="lab">สถานที่ส่งตรวจ</label>
						<div class="input-group">
							<input type="text" name="labOtherPlace" value="{{ $invest_pt[0]['lab_other_place'] }}" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-9 col-xl-9">
					<div class="form-group">
						<label for="lab">ผลการตรวจ</label>
						<div class="input-group">
							<input type="text" name="labOtherResult" value="{{ $invest_pt[0]['lab_other_result'] }}" class="form-control">
						</div>
					</div>
				</div>
			</div>
		</li>
	</ul>
</div><!-- card -->
