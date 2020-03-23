@extends('layouts.index')
@section('custom-style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/toastr/build/toastr.min.css') }}">
<style>
	input:-moz-read-only { /* For Firefox */
		background-color: #fafafa !important;
	}
	input:read-only {
		background-color: #fafafa !important;
	}
	.select-custom select option {
		padding: 18px!important;
}
</style>
@endsection
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contents')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Invest Form</h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('list-data.invest') }}">Invest</a></li>
						<li class="breadcrumb-item active" aria-current="page">Form</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	@include('flash::message')
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="card">
					<div class="card-body">
						<div class="d-md-flex align-items-center mb-2">
							<div>
								<h4 class="card-title">แบบสอบสวนของผู้ป่วยโรคปอดอักเสบจากเชื้อไวรัสโคโรนาสายพันธุ์ใหม่ 2019</h4>
								<h5 class="card-subtitle">COVID-19</h5>
							</div>
						</div>
						<form action="#" method="POST" enctype="multipart/form-data" class="form-horizontal">
							{{ csrf_field() }}
							{{ method_field('POST') }}
							<div class="bd-callout bd-callout-info" style="margin-top:0;position:relative">
								<div style="position:absolute;top:10px;right:10px;z-index:1">
									<span class="btn btn-danger font-weight-bold" style="font-family: 'Fira-code';">13A1603CW09</span>
								</div>
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
															<label for="pid">เลขประจำคัวประชาชน/เลขที่Passport</label>
															<input type="text" name="idcardInput" value="" class="form-control" id="idcard" placeholder="ID" required>
														</div>
													</div>
                </div>
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
						<div class="form-group">
							<label for="sex">เพศ</label>
							<select name="sexInput" class="form-control selectpicker show-tick" id="select_sex">
																	<option value="ชาย" selected="selected">ชาย</option>
																<option value="">-- โปรดเลือก --</option>
								<option value="ชาย">ชาย</option>
								<option value="หญิง">หญิง</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
						<div class="form-group">
							<label for="ageYear">อายุ/ปี</label>
							<input type="text" name="ageYearInput" value="37" class="form-control" id="age_year_input" required>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
						<div class="form-group">
							<label for="ageMonth">อายุ/เดือน</label>
							<input type="text" name="ageMonthInput" value="" class="form-control" id="age_month_input">
						</div>
					</div>

				</div>
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="nationality">สัญชาติ</label>
							<select name="nationalityInput" class="form-control selectpicker show-tick" id="select_nationality">
																	<option value="194" selected="selected">Switzerland</option>
																<option value="">-- โปรดเลือก --</option>
																	<option value="1">Afghanistan</option>
																	<option value="2">Albania</option>
																	<option value="3">Algeria</option>
																	<option value="4">American Samoa</option>
																	<option value="5">Andorra</option>
																	<option value="6">Angola</option>
																	<option value="7">Antigua And Barbuda</option>
																	<option value="8">Argentina</option>
																	<option value="9">Armenia</option>
																	<option value="10">Aruba</option>
																	<option value="11">Australia</option>
																	<option value="12">Austria</option>
																	<option value="13">Azerbaijan</option>
																	<option value="14">Bahamas, The</option>
																	<option value="15">Bahrain</option>
																	<option value="16">Bangladesh</option>
																	<option value="17">Barbados</option>
																	<option value="18">Belarus</option>
																	<option value="19">Belgium</option>
																	<option value="20">Belize</option>
																	<option value="21">Benin</option>
																	<option value="22">Bermuda</option>
																	<option value="23">Bhutan</option>
																	<option value="24">Bolivia</option>
																	<option value="25">Bosnia And Herzegovina</option>
																	<option value="26">Botswana</option>
																	<option value="27">Brazil</option>
																	<option value="28">Brunei</option>
																	<option value="29">Bulgaria</option>
																	<option value="30">Burkina Faso</option>
																	<option value="31">Burma</option>
																	<option value="32">Burundi</option>
																	<option value="33">Cabo Verde</option>
																	<option value="34">Cambodia</option>
																	<option value="35">Cameroon</option>
																	<option value="36">Canada</option>
																	<option value="37">Cayman Islands</option>
																	<option value="38">Central African Republic</option>
																	<option value="39">Chad</option>
																	<option value="40">Chile</option>
																	<option value="41">China</option>
																	<option value="42">Colombia</option>
																	<option value="43">Comoros</option>
																	<option value="44">Congo (Brazzaville)</option>
																	<option value="45">Congo (Kinshasa)</option>
																	<option value="46">Cook Islands</option>
																	<option value="47">Costa Rica</option>
																	<option value="48">Croatia</option>
																	<option value="49">Cuba</option>
																	<option value="50">Curaçao</option>
																	<option value="51">Cyprus</option>
																	<option value="52">Czechia</option>
																	<option value="53">Côte D’Ivoire</option>
																	<option value="54">Denmark</option>
																	<option value="55">Djibouti</option>
																	<option value="56">Dominica</option>
																	<option value="57">Dominican Republic</option>
																	<option value="58">Ecuador</option>
																	<option value="59">Egypt</option>
																	<option value="60">El Salvador</option>
																	<option value="61">Equatorial Guinea</option>
																	<option value="62">Eritrea</option>
																	<option value="63">Estonia</option>
																	<option value="64">Ethiopia</option>
																	<option value="65">Falkland Islands (Islas Malvinas)</option>
																	<option value="66">Faroe Islands</option>
																	<option value="67">Fiji</option>
																	<option value="68">Finland</option>
																	<option value="69">France</option>
																	<option value="70">French Guiana</option>
																	<option value="71">French Polynesia</option>
																	<option value="72">Gabon</option>
																	<option value="73">Gambia, The</option>
																	<option value="74">Georgia</option>
																	<option value="75">Germany</option>
																	<option value="76">Ghana</option>
																	<option value="77">Gibraltar</option>
																	<option value="78">Greece</option>
																	<option value="79">Greenland</option>
																	<option value="80">Grenada</option>
																	<option value="81">Guadeloupe</option>
																	<option value="82">Guam</option>
																	<option value="83">Guatemala</option>
																	<option value="84">Guinea</option>
																	<option value="85">Guinea-Bissau</option>
																	<option value="86">Guyana</option>
																	<option value="87">Haiti</option>
																	<option value="88">Honduras</option>
																	<option value="89">Hong Kong</option>
																	<option value="90">Hungary</option>
																	<option value="91">Iceland</option>
																	<option value="92">India</option>
																	<option value="93">Indonesia</option>
																	<option value="94">Iran</option>
																	<option value="95">Iraq</option>
																	<option value="96">Ireland</option>
																	<option value="97">Isle Of Man</option>
																	<option value="98">Israel</option>
																	<option value="99">Italy</option>
																	<option value="100">Jamaica</option>
																	<option value="101">Japan</option>
																	<option value="102">Jordan</option>
																	<option value="103">Kazakhstan</option>
																	<option value="104">Kenya</option>
																	<option value="105">Kiribati</option>
																	<option value="106">Korea, North</option>
																	<option value="107">Korea, South</option>
																	<option value="108">Kosovo</option>
																	<option value="109">Kuwait</option>
																	<option value="110">Kyrgyzstan</option>
																	<option value="111">Laos</option>
																	<option value="112">Latvia</option>
																	<option value="113">Lebanon</option>
																	<option value="114">Lesotho</option>
																	<option value="115">Liberia</option>
																	<option value="116">Libya</option>
																	<option value="117">Liechtenstein</option>
																	<option value="118">Lithuania</option>
																	<option value="119">Luxembourg</option>
																	<option value="120">Macau</option>
																	<option value="121">Macedonia</option>
																	<option value="122">Madagascar</option>
																	<option value="123">Malawi</option>
																	<option value="124">Malaysia</option>
																	<option value="125">Maldives</option>
																	<option value="126">Mali</option>
																	<option value="127">Malta</option>
																	<option value="128">Marshall Islands</option>
																	<option value="129">Martinique</option>
																	<option value="130">Mauritania</option>
																	<option value="131">Mauritius</option>
																	<option value="132">Mayotte</option>
																	<option value="133">Mexico</option>
																	<option value="134">Micronesia, Federated States Of</option>
																	<option value="135">Moldova</option>
																	<option value="136">Monaco</option>
																	<option value="137">Mongolia</option>
																	<option value="138">Montenegro</option>
																	<option value="139">Morocco</option>
																	<option value="140">Mozambique</option>
																	<option value="141">Namibia</option>
																	<option value="142">Nepal</option>
																	<option value="143">Netherlands</option>
																	<option value="144">New Caledonia</option>
																	<option value="145">New Zealand</option>
																	<option value="146">Nicaragua</option>
																	<option value="147">Niger</option>
																	<option value="148">Nigeria</option>
																	<option value="149">Northern Mariana Islands</option>
																	<option value="150">Norway</option>
																	<option value="151">Oman</option>
																	<option value="152">Pakistan</option>
																	<option value="153">Palau</option>
																	<option value="154">Panama</option>
																	<option value="155">Papua New Guinea</option>
																	<option value="156">Paraguay</option>
																	<option value="157">Peru</option>
																	<option value="158">Philippines</option>
																	<option value="159">Poland</option>
																	<option value="160">Portugal</option>
																	<option value="161">Puerto Rico</option>
																	<option value="162">Qatar</option>
																	<option value="163">Reunion</option>
																	<option value="164">Romania</option>
																	<option value="165">Russia</option>
																	<option value="166">Rwanda</option>
																	<option value="167">Saint Helena, Ascension, And Tristan Da Cunha</option>
																	<option value="168">Saint Kitts And Nevis</option>
																	<option value="169">Saint Lucia</option>
																	<option value="170">Saint Vincent And The Grenadines</option>
																	<option value="171">Samoa</option>
																	<option value="172">San Marino</option>
																	<option value="173">Sao Tome And Principe</option>
																	<option value="174">Saudi Arabia</option>
																	<option value="175">Senegal</option>
																	<option value="176">Serbia</option>
																	<option value="177">Seychelles</option>
																	<option value="178">Sierra Leone</option>
																	<option value="179">Singapore</option>
																	<option value="180">Sint Maarten</option>
																	<option value="181">Slovakia</option>
																	<option value="182">Slovenia</option>
																	<option value="183">Solomon Islands</option>
																	<option value="184">Somalia</option>
																	<option value="185">South Africa</option>
																	<option value="186">South Georgia And South Sandwich Islands</option>
																	<option value="187">South Sudan</option>
																	<option value="188">Spain</option>
																	<option value="189">Sri Lanka</option>
																	<option value="190">Sudan</option>
																	<option value="191">Suriname</option>
																	<option value="192">Swaziland</option>
																	<option value="193">Sweden</option>
																	<option value="194">Switzerland</option>
																	<option value="195">Syria</option>
																	<option value="196">Taiwan</option>
																	<option value="197">Tajikistan</option>
																	<option value="198">Tanzania</option>
																	<option value="199">Thailand</option>
																	<option value="200">Timor-Leste</option>
																	<option value="201">Togo</option>
																	<option value="202">Tonga</option>
																	<option value="203">Trinidad And Tobago</option>
																	<option value="204">Tunisia</option>
																	<option value="205">Turkey</option>
																	<option value="206">Turkmenistan</option>
																	<option value="207">Turks And Caicos Islands</option>
																	<option value="208">Tuvalu</option>
																	<option value="209">Uganda</option>
																	<option value="210">Ukraine</option>
																	<option value="211">United Arab Emirates</option>
																	<option value="212">United Kingdom</option>
																	<option value="213">United States of America</option>
																	<option value="214">Uruguay</option>
																	<option value="215">Uzbekistan</option>
																	<option value="216">Vanuatu</option>
																	<option value="217">Venezuela</option>
																	<option value="218">Vietnam</option>
																	<option value="219">Wallis And Futuna</option>
																	<option value="220">West Bank</option>
																	<option value="221">Yemen</option>
																	<option value="222">Zambia</option>
																	<option value="223">Zimbabwe</option>
															</select>
						</div>
					</div>

                </div>

                <div class="card-body border-top" style="margin:0; padding:30px 0 30px 0;">

				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="occupation">อาชีพ</label>
							<select name="occupationInput" class="form-control selectpicker show-tick" id="select_occupation">
                                                                <option value="0">-- โปรดเลือก --</option>
                                                                    <option value="11">บุคลากรทางสาธารณสุข</option>
                                                                    <option value="19">พนักงานร้านอาหาร</option>
                                                                    <option value="19">พนักงานสถานบันเทิง</option>
																	<option value="20">พนักงานร้านสะดวกซื้อ/ห้างสรรพสินค้า</option>
																	<option value="21">นักกีฬา/นักมวย</option>
																	<option value="22">นักโทษ</option>
                                                                    <option value="23">ทหาร</option>
                                                                    <option value="23">ตำรวจ</option>
																	<option value="14">เจ้าหน้าที่บนเครื่องบิน</option>
																	<option value="15">เจ้าหน้าที่สนามบิน</option>
																	<option value="16">พนักงานขับรถโดยสาร</option>
																	<option value="17">มัคคุเทศก์/ไกด์ทัวร์</option>
																	<option value="18">พนักงานโรงแรม</option>
																	<option value="1">งาน/ดูแลบ้าน</option>
																	<option value="2">เกษตรกร (ปลูกพืช)</option>
																	<option value="3">เกษตรกร (เลี้ยงสัตว์)</option>
																	<option value="4">ประมง/จับสัตว์น้ำ</option>
																	<option value="5">ค้าขาย/ธุรกิจส่วนตัว</option>
																	<option value="6">พนักงานบริษัท/โรงงาน</option>
																	<option value="7">ข้าราชการ</option>
																	<option value="8">เด็กเล็ก/ในปกครง</option>
																	<option value="9">นักเรียน/นักศึกษา</option>
																	<option value="10">นักบวช</option>
																	<option value="11">บุคลากรทางสาธารณสุข</option>
																	<option value="12">รับจ้างทั่วไป/กรรมกร</option>
																	<option value="13">ว่างงาน</option>

																	<option value="13">ว่างงาน</option>
																	<option value="99">อื่นๆ</option>
															</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8 col-xl-8">
						<div class="form-group">
							<label for="occupationOth">อาชีพอื่นๆ</label>
							<input type="text" name="occupationOthInput" value="" class="form-control" id="select_occupation_oth">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group">
							<label for="dowork">ลักษณะงานที่เสี่ยงติดโรค</label>
							<input type="text" name="workContactInput" value="" class="form-control" placeholder="งานที่เสี่ยงติดโรค">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="workPlace">สถานที่ทำงาน (ระบุชื่อ)</label>
							<input type="text" name="workOfficeInput" value="" class="form-control" placeholder="สถานที่ทำงาน">
						</div>
					</div>

				</div>

			<div class="card-body border-top" style="margin:0; padding:20px 0 0 0;">
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
						<div class="form-group">
							<label for="houseNo">ที่อยู่ขณะป่วยในประเทศไทย เลขที่</label>
							<input type="text" name="sickHouseNoInput" value="" class="form-control" placeholder="บ้านเลขที่">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-1 col-xl-1">
						<div class="form-group">
							<label for="villageNo">หมู่ที่</label>
							<input type="text" name="sickVillageNoInput" value="" class="form-control" placeholder="หมู่ที่">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
						<label for="village">หมู่บ้าน/ชุมชน</label>
						<input type="text" name="sickVillageInput" value="" class="form-control" placeholder="หมู่บ้าน">
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
						<div class="form-group">
							<label for="lane">ซอย</label>
							<input type="text" name="sickLaneInput" value="" class="form-control" placeholder="ซอย">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
						<div class="form-group">
							<label for="road">ถนน</label>
							<input type="text" name="sickRoadInput" value="" class="form-control" placeholder="ถนน">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="province" class="text-success">จังหวัด</label>
							<select name="sickProvinceInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-success" id="select_sick_province">
																<option value="">-- เลือกจังหวัด --</option>
																	<option value="81" >กระบี่</option>
																	<option value="10" >กรุงเทพมหานคร</option>
																	<option value="71" >กาญจนบุรี</option>
																	<option value="46" >กาฬสินธุ์</option>
																	<option value="62" >กำแพงเพชร</option>
																	<option value="40" >ขอนแก่น</option>
																	<option value="22" >จันทบุรี</option>
																	<option value="24" >ฉะเชิงเทรา</option>
																	<option value="20" >ชลบุรี</option>
																	<option value="18" >ชัยนาท</option>
																	<option value="36" >ชัยภูมิ</option>
																	<option value="86" >ชุมพร</option>
																	<option value="92" >ตรัง</option>
																	<option value="23" >ตราด</option>
																	<option value="63" >ตาก</option>
																	<option value="26" >นครนายก</option>
																	<option value="73" >นครปฐม</option>
																	<option value="48" >นครพนม</option>
																	<option value="30" >นครราชสีมา</option>
																	<option value="80" >นครศรีธรรมราช</option>
																	<option value="60" >นครสวรรค์</option>
																	<option value="12" >นนทบุรี</option>
																	<option value="96" >นราธิวาส</option>
																	<option value="55" >น่าน</option>
																	<option value="38" >บึงกาฬ</option>
																	<option value="31" >บุรีรัมย์</option>
																	<option value="13" >ปทุมธานี</option>
																	<option value="77" >ประจวบคีรีขันธ์</option>
																	<option value="25" >ปราจีนบุรี</option>
																	<option value="94" >ปัตตานี</option>
																	<option value="14" >พระนครศรีอยุธยา</option>
																	<option value="56" >พะเยา</option>
																	<option value="82" >พังงา</option>
																	<option value="93" >พัทลุง</option>
																	<option value="66" >พิจิตร</option>
																	<option value="65" >พิษณุโลก</option>
																	<option value="83" >ภูเก็ต</option>
																	<option value="44" >มหาสารคาม</option>
																	<option value="49" >มุกดาหาร</option>
																	<option value="95" >ยะลา</option>
																	<option value="35" >ยโสธร</option>
																	<option value="85" >ระนอง</option>
																	<option value="21" >ระยอง</option>
																	<option value="70" >ราชบุรี</option>
																	<option value="45" >ร้อยเอ็ด</option>
																	<option value="16" >ลพบุรี</option>
																	<option value="52" >ลำปาง</option>
																	<option value="51" >ลำพูน</option>
																	<option value="33" >ศรีสะเกษ</option>
																	<option value="47" >สกลนคร</option>
																	<option value="90" >สงขลา</option>
																	<option value="91" >สตูล</option>
																	<option value="11" >สมุทรปราการ</option>
																	<option value="75" >สมุทรสงคราม</option>
																	<option value="74" >สมุทรสาคร</option>
																	<option value="19" >สระบุรี</option>
																	<option value="27" >สระแก้ว</option>
																	<option value="17" >สิงห์บุรี</option>
																	<option value="72" >สุพรรณบุรี</option>
																	<option value="84" >สุราษฎร์ธานี</option>
																	<option value="32" >สุรินทร์</option>
																	<option value="64" >สุโขทัย</option>
																	<option value="43" >หนองคาย</option>
																	<option value="39" >หนองบัวลำภู</option>
																	<option value="37" >อำนาจเจริญ</option>
																	<option value="41" >อุดรธานี</option>
																	<option value="53" >อุตรดิตถ์</option>
																	<option value="61" >อุทัยธานี</option>
																	<option value="34" >อุบลราชธานี</option>
																	<option value="15" >อ่างทอง</option>
																	<option value="57" >เชียงราย</option>
																	<option value="50" >เชียงใหม่</option>
																	<option value="76" >เพชรบุรี</option>
																	<option value="67" >เพชรบูรณ์</option>
																	<option value="42" >เลย</option>
																	<option value="54" >แพร่</option>
																	<option value="58" >แม่ฮ่องสอน</option>
															</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="district" class="text-success">อำเภอ</label>
							<select name="sickDistrictInput" class="form-control selectpicker show-tick" data-style="btn-outline-success" id="select_sick_district">
																<option value="">-- โปรดเลือก --</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="subDistrict" class="text-success">ตำบล</label>
							<select name="sickSubDistrictInput" class="form-control selectpicker show-tick" data-style="btn-outline-success" id="select_sick_sub_district">
																<option value="">-- โปรดเลือก --</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="form-group">
							<label for="telephone">โทรศัพท์</label>
							<input type="text" name="sickTelePhoneInput" value="" class="form-control" placeholder="โทรศัพท์">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
						</div><!-- bd-collout1 -->
						<div class="bd-callout bd-callout-custom-2" style="margin-top:0;">
							<div class="card">
	<div class="card-body" style="margin:0;padding-top:10px;padding-bottom:0">
		<h1 class="card-title m-b-0 m-t-0 text-danger">2. ข้อมูลการเจ็บป่วย</h1>
	</div>
	<ul class="list-style-none">
		<li class="card-body">
			<div class="form-row">
             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="houseNo">วันที่เริ่มป่วย</label>
						<div class="input-group date" data-provide="datepicker" id="data3_1date_sickdate">
							<div class="input-group">
								<input type="text" name="data3_1date_sickdate" value="13/03/2020" class="form-control">
								<div class="input-group-append">
									<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="villageNo">2.1 ประวัติมีไข้</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="fever_history" value="n" class="custom-control-input fever_history" id="fever_history_no"  checked >
								<label for="fever_history_no" class="custom-control-label normal-label">ไม่มี</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="fever_history" value="y" class="custom-control-input fever_history" id="fever_history_yes" >
								<label for="fever_history_yes" class="custom-control-label normal-label">มี</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="villageNo">ไข้ (องศา)</label>
						<div class="input-group">
							<input type="text" name="fever" value="37.3" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">C&#176;</span>
							</div>
						</div>
					</div>
				</div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="lane">ความเข้มข้นของOxygen (Oxygen Saturation)</label>
						<div class="input-group">
							<input type="text" name="rr_rpm" value="" class="form-control" placeholder="%">
							<div class="input-group-append">
								<span class="input-group-text">%</span>
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
								<input type="checkbox" name="sym_cough" value="y" class="custom-control-input pt-type" id="coughChk"  >
								<label for="coughChk" class="custom-control-label normal-label">ไอ</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="sym_snot" value="y" class="custom-control-input pt-type" id="snotChk" >
								<label for="snotChk" class="custom-control-label normal-label">น้ำมูก</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="sym_sore" value="y" class="custom-control-input pt-type" id="soreChk" >
								<label for="soreChk" class="custom-control-label normal-label">เจ็บคอ</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="sym_dyspnea" value="y" class="custom-control-input pt-type" id="dyspneaChk" >
								<label for="dyspneaChk" class="custom-control-label normal-label">หายใจเหนื่อย</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="sym_breathe" value="y" class="custom-control-input pt-type" id="breatheChk" >
								<label for="breatheChk" class="custom-control-label normal-label">หายใจลำบาก</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="sym_breathe" value="y" class="custom-control-input pt-type" id="breatheChk" >
								<label for="breatheChk" class="custom-control-label normal-label">มีเสมหะ</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="sym_breathe" value="y" class="custom-control-input pt-type" id="breatheChk" >
								<label for="breatheChk" class="custom-control-label normal-label">ปวดศีรษะ</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="sym_stufefy" value="y" class="custom-control-input pt-type" id="stufefyChk" >
								<label for="stufefyChk" class="custom-control-label normal-label">ถ่ายเหลว</label>
                            </div>
                        </div>
                    <div class="form-group">
						<label for="lane">อาการอื่นๆ โปรดระบุ</label>
						<div class="input-group">
							<input type="text" name="rr_rpm" value="" class="form-control" placeholder="โปรดระบุ">

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
						<label for="villageNo">2.3 สถานที่รักษา (ครั้งแรก)</label>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="province">จังหวัด (กรณี ประเทศไทย)</label>
						<select name="treatFirstProvinceInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn btn-outline-info" id="treat_first_province">
														<option value="">-- เลือกจังหวัด --</option>
							<option value="81">กระบี่</option>
							<option value="10">กรุงเทพมหานคร</option>
							<option value="71">กาญจนบุรี</option>
							<option value="46">กาฬสินธุ์</option>
							<option value="62">กำแพงเพชร</option>
							<option value="40">ขอนแก่น</option>
							<option value="22">จันทบุรี</option>
							<option value="24">ฉะเชิงเทรา</option>
							<option value="20">ชลบุรี</option>
							<option value="18">ชัยนาท</option>
							<option value="36">ชัยภูมิ</option>
							<option value="86">ชุมพร</option>
							<option value="92">ตรัง</option>
							<option value="23">ตราด</option>
							<option value="63">ตาก</option>
							<option value="26">นครนายก</option>
							<option value="73">นครปฐม</option>
							<option value="48">นครพนม</option>
							<option value="30">นครราชสีมา</option>
							<option value="80">นครศรีธรรมราช</option>
							<option value="60">นครสวรรค์</option>
							<option value="12">นนทบุรี</option>
							<option value="96">นราธิวาส</option>
							<option value="55">น่าน</option>
							<option value="38">บึงกาฬ</option>
							<option value="31">บุรีรัมย์</option>
							<option value="13">ปทุมธานี</option>
							<option value="77">ประจวบคีรีขันธ์</option>
							<option value="25">ปราจีนบุรี</option>
							<option value="94">ปัตตานี</option>
							<option value="14">พระนครศรีอยุธยา</option>
							<option value="56">พะเยา</option>
							<option value="82">พังงา</option>
							<option value="93">พัทลุง</option>
							<option value="66">พิจิตร</option>
							<option value="65">พิษณุโลก</option>
							<option value="83">ภูเก็ต</option>
							<option value="44">มหาสารคาม</option>
							<option value="49">มุกดาหาร</option>
							<option value="95">ยะลา</option>
							<option value="35">ยโสธร</option>
							<option value="85">ระนอง</option>
							<option value="21">ระยอง</option>
							<option value="70">ราชบุรี</option>
							<option value="45">ร้อยเอ็ด</option>
							<option value="16">ลพบุรี</option>
							<option value="52">ลำปาง</option>
							<option value="51">ลำพูน</option>
							<option value="33">ศรีสะเกษ</option>
							<option value="47">สกลนคร</option>
							<option value="90">สงขลา</option>
							<option value="91">สตูล</option>
							<option value="11">สมุทรปราการ</option>
							<option value="75">สมุทรสงคราม</option>
							<option value="74">สมุทรสาคร</option>
							<option value="19">สระบุรี</option>
							<option value="27">สระแก้ว</option>
							<option value="17">สิงห์บุรี</option>
							<option value="72">สุพรรณบุรี</option>
							<option value="84">สุราษฎร์ธานี</option>
							<option value="32">สุรินทร์</option>
							<option value="64">สุโขทัย</option>
							<option value="43">หนองคาย</option>
							<option value="39">หนองบัวลำภู</option>
							<option value="37">อำนาจเจริญ</option>
							<option value="41">อุดรธานี</option>
							<option value="53">อุตรดิตถ์</option>
							<option value="61">อุทัยธานี</option>
							<option value="34">อุบลราชธานี</option>
							<option value="15">อ่างทอง</option>
							<option value="57">เชียงราย</option>
							<option value="50">เชียงใหม่</option>
							<option value="76">เพชรบุรี</option>
							<option value="67">เพชรบูรณ์</option>
							<option value="42">เลย</option>
							<option value="54">แพร่</option>
							<option value="58">แม่ฮ่องสอน</option>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-6">
											<label for="dowork">สถานพยาบาลที่รักษาปัจจุบัน</label>
											<select name="isolated_hosp_code" id="isolated_hosp_code" class="form-control selectpicker" data-live-search="true">
														<option value="">เลือกสถานพยาบาลที่รักษาปัจจุบัน</option>
											</select>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="date">วันที่เข้ารักษาครั้งแรก</label>
						<div class="input-group date" data-provide="datepicker" id="treat_first_date">
							<input type="text" name="treat_first_date" value="" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="villageNo">ประเภทผู้ป่วย</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="treat_patient_type" value="opd" class="custom-control-input treat_patient_type" id="treat_patient_type_opd" >
								<label for="treat_patient_type_opd" class="custom-control-label normal-label">ผู้ป่วยนอก (OPD)</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="treat_patient_type" value="ipd" class="custom-control-input treat_patient_type" id="treat_patient_type_ipd" >
								<label for="treat_patient_type_ipd" class="custom-control-label normal-label">ผู้ป่วยใน (IPD)</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="villageNo">2.4 สถานที่รักษา (ปัจจุบัน)</label>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="province">จังหวัด</label>
						<select name="treatPlaceProvinceInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn btn-outline-cyan" id="treat_place_province">
														<option value="">-- เลือกจังหวัด --</option>
							<option value="81">กระบี่</option>
							<option value="10">กรุงเทพมหานคร</option>
							<option value="71">กาญจนบุรี</option>
							<option value="46">กาฬสินธุ์</option>
							<option value="62">กำแพงเพชร</option>
							<option value="40">ขอนแก่น</option>
							<option value="22">จันทบุรี</option>
							<option value="24">ฉะเชิงเทรา</option>
							<option value="20">ชลบุรี</option>
							<option value="18">ชัยนาท</option>
							<option value="36">ชัยภูมิ</option>
							<option value="86">ชุมพร</option>
							<option value="92">ตรัง</option>
							<option value="23">ตราด</option>
							<option value="63">ตาก</option>
							<option value="26">นครนายก</option>
							<option value="73">นครปฐม</option>
							<option value="48">นครพนม</option>
							<option value="30">นครราชสีมา</option>
							<option value="80">นครศรีธรรมราช</option>
							<option value="60">นครสวรรค์</option>
							<option value="12">นนทบุรี</option>
							<option value="96">นราธิวาส</option>
							<option value="55">น่าน</option>
							<option value="38">บึงกาฬ</option>
							<option value="31">บุรีรัมย์</option>
							<option value="13">ปทุมธานี</option>
							<option value="77">ประจวบคีรีขันธ์</option>
							<option value="25">ปราจีนบุรี</option>
							<option value="94">ปัตตานี</option>
							<option value="14">พระนครศรีอยุธยา</option>
							<option value="56">พะเยา</option>
							<option value="82">พังงา</option>
							<option value="93">พัทลุง</option>
							<option value="66">พิจิตร</option>
							<option value="65">พิษณุโลก</option>
							<option value="83">ภูเก็ต</option>
							<option value="44">มหาสารคาม</option>
							<option value="49">มุกดาหาร</option>
							<option value="95">ยะลา</option>
							<option value="35">ยโสธร</option>
							<option value="85">ระนอง</option>
							<option value="21">ระยอง</option>
							<option value="70">ราชบุรี</option>
							<option value="45">ร้อยเอ็ด</option>
							<option value="16">ลพบุรี</option>
							<option value="52">ลำปาง</option>
							<option value="51">ลำพูน</option>
							<option value="33">ศรีสะเกษ</option>
							<option value="47">สกลนคร</option>
							<option value="90">สงขลา</option>
							<option value="91">สตูล</option>
							<option value="11">สมุทรปราการ</option>
							<option value="75">สมุทรสงคราม</option>
							<option value="74">สมุทรสาคร</option>
							<option value="19">สระบุรี</option>
							<option value="27">สระแก้ว</option>
							<option value="17">สิงห์บุรี</option>
							<option value="72">สุพรรณบุรี</option>
							<option value="84">สุราษฎร์ธานี</option>
							<option value="32">สุรินทร์</option>
							<option value="64">สุโขทัย</option>
							<option value="43">หนองคาย</option>
							<option value="39">หนองบัวลำภู</option>
							<option value="37">อำนาจเจริญ</option>
							<option value="41">อุดรธานี</option>
							<option value="53">อุตรดิตถ์</option>
							<option value="61">อุทัยธานี</option>
							<option value="34">อุบลราชธานี</option>
							<option value="15">อ่างทอง</option>
							<option value="57">เชียงราย</option>
							<option value="50">เชียงใหม่</option>
							<option value="76">เพชรบุรี</option>
							<option value="67">เพชรบูรณ์</option>
							<option value="42">เลย</option>
							<option value="54">แพร่</option>
							<option value="58">แม่ฮ่องสอน</option>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-6">
											<label for="dowork">สถานพยาบาลที่รักษาปัจจุบัน</label>
											<select name="isolated_hosp_code" id="isolated_hosp_code" class="form-control selectpicker" data-live-search="true">
														<option value="">เลือกสถานพยาบาลที่รักษาปัจจุบัน</option>
											</select>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="date">วันที่</label>
						<div class="input-group date" data-provide="datepicker" id="treat_place_date">
							<input type="text" name="treat_place_date" value="" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
						</div>
					</div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="villageNo">ประเภทผู้ป่วย</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="treat_patient_type" value="opd" class="custom-control-input treat_patient_type" id="treat_patient_type_opd" >
								<label for="treat_patient_type_opd" class="custom-control-label normal-label">ผู้ป่วยนอก (OPD)</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="treat_patient_type" value="ipd" class="custom-control-input treat_patient_type" id="treat_patient_type_ipd" >
								<label for="treat_patient_type_ipd" class="custom-control-label normal-label">ผู้ป่วยใน (IPD)</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<label for="occupation">2.5 โรคประจำตัว</label>
				</div>
				<div class="card">
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="data3_3chk" value="n"  checked  class="custom-control-input chk_risk3_3" id="data3_3chkNo">
						<label for="data3_3chkNo" class="custom-control-label normal-label">ไม่มี</label>
					</div>
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" name="data3_3chk" value="y"  class="custom-control-input chk_risk3_3" id="data3_3chkYes">
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
											<input type="checkbox" name="data3_3chk_lung" value="y"  class="custom-control-input" id="data3_3chk_lung">
											<label for="data3_3chk_lung" class="custom-control-label normal-label">
												โรคปอดเรื้อรัง เช่น COPD, chronic bronchitis, chronic bronchiectasis, BPD, หรือหอบ (asthma) ที่กำลังรักษา
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr2">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="data3_3chk_heart" value="y"  class="custom-control-input" id="data3_3chk_heart">
											<label for="data3_3chk_heart" class="custom-control-label normal-label">
												โรคหัวใจ เช่น หัวใจพิการแต่กำเนิด, โรคหลอดเลือดหัวใจ หรือ Congestive heart failure
											</label>
										</div>
									</td>
								</tr>

								<tr id="risk3_3table_tr5">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="data3_3chk_diabetes" value="y"  class="custom-control-input" id="data3_3chk_diabetes">
											<label for="data3_3chk_diabetes" class="custom-control-label normal-label">
												เบาหวาน
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr6">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="data3_3chk_blood" value="y"  class="custom-control-input" id="data3_3chk_blood">
											<label for="data3_3chk_blood" class="custom-control-label normal-label">
												ความดันโลหิตสูง
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr7">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="data3_3chk_immune" value="y"  class="custom-control-input" id="data3_3chk_immune">
											<label for="data3_3chk_immune" class="custom-control-label normal-label">
												ภูมิคุ้มกันบกพร่อง
											</label>
										</div>
									</td>
								</tr>
								<tr id="risk3_3table_tr8">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="data3_3chk_anaemia" value="y"  class="custom-control-input" id="data3_3chk_anaemia">
											<label for="data3_3chk_anaemia" class="custom-control-label normal-label">
												โลหิตจาง (ธาลัสซีเมีย, sickle cell anemia)
											</label>
										</div>
									</td>
								</tr>

								<tr id="risk3_3table_tr11">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="data3_3chk_fat" value="y"  class="custom-control-input" id="data3_3chk_fat">
											<label for="data3_3chk_fat" class="custom-control-label normal-label">
												อ้วน
											</label>
										</div>
									</td>
								</tr>

								<tr id="risk3_3table_tr13">
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="data3_3chk_other" value="y" class="custom-control-input"  checked  id="data3_3chk_other">
											<label for="data3_3chk_other" class="custom-control-label normal-label">
												โรคประจำตัวอื่นๆ
											</label>
											<div class="row mt-2">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
													<div class="form-group">
														<input type="text" name="data3_3input_other"  class="form-control" value="เดินทางเข้าประเทศไทยเมื่อ มค.63  อาศัยอยู่แถวเอกมัย วันที่7มีค.63 ไปงาน color full" placeholder="อื่นๆ โปรดระบุ">
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
						<label for="">2.6 ใส่ท่อช่วยหายใจ</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control">
								<input type="checkbox" name="breathingTubeChk" value="n"  class="custom-control-input chk_breathing_Tube" id="breathingTubeChkNo">
								<label for="breathingTubeChkNo" class="custom-control-label normal-label">ไม่ใส่</label>
							</div>
							<div class="custom-control custom-checkbox custom-control">
								<input type="checkbox" name="breathingTubeChk" value="y"  class="custom-control-input chk_breathing_Tube" id="breathingTubeChkYes">
								<label for="breathingTubeChkYes" class="custom-control-label normal-label">ใส่</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="date">ระบุวันที่ใส่ท่อช่วยหายใจ</label>
						<div class="input-group date" data-provide="datepicker" id="breathing_tube_date">
							<input  type="text" name="breathing_tube_date" value="" class="form-control" readonly>
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
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 col-xl-2">
					<div class="form-group">
						<label for="informant">2.7 การรับยาต้าไวรัส COVID-19</label>
						<div class="card">
                        <div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="complicationChk" value="n"  class="custom-control-input chk_complication" id="complicationChkYes">
								<label for="complicationChkYes" class="custom-control-label normal-label">ไม่มี</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="complicationChk" value="y"  class="custom-control-input chk_complication" id="complicationChkNo">
								<label for="complicationChkNo" class="custom-control-label normal-label">มี (โปรดระบุุ)</label>
                            </div>
                            </div>
						</div>
                        <label for="treatDateInput">วันที่ได้รับยาโดสแรก</label>
						<div class="input-group date" data-provide="datepicke" id="flu_vaccine_chk_date">
							<div class="input-group">
								<input type="text" name="flu_vaccine_chk_date" value="" class="form-control" readonly>
								<div class="input-group-append">
									<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
								</div>
                            </div>
						</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="sym_cough" value="y" class="custom-control-input pt-type" id="coughChk"  >
								<label for="coughChk" class="custom-control-label normal-label">DRV/r</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="sym_snot" value="y" class="custom-control-input pt-type" id="snotChk" >
								<label for="snotChk" class="custom-control-label normal-label">LPV/r</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="sym_sore" value="y" class="custom-control-input pt-type" id="soreChk" >
								<label for="soreChk" class="custom-control-label normal-label">Favipiravir</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="sym_dyspnea" value="y" class="custom-control-input pt-type" id="dyspneaChk" >
								<label for="dyspneaChk" class="custom-control-label normal-label">Chloroquine</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="sym_breathe" value="y" class="custom-control-input pt-type" id="breatheChk" >
								<label for="breatheChk" class="custom-control-label normal-label">Hydroxychloroquine</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="sym_breathe" value="y" class="custom-control-input pt-type" id="breatheChk" >
								<label for="breatheChk" class="custom-control-label normal-label">Oseltamivir</label>
                            </div>

                        </div>
                    <div class="form-group">
						<label for="lane">ยาอื่นๆ โปรดระบุ</label>
						<div class="input-group">
							<input type="text" name="rr_rpm" value="" class="form-control" placeholder="โปรดระบุ">

						</div>
					</div>
						</div>
					</div>
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="dateInput">2.8 CBC: วันที่</label>
					<div class="input-group date" data-provide="datepicke" id="lab_cbc_date">
						<div class="input-group">
							<input type="text" name="labCbcDate" value="" class="form-control"  placeholder="ระบุวันที่"readonly>
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
							<input type="text" name="labCbcHb" value="" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">mg%</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="htcInput">Hct</label>
					<div class="input-group">
						<input type="text" name="labCbcHct" value="" class="form-control">
						<div class="input-group-append">
							<span class="input-group-text">%</span>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="wbcInput">WBC</label>
					<input type="text" name="labCbcWbc" value="" class="form-control">
				</div>
			</div>
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<div class="form-group">
						<label for="neuInput">Neutrophil</label>
						<div class="input-group">
							<input type="text" name="labCbcNeutrophil" value="" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">%</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<div class="form-group">
						<label for="lmpInput">Lymphocyte</label>
						<div class="input-group">
							<input type="text" name="labCbcLymphocyte" value="" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">%</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="plaInput">Platelet count</label>
					<div class="input-group">
						<input type="text" name="labCbcPlateletCount" value="" class="form-control">
						<div class="input-group-append">
							<span class="input-group-text">cell/ml</span>
						</div>
					</div>
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-group row">
                            <div class="col-sm-12">
                              <div class="table-responsive">
                              <table class="table" id="maintable">
                                  <thead>
								  <label for="informant">2.9 PCR for COVID-19</label>

                                    <tr>
                                      <th>PCR for COVID-19</th>
                                      <th>สถานที่ส่งตรวจ PCR of Novel Coronavirus</th>
                                      <th>ครั้งที่ตรวจ</th>
                                      <th>วันที่ตรวจ</th>
                                      <th>ตัวอย่างสิ่งส่งตรวจ</th>
                                      <th>สิ่งส่งตรวจอื่นๆ</th>
                                      <th>ผล PCR </th>

                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr class="data-contact-person">
                                      <td>
                                        <input type="text"  name="no_lab[]" value="1"  class="form-control " readonly>
                                      </td>
                                      <td>
                                        <select class="form-control" name="dms_pcr_contact[]">
                                          <option value="">- เลือก -</option>
                                          <option value="1">กรมวิทย์ฯ</option>
                                          <option value="2">สถาบันบำราศฯ</option>
                                          <option value="3">จุฬาลงกรณ์</option>
                                          <option value="4">PCR for Mers ที่อื่นๆ</option>
                                        </select>
                                      </td>
                                      <td>
                                        <input type="text" id="dms_time_contact" name="dms_time_contact[]"  class="form-control dms_time_contact01" onkeyup="autocomplet()">
                                      </td>
                                      <td>
										<div class="input-group date" data-provide="datepicke" id="lab_covid_date">
											<div class="input-group">
												<input type="text" name="labCovidDate" value="" class="form-control"  placeholder="ระบุวันที่"readonly>
												<div class="input-group-append">
													<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
												</div>
											</div>
									 </td>
                                      <td>
                                        <select class="form-control" name="dms_specimen_contact[]">
                                          <option value="">- เลือก -</option>
                                                                                    <option value="4">Throat swab</option>
                                                                                    <option value="5">Nasopharyngeal swab</option>
                                                                                    <option value="6">Nasopharyngeal aspirate</option>
                                                                                    <option value="1">TS+NPS</option>
                                                                                    <option value="7">Trachealsecretion</option>
                                                                                    <option value="8">Lower respiratory tract other</option>
                                                                                    <option value="9">Stool</option>
                                                                                    <option value="10">Urine</option>
                                                                                    <option value="99">Other</option>
                                                                                    <option value="2">Sputum</option>
                                                                                    <option value="3">Clot Blood</option>
                                                                                  </select>
                                      </td>
                                      <td>
                                        <input type="text" id="chkspec_other_contact" name="chkspec_other_contact[]"  class="form-control chkspec_other_contact01" onkeyup="autocomplet()">
                                      </td>
                                      <td>
                                        <select class="form-control" name="other_pcr_result_contact[]">
                                          <option value="">- เลือก -</option>
                                        <option value="รอผล">รอผล</option>
                                        <option value="Negative">Negative</option>
                                        <option value="Positive">Positive</option>
                                      </select>

                                    </tr>
                                    <tr class="data-contact-person">
                                      <td>
                                        <input type="text"  name="no_lab[]" value="2"  class="form-control" readonly>
                                      </td>
                                      <td>
                                        <select class="form-control" name="dms_pcr_contact[]">
                                          <option value="">- เลือก -</option>
                                          <option value="1">กรมวิทย์ฯ</option>
                                          <option value="2">สถาบันบำราศฯ</option>
                                          <option value="3">จุฬาลงกรณ์</option>
                                          <option value="4">PCR for Mers ที่อื่นๆ</option>
                                        </select>
                                      </td>
                                      <td>
                                        <input type="text" id="dms_time_contact" name="dms_time_contact[]"  class="form-control dms_time_contact01" onkeyup="autocomplet()">
                                      </td>
									  <td>
										<div class="input-group date" data-provide="datepicke" id="lab_covid2_date">
											<div class="input-group">
												<input type="text" name="labCovidDate2" value="" class="form-control"  placeholder="ระบุวันที่"readonly>
												<div class="input-group-append">
													<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
												</div>
											</div>
									 </td>
                                      <td>
                                        <select class="form-control" name="dms_specimen_contact[]">
                                          <option value="">- เลือก -</option>
                                                                                    <option value="4">Throat swab</option>
                                                                                    <option value="5">Nasopharyngeal swab</option>
                                                                                    <option value="6">Nasopharyngeal aspirate</option>
                                                                                    <option value="1">TS+NPS</option>
                                                                                    <option value="7">Trachealsecretion</option>
                                                                                    <option value="8">Lower respiratory tract other</option>
                                                                                    <option value="9">Stool</option>
                                                                                    <option value="10">Urine</option>
                                                                                    <option value="99">Other</option>
                                                                                    <option value="2">Sputum</option>
                                                                                    <option value="3">Clot Blood</option>
                                                                                  </select>
                                      </td>
                                      <td>
                                        <input type="text" id="chkspec_other_contact" name="chkspec_other_contact[]"  class="form-control chkspec_other_contact01" onkeyup="autocomplet()">
                                      </td>
                                      <td>
                                        <select class="form-control" name="other_pcr_result_contact[]">
                                          <option value="">- เลือก -</option>
                                        <option value="รอผล">รอผล</option>
                                        <option value="Negative">Negative</option>
                                        <option value="Positive">Positive</option>
                                      </select>

                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
							</div>
		</li>
		<li class="card-body border-top">

			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<label for="dateInput"> 2.10 ภาพถ่ายรังสีปอด (Chest X-ray) </label>
					<div class="input-group date" data-provide="datepicke" id="lab_cxr1_date">
						<div class="input-group">
							<input type="text" name="labCxr1Date" value="" class="form-control"placeholder="ระบุวันที่" readonly>
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
							<input type="checkbox" name="labCxr1Result" value="normal"  class="custom-control-input lab_cxr1_result" id="labCxr1ResultNormal">
							<label for="labCxr1ResultNormal" class="custom-control-label normal-label">ปกติ</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="labCxr1Result" value="unusual"  class="custom-control-input lab_cxr1_result" id="labCxr1ResultUnusual">
							<label for="labCxr1ResultUnusual" class="custom-control-label normal-label">ผิดปกติ</label>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="detail">โปรดระบุผล</label>
						<div class="input-group">
							<input type="text" name="labCxr1Detail" value="" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="fileInput" class="text-danger"> อัพโหลดรูปภาพถ่ายรังสีปอด (Chest X-ray) File</label>
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
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="rapidtest"> 2.11 Rapid test สำหรับไข้หวัด </label>
						<div class="input-group date" data-provide="datepicke" id="lab_rapid_test_date">
							<div class="input-group">
								<input type="text" name="labRapidTestDate" value="13/01/2020" class="form-control" placeholder="ระบุวันที่" readonly>
								<div class="input-group-append">
									<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--<div class="input-group">
						<input type="text" name="labRapidTestName" value="{ $invest_pt[0]['lab_rapid_test_name'] }}" class="form-control" placeholder="ระบุชื่อชุดทดสอบ">
				</div>-->
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<label for="result">ผล</label>
					<div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="labRapidTestResult" value="normal"  checked  class="custom-control-input lab_rapid_test_result" id="labRapidTestResultNagative">
							<label for="labRapidTestResultNagative" class="custom-control-label normal-label">Negative</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="labRapidTestResult" value="unusual"  class="custom-control-input lab_rapid_test_result" id="labRapidTestResultPositive">
							<label for="labRapidTestResultPositive" class="custom-control-label normal-label">Positive (โปรดระบุเชื้อ)</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="labRapidTestResult" value="unusual"  class="custom-control-input lab_rapid_test_result" id="labRapidTestResultPositive">
							<label for="labRapidTestResultPositive" class="custom-control-label normal-label">Influenza A</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" name="labRapidTestResult" value="unusual"  class="custom-control-input lab_rapid_test_result" id="labRapidTestResultPositive">
							<label for="labRapidTestResultPositive" class="custom-control-label normal-label">Influenza B</label>
						</div>

					</div>
				</div>

			</div>
		</li>
	</ul>
</div><!-- card -->
						</div><!-- bd-collout4 -->
						<div class="bd-callout bd-callout-custom-1" style="margin-top:0;">
							<div class="card">
	<div class="card-body" style="margin:0;padding-top:10px;padding-bottom:0">
		<h1 class="card-title m-b-0 m-t-0 text-danger">3. ประวัติเสี่ยงต่อการติดเชื้อ</h1>
	</div>
	<ul class="list-style-none">
		<li class="card-body">
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="risk">3.1 ในช่วง 14 วันก่อนป่วย ท่านอาศัยอยู่ หรือ มีการเดินทางมาจากพื้นที่ที่มีการระบาด</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="riskStayOutbreakChk" value="n"  class="custom-control-input chk_risk_stay_outbreak" id="riskStayOutbreakChkNo">
								<label for="riskStayOutbreakChkNo" class="custom-control-label normal-label">ไม่มี</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="riskStayOutbreakChk" value="y"  class="custom-control-input chk_risk_stay_outbreak" id="riskStayOutbreakChkYes">
								<label for="riskStayOutbreakChkYes" class="custom-control-label normal-label">มี ระบุรายละเอียดดังต่อไปนี้</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="country" class="text-info">ประเทศ (กรณีต่างประเทศ)</label>
						<select name="riskStayOutbreakCountryInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-info" id="risk_stay_outbreak_country">
														<option value="">-- เลือกประเทศ --</option>
															<option value="1">Afghanistan</option>
															<option value="2">Albania</option>
															<option value="3">Algeria</option>
															<option value="4">American Samoa</option>
															<option value="5">Andorra</option>
															<option value="6">Angola</option>
															<option value="7">Antigua And Barbuda</option>
															<option value="8">Argentina</option>
															<option value="9">Armenia</option>
															<option value="10">Aruba</option>
															<option value="11">Australia</option>
															<option value="12">Austria</option>
															<option value="13">Azerbaijan</option>
															<option value="14">Bahamas, The</option>
															<option value="15">Bahrain</option>
															<option value="16">Bangladesh</option>
															<option value="17">Barbados</option>
															<option value="18">Belarus</option>
															<option value="19">Belgium</option>
															<option value="20">Belize</option>
															<option value="21">Benin</option>
															<option value="22">Bermuda</option>
															<option value="23">Bhutan</option>
															<option value="24">Bolivia</option>
															<option value="25">Bosnia And Herzegovina</option>
															<option value="26">Botswana</option>
															<option value="27">Brazil</option>
															<option value="28">Brunei</option>
															<option value="29">Bulgaria</option>
															<option value="30">Burkina Faso</option>
															<option value="31">Burma</option>
															<option value="32">Burundi</option>
															<option value="33">Cabo Verde</option>
															<option value="34">Cambodia</option>
															<option value="35">Cameroon</option>
															<option value="36">Canada</option>
															<option value="37">Cayman Islands</option>
															<option value="38">Central African Republic</option>
															<option value="39">Chad</option>
															<option value="40">Chile</option>
															<option value="41">China</option>
															<option value="42">Colombia</option>
															<option value="43">Comoros</option>
															<option value="44">Congo (Brazzaville)</option>
															<option value="45">Congo (Kinshasa)</option>
															<option value="46">Cook Islands</option>
															<option value="47">Costa Rica</option>
															<option value="48">Croatia</option>
															<option value="49">Cuba</option>
															<option value="50">Curaçao</option>
															<option value="51">Cyprus</option>
															<option value="52">Czechia</option>
															<option value="53">Côte D’Ivoire</option>
															<option value="54">Denmark</option>
															<option value="55">Djibouti</option>
															<option value="56">Dominica</option>
															<option value="57">Dominican Republic</option>
															<option value="58">Ecuador</option>
															<option value="59">Egypt</option>
															<option value="60">El Salvador</option>
															<option value="61">Equatorial Guinea</option>
															<option value="62">Eritrea</option>
															<option value="63">Estonia</option>
															<option value="64">Ethiopia</option>
															<option value="65">Falkland Islands (Islas Malvinas)</option>
															<option value="66">Faroe Islands</option>
															<option value="67">Fiji</option>
															<option value="68">Finland</option>
															<option value="69">France</option>
															<option value="70">French Guiana</option>
															<option value="71">French Polynesia</option>
															<option value="72">Gabon</option>
															<option value="73">Gambia, The</option>
															<option value="74">Georgia</option>
															<option value="75">Germany</option>
															<option value="76">Ghana</option>
															<option value="77">Gibraltar</option>
															<option value="78">Greece</option>
															<option value="79">Greenland</option>
															<option value="80">Grenada</option>
															<option value="81">Guadeloupe</option>
															<option value="82">Guam</option>
															<option value="83">Guatemala</option>
															<option value="84">Guinea</option>
															<option value="85">Guinea-Bissau</option>
															<option value="86">Guyana</option>
															<option value="87">Haiti</option>
															<option value="88">Honduras</option>
															<option value="89">Hong Kong</option>
															<option value="90">Hungary</option>
															<option value="91">Iceland</option>
															<option value="92">India</option>
															<option value="93">Indonesia</option>
															<option value="94">Iran</option>
															<option value="95">Iraq</option>
															<option value="96">Ireland</option>
															<option value="97">Isle Of Man</option>
															<option value="98">Israel</option>
															<option value="99">Italy</option>
															<option value="100">Jamaica</option>
															<option value="101">Japan</option>
															<option value="102">Jordan</option>
															<option value="103">Kazakhstan</option>
															<option value="104">Kenya</option>
															<option value="105">Kiribati</option>
															<option value="106">Korea, North</option>
															<option value="107">Korea, South</option>
															<option value="108">Kosovo</option>
															<option value="109">Kuwait</option>
															<option value="110">Kyrgyzstan</option>
															<option value="111">Laos</option>
															<option value="112">Latvia</option>
															<option value="113">Lebanon</option>
															<option value="114">Lesotho</option>
															<option value="115">Liberia</option>
															<option value="116">Libya</option>
															<option value="117">Liechtenstein</option>
															<option value="118">Lithuania</option>
															<option value="119">Luxembourg</option>
															<option value="120">Macau</option>
															<option value="121">Macedonia</option>
															<option value="122">Madagascar</option>
															<option value="123">Malawi</option>
															<option value="124">Malaysia</option>
															<option value="125">Maldives</option>
															<option value="126">Mali</option>
															<option value="127">Malta</option>
															<option value="128">Marshall Islands</option>
															<option value="129">Martinique</option>
															<option value="130">Mauritania</option>
															<option value="131">Mauritius</option>
															<option value="132">Mayotte</option>
															<option value="133">Mexico</option>
															<option value="134">Micronesia, Federated States Of</option>
															<option value="135">Moldova</option>
															<option value="136">Monaco</option>
															<option value="137">Mongolia</option>
															<option value="138">Montenegro</option>
															<option value="139">Morocco</option>
															<option value="140">Mozambique</option>
															<option value="141">Namibia</option>
															<option value="142">Nepal</option>
															<option value="143">Netherlands</option>
															<option value="144">New Caledonia</option>
															<option value="145">New Zealand</option>
															<option value="146">Nicaragua</option>
															<option value="147">Niger</option>
															<option value="148">Nigeria</option>
															<option value="149">Northern Mariana Islands</option>
															<option value="150">Norway</option>
															<option value="151">Oman</option>
															<option value="152">Pakistan</option>
															<option value="153">Palau</option>
															<option value="154">Panama</option>
															<option value="155">Papua New Guinea</option>
															<option value="156">Paraguay</option>
															<option value="157">Peru</option>
															<option value="158">Philippines</option>
															<option value="159">Poland</option>
															<option value="160">Portugal</option>
															<option value="161">Puerto Rico</option>
															<option value="162">Qatar</option>
															<option value="163">Reunion</option>
															<option value="164">Romania</option>
															<option value="165">Russia</option>
															<option value="166">Rwanda</option>
															<option value="167">Saint Helena, Ascension, And Tristan Da Cunha</option>
															<option value="168">Saint Kitts And Nevis</option>
															<option value="169">Saint Lucia</option>
															<option value="170">Saint Vincent And The Grenadines</option>
															<option value="171">Samoa</option>
															<option value="172">San Marino</option>
															<option value="173">Sao Tome And Principe</option>
															<option value="174">Saudi Arabia</option>
															<option value="175">Senegal</option>
															<option value="176">Serbia</option>
															<option value="177">Seychelles</option>
															<option value="178">Sierra Leone</option>
															<option value="179">Singapore</option>
															<option value="180">Sint Maarten</option>
															<option value="181">Slovakia</option>
															<option value="182">Slovenia</option>
															<option value="183">Solomon Islands</option>
															<option value="184">Somalia</option>
															<option value="185">South Africa</option>
															<option value="186">South Georgia And South Sandwich Islands</option>
															<option value="187">South Sudan</option>
															<option value="188">Spain</option>
															<option value="189">Sri Lanka</option>
															<option value="190">Sudan</option>
															<option value="191">Suriname</option>
															<option value="192">Swaziland</option>
															<option value="193">Sweden</option>
															<option value="194">Switzerland</option>
															<option value="195">Syria</option>
															<option value="196">Taiwan</option>
															<option value="197">Tajikistan</option>
															<option value="198">Tanzania</option>
															<option value="199">Thailand</option>
															<option value="200">Timor-Leste</option>
															<option value="201">Togo</option>
															<option value="202">Tonga</option>
															<option value="203">Trinidad And Tobago</option>
															<option value="204">Tunisia</option>
															<option value="205">Turkey</option>
															<option value="206">Turkmenistan</option>
															<option value="207">Turks And Caicos Islands</option>
															<option value="208">Tuvalu</option>
															<option value="209">Uganda</option>
															<option value="210">Ukraine</option>
															<option value="211">United Arab Emirates</option>
															<option value="212">United Kingdom</option>
															<option value="213">United States of America</option>
															<option value="214">Uruguay</option>
															<option value="215">Uzbekistan</option>
															<option value="216">Vanuatu</option>
															<option value="217">Venezuela</option>
															<option value="218">Vietnam</option>
															<option value="219">Wallis And Futuna</option>
															<option value="220">West Bank</option>
															<option value="221">Yemen</option>
															<option value="222">Zambia</option>
															<option value="223">Zimbabwe</option>
													</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="country" class="text-info">เมือง (กรณี ต่างประเทศ)</label>
						<select name="riskStayOutbreakCityInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-info" id="select_risk_stay_outbreak_city">
														<option value="">-- โปรดเลือก --</option>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="city_other" class="text-info">เมืองอื่นๆ (กรณี ต่างประเทศ)</label>
						<input type="text" name="riskStayOutbreakCityOtherInput" value="" class="form-control border-info text-info" placeholder="เมืองอื่นๆ">
					</div>
				</div>
			</div>

			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="date">วันที่เดินทางไปถึง</label>
						<div class="input-group date" data-provide="datepicker" id="riskStayOutbreakArriveDate">
							<input  type="text" name="riskStayOutbreakArriveDate" value="" class="form-control" readonly>
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
							<input  type="text" name="riskStayOutbreakArriveThaiDate" value="" class="form-control" readonly>
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="contact">สายการบิน</label>
						<input type="text" name="riskStayOutbreakAirline" value="" class="form-control" placeholder="สายการบิน">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="contact">เที่ยวบินที่</label>
						<input type="text" name="riskStayOutbreakFlightNoInput" value="" class="form-control" placeholder="เที่ยวบินที่">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="contact">เลขที่นั่ง</label>
						<input type="text" name="riskStayOutbreakSeatNoInput" value="" class="form-control" placeholder="เลขที่นั่ง">
					</div>
				</div>
            </div>
        </li>
		<li class="card-body border-top">
            <div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="province" class="text-info">จังหวัด (กรณี ประเทศไทย)</label>
						<select name="riskStayOutbreakProvinceInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-info" id="risk_stay_outbreak_province">
														<option value="">-- เลือกจังหวัด --</option>
															<option value="81" >กระบี่</option>
															<option value="10" >กรุงเทพมหานคร</option>
															<option value="71" >กาญจนบุรี</option>
															<option value="46" >กาฬสินธุ์</option>
															<option value="62" >กำแพงเพชร</option>
															<option value="40" >ขอนแก่น</option>
															<option value="22" >จันทบุรี</option>
															<option value="24" >ฉะเชิงเทรา</option>
															<option value="20" >ชลบุรี</option>
															<option value="18" >ชัยนาท</option>
															<option value="36" >ชัยภูมิ</option>
															<option value="86" >ชุมพร</option>
															<option value="92" >ตรัง</option>
															<option value="23" >ตราด</option>
															<option value="63" >ตาก</option>
															<option value="26" >นครนายก</option>
															<option value="73" >นครปฐม</option>
															<option value="48" >นครพนม</option>
															<option value="30" >นครราชสีมา</option>
															<option value="80" >นครศรีธรรมราช</option>
															<option value="60" >นครสวรรค์</option>
															<option value="12" >นนทบุรี</option>
															<option value="96" >นราธิวาส</option>
															<option value="55" >น่าน</option>
															<option value="38" >บึงกาฬ</option>
															<option value="31" >บุรีรัมย์</option>
															<option value="13" >ปทุมธานี</option>
															<option value="77" >ประจวบคีรีขันธ์</option>
															<option value="25" >ปราจีนบุรี</option>
															<option value="94" >ปัตตานี</option>
															<option value="14" >พระนครศรีอยุธยา</option>
															<option value="56" >พะเยา</option>
															<option value="82" >พังงา</option>
															<option value="93" >พัทลุง</option>
															<option value="66" >พิจิตร</option>
															<option value="65" >พิษณุโลก</option>
															<option value="83" >ภูเก็ต</option>
															<option value="44" >มหาสารคาม</option>
															<option value="49" >มุกดาหาร</option>
															<option value="95" >ยะลา</option>
															<option value="35" >ยโสธร</option>
															<option value="85" >ระนอง</option>
															<option value="21" >ระยอง</option>
															<option value="70" >ราชบุรี</option>
															<option value="45" >ร้อยเอ็ด</option>
															<option value="16" >ลพบุรี</option>
															<option value="52" >ลำปาง</option>
															<option value="51" >ลำพูน</option>
															<option value="33" >ศรีสะเกษ</option>
															<option value="47" >สกลนคร</option>
															<option value="90" >สงขลา</option>
															<option value="91" >สตูล</option>
															<option value="11" >สมุทรปราการ</option>
															<option value="75" >สมุทรสงคราม</option>
															<option value="74" >สมุทรสาคร</option>
															<option value="19" >สระบุรี</option>
															<option value="27" >สระแก้ว</option>
															<option value="17" >สิงห์บุรี</option>
															<option value="72" >สุพรรณบุรี</option>
															<option value="84" >สุราษฎร์ธานี</option>
															<option value="32" >สุรินทร์</option>
															<option value="64" >สุโขทัย</option>
															<option value="43" >หนองคาย</option>
															<option value="39" >หนองบัวลำภู</option>
															<option value="37" >อำนาจเจริญ</option>
															<option value="41" >อุดรธานี</option>
															<option value="53" >อุตรดิตถ์</option>
															<option value="61" >อุทัยธานี</option>
															<option value="34" >อุบลราชธานี</option>
															<option value="15" >อ่างทอง</option>
															<option value="57" >เชียงราย</option>
															<option value="50" >เชียงใหม่</option>
															<option value="76" >เพชรบุรี</option>
															<option value="67" >เพชรบูรณ์</option>
															<option value="42" >เลย</option>
															<option value="54" >แพร่</option>
															<option value="58" >แม่ฮ่องสอน</option>
																				</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="district" class="text-info">อำเภอ (กรณี ประเทศไทย)</label>
						<select name="riskStayOutbreakDistrictInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-info" id="risk_stay_outbreak_district">
														<option value="">-- โปรดเลือก --</option>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="subDistrict" class="text-info">ตำบล (กรณี ประเทศไทย)</label>
						<select name="riskStayOutbreakSubDistrictInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-info" id="risk_stay_outbreak_sub_district">
														<option value="">-- โปรดเลือก --</option>
						</select>
					</div>
                </div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="contact">ระบุชื่อสถานที่เฉพาะ</label>
						<input type="text" name="riskStayOutbreakFlightNoInput" value="" class="form-control" placeholder="ระบุสถานที่เฉพาะ">
					</div>
				</div>
                <div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="date">วันที่เดินทางไปถึงพื้นที่</label>
						<div class="input-group date" data-provide="datepicker" id="riskStayOutbreakArriveDate">
							<input  type="text" name="riskStayOutbreakArriveDate" value="" class="form-control" readonly>
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="date">วันที่เดินทางออกจาก</label>
						<div class="input-group date" data-provide="datepicker" id="riskStayOutbreakArriveThaiDate">
							<input  type="text" name="riskStayOutbreakArriveThaiDate" value="" class="form-control" readonly>
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="contact">วิธีการเดินทาง</label>
                        <select name="riskStayOutbreakProvinceInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn-outline-info" id="risk_stay_outbreak_province">
														<option value="">-- เลือกวิธีการเดินทาง --</option>
															<option value="81" >รถยนต์ส่วนบุคคล</option>
															<option value="10" >รถไฟ</option>
															<option value="71" >รถทัวร์</option>
															<option value="46" >เครื่องบิน</option>
															<option value="62" >แท๊คซี่</option>
																				</select>					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="contact">บริษัท/ สายการบิน</label>
						<input type="text" name="riskStayOutbreakFlightNoInput" value="" class="form-control" placeholder="เที่ยวบินที่">
					</div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="contact">รอบที่เดินทาง / ไฟท์บิน /  หมายเลขทะเบียน (กรณีแท๊คซี่)</label>
						<input type="text" name="riskStayOutbreakFlightNoInput" value="" class="form-control" placeholder="เที่ยวบินที่">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="contact">เลขที่นั่ง / ขบวน (กรณีรถไฟ) </label>
						<input type="text" name="riskStayOutbreakSeatNoInput" value="" class="form-control" placeholder="เลขที่นั่ง">
					</div>
				</div>
            </div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="risk">3.2 ท่านมีประวัติเข้ารับการรักษาหรือเยี่ยมผู้ป่วยในโรงพยาบาลขณะอยู่ที่พื้นที่ระบาดดังกล่าวหรือไม่</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="riskTreatOrVisitPatient" value="n"  class="custom-control-input risk_treat_or_visit_patient" id="risk_treat_or_visit_patient_no">
								<label for="risk_treat_or_visit_patient_no" class="custom-control-label normal-label">ไม่ใช่</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="riskTreatOrVisitPatient" value="y"  class="custom-control-input risk_treat_or_visit_patient" id="risk_treat_or_visit_patient_yes">
								<label for="risk_treat_or_visit_patient_yes" class="custom-control-label normal-label">ใช่</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="date">ระบุวันที่เข้าโรงพยาบาล</label>
							<div class="input-group date" data-provide="datepicker" id="risk_treat_or_visit_patient_hospital_date">
								<input  type="text" name="riskTreatOrVisitPatientHospitalDate" value="" class="form-control" readonly>
								<div class="input-group-append">
									<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
								</div>
							</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
					<div class="form-group">
						<label for="province">จังหวัด</label>
						<select name="treatPlaceProvinceInput" class="form-control selectpicker show-tick" data-live-search="true" data-style="btn btn-outline-cyan" id="treat_place_province">
														<option value="">-- เลือกจังหวัด --</option>
							<option value="81">กระบี่</option>
<option value="10">กรุงเทพมหานคร</option>
<option value="71">กาญจนบุรี</option>
<option value="46">กาฬสินธุ์</option>
<option value="62">กำแพงเพชร</option>
<option value="40">ขอนแก่น</option>
<option value="22">จันทบุรี</option>
<option value="24">ฉะเชิงเทรา</option>
<option value="20">ชลบุรี</option>
<option value="18">ชัยนาท</option>
<option value="36">ชัยภูมิ</option>
<option value="86">ชุมพร</option>
<option value="92">ตรัง</option>
<option value="23">ตราด</option>
<option value="63">ตาก</option>
<option value="26">นครนายก</option>
<option value="73">นครปฐม</option>
<option value="48">นครพนม</option>
<option value="30">นครราชสีมา</option>
<option value="80">นครศรีธรรมราช</option>
<option value="60">นครสวรรค์</option>
<option value="12">นนทบุรี</option>
<option value="96">นราธิวาส</option>
<option value="55">น่าน</option>
<option value="38">บึงกาฬ</option>
<option value="31">บุรีรัมย์</option>
<option value="13">ปทุมธานี</option>
<option value="77">ประจวบคีรีขันธ์</option>
<option value="25">ปราจีนบุรี</option>
<option value="94">ปัตตานี</option>
<option value="14">พระนครศรีอยุธยา</option>
<option value="56">พะเยา</option>
<option value="82">พังงา</option>
<option value="93">พัทลุง</option>
<option value="66">พิจิตร</option>
<option value="65">พิษณุโลก</option>
<option value="83">ภูเก็ต</option>
<option value="44">มหาสารคาม</option>
<option value="49">มุกดาหาร</option>
<option value="95">ยะลา</option>
<option value="35">ยโสธร</option>
<option value="85">ระนอง</option>
<option value="21">ระยอง</option>
<option value="70">ราชบุรี</option>
<option value="45">ร้อยเอ็ด</option>
<option value="16">ลพบุรี</option>
<option value="52">ลำปาง</option>
<option value="51">ลำพูน</option>
<option value="33">ศรีสะเกษ</option>
<option value="47">สกลนคร</option>
<option value="90">สงขลา</option>
<option value="91">สตูล</option>
<option value="11">สมุทรปราการ</option>
<option value="75">สมุทรสงคราม</option>
<option value="74">สมุทรสาคร</option>
<option value="19">สระบุรี</option>
<option value="27">สระแก้ว</option>
<option value="17">สิงห์บุรี</option>
<option value="72">สุพรรณบุรี</option>
<option value="84">สุราษฎร์ธานี</option>
<option value="32">สุรินทร์</option>
<option value="64">สุโขทัย</option>
<option value="43">หนองคาย</option>
<option value="39">หนองบัวลำภู</option>
<option value="37">อำนาจเจริญ</option>
<option value="41">อุดรธานี</option>
<option value="53">อุตรดิตถ์</option>
<option value="61">อุทัยธานี</option>
<option value="34">อุบลราชธานี</option>
<option value="15">อ่างทอง</option>
<option value="57">เชียงราย</option>
<option value="50">เชียงใหม่</option>
<option value="76">เพชรบุรี</option>
<option value="67">เพชรบูรณ์</option>
<option value="42">เลย</option>
<option value="54">แพร่</option>
<option value="58">แม่ฮ่องสอน</option>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-6">
											<label for="dowork">สถานพยาบาลที่รักษาปัจจุบัน</label>
											<select name="isolated_hosp_code" id="isolated_hosp_code" class="form-control selectpicker" data-live-search="true">
														<option value="">เลือกสถานพยาบาลที่รักษาปัจจุบัน</option>
											</select>
				</div>
			</div>
		</li>

		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="risk">3.3 ในช่วง 14 วันก่อนป่วย ท่านให้การดูแลหรือสัมผัสใกล้ชิดกับผู้ป่วยอาการคล้ายไข้หวัดใหญ่/ปอดอักเสบหรือไม่</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="riskCareFluPatient" value="n"  class="custom-control-input risk_care_flu_patient" id="risk_care_flu_patient_no">
								<label for="risk_care_flu_patient_no" class="custom-control-label normal-label">ไม่ใช่</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="riskCareFluPatient" value="y"  class="custom-control-input risk_care_flu_patient" id="risk_care_flu_patient_yes">
								<label for="risk_care_flu_patient_yes" class="custom-control-label normal-label">ใช่</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="">ระบุความสัมพันธ์</label>
						<input type="text" name="riskCareFluPatientRelation" value="" class="form-control" placeholder="ความสัมพันธ์">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="contact">ระบุชื่อ (หากสามารถระบุได้)</label>
						<input type="text" name="riskCareFluPatientRelationName" value="" class="form-control" placeholder="ระบุชื่อ">
					</div>
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="risk">3.4 ในช่วง 14 วันก่อนป่วย ท่านมีประวัติสัมผัสผู้ป่วยยืนยันหรือไม่</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="riskCareFluPatient" value="n"  class="custom-control-input risk_care_flu_patient" id="risk_care_flu_patient_no">
								<label for="risk_care_flu_patient_no" class="custom-control-label normal-label">ไม่ใช่</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="riskCareFluPatient" value="y"  class="custom-control-input risk_care_flu_patient" id="risk_care_flu_patient_yes">
								<label for="risk_care_flu_patient_yes" class="custom-control-label normal-label">ใช่</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="">ชื่อ-นามสกุล</label>
						<input type="text" name="riskCareFluPatientRelation" value="" class="form-control" placeholder="ระบุชื่อ-นามสกุลของผู้ป่วยยืนยัน">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="contact">รหัสSAT ID</label>
						<input type="text" name="riskCareFluPatientRelationName" value="" class="form-control" placeholder="ระบุ SAT ID ของผู้ป่วยยืนยัน">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="">ลักษณะการสัมผัส</label>
						<input type="text" name="riskCareFluPatientRelation" value="" class="form-control" placeholder="ระบุลักษณะการสัมผัส">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="contact">ช่วงระยะเวลาที่มีการสัมผัส</label>
						<input type="text" name="riskCareFluPatientRelationName" value="" class="form-control" placeholder="ระบุช่วงระยะเวลาการสัมผัส (นาที)">
					</div>
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="">3.5 ในช่วง 14 วันก่อนป่วย ท่านประกอบอาชีพสัมผัสใกล้ชิดกับนักท่องเที่ยวต่างชาติหรือไม่</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control">
								<input type="checkbox" name="riskPatientPneumoniaDead" value="n"  class="custom-control-input risk_patient_pneumonia_dead" id="risk_patient_pneumonia_dead_no">
								<label for="risk_patient_pneumonia_dead_no" class="custom-control-label normal-label">ไม่ใช่</label>
							</div>
							<div class="custom-control custom-checkbox custom-control">
								<input type="checkbox" name="riskPatientPneumoniaDead" value="y"  class="custom-control-input risk_patient_pneumonia_dead" id="risk_patient_pneumonia_dead_yes">
								<label for="risk_patient_pneumonia_dead_yes" class="custom-control-label normal-label">ใช่</label>
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
						<label for="">3.6 ในช่วง 14 วันก่อนป่วย ท่านมีประวัติเดินทางไปในสถานที่ที่มีคนหนาแน่น เช่น ฝับ สนามมวย หรือไม่</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control">
								<input type="checkbox" name="riskCloseupFluOrPneumonia" value="n"  class="custom-control-input risk_closeup_flu_or_pneumonia" id="risk_closeup_flu_or_pneumonia_no">
								<label for="risk_closeup_flu_or_pneumonia_no" class="custom-control-label normal-label">ไม่ใช่</label>
							</div>
							<div class="custom-control custom-checkbox custom-control">
								<input type="checkbox" name="riskCloseupFluOrPneumonia" value="y"  class="custom-control-input risk_closeup_flu_or_pneumonia" id="risk_closeup_flu_or_pneumonia_yes">
								<label for="risk_closeup_flu_or_pneumonia_yes" class="custom-control-label normal-label">ใช่</label>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group">
						<label for="">ระบุชื่อสถานที่ และรายละเอียด</label>
						<input type="text" name="riskCareFluPatientRelation" value="" class="form-control" placeholder="ระบุสถานที่">
					</div>
				</div>
				</div>
			</div>
		</li>
		<li class="card-body border-top">
			<div class="form-row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group">
						<label for="">3.7 เป็นผู้ป่วยทางเดินหายใจหรือปอดอักเสบเป็นกลุ่มก้อน</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control">
								<input type="checkbox" name="riskPatientPneumoniaDead" value="n"  class="custom-control-input risk_patient_pneumonia_dead" id="risk_patient_pneumonia_dead_no">
								<label for="risk_patient_pneumonia_dead_no" class="custom-control-label normal-label">ไม่ใช่</label>
							</div>
							<div class="custom-control custom-checkbox custom-control">
								<input type="checkbox" name="riskPatientPneumoniaDead" value="y"  class="custom-control-input risk_patient_pneumonia_dead" id="risk_patient_pneumonia_dead_yes">
								<label for="risk_patient_pneumonia_dead_yes" class="custom-control-label normal-label">ใช่</label>
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
						<label for="">3.8 เป็นผู้ป่วยทางปอดอักเสบรุนแรงหรือเสียชีวิตที่หาสาเหตุไม่ได้</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control">
								<input type="checkbox" name="riskPatientPneumoniaDead" value="n"  class="custom-control-input risk_patient_pneumonia_dead" id="risk_patient_pneumonia_dead_no">
								<label for="risk_patient_pneumonia_dead_no" class="custom-control-label normal-label">ไม่ใช่</label>
							</div>
							<div class="custom-control custom-checkbox custom-control">
								<input type="checkbox" name="riskPatientPneumoniaDead" value="y"  class="custom-control-input risk_patient_pneumonia_dead" id="risk_patient_pneumonia_dead_yes">
								<label for="risk_patient_pneumonia_dead_yes" class="custom-control-label normal-label">ใช่</label>
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
						<label for="">3.9 เป็นบุคลากรทางการแพทย์</label>
						<div class="card">
							<div class="custom-control custom-checkbox custom-control">
								<input type="checkbox" name="riskPatientPneumoniaDead" value="n"  class="custom-control-input risk_patient_pneumonia_dead" id="risk_patient_pneumonia_dead_no">
								<label for="risk_patient_pneumonia_dead_no" class="custom-control-label normal-label">ไม่ใช่</label>
							</div>
							<div class="custom-control custom-checkbox custom-control">
								<input type="checkbox" name="riskPatientPneumoniaDead" value="y"  class="custom-control-input risk_patient_pneumonia_dead" id="risk_patient_pneumonia_dead_yes">
								<label for="risk_patient_pneumonia_dead_yes" class="custom-control-label normal-label">ใช่</label>
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
						<label for="contact">3.10 รายละเอียดเหตุการณ์ ประวัติเสี่ยงติดเชื้อ ก่อนเริ่มป่วย</label>
						<input type="text" name="riskHistoryHumanContactSymptomDetail" value="" class="form-control" placeholder="โปรดระบุรายละเอียด">
					</div>
				</div>
				</div>
			</div>
		</li>
	</ul>
</div><!-- card2 -->
						</div><!-- bd-collout3 -->

						<div class="border-top">
							<div class="card-body">
								<button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- modal delete confirmation -->
<div id="SavedModal" class="modal fade text-danger" role="dialog" aria-labelledby="SavedModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h5 class="modal-title text-center text-white">nCoV 2019</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true ">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="text-center">Successfully saved.</p>
			</div>
		</div>
	</div>
</div><!-- end confirmation delte -->
			<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer text-center">
	<div>กรมควบคุมโรค [COVID-19]</div>
	<div>All Rights Reserved. <a href="https://talekteam.io">Talek team</a></div>
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
		</div>
	</div>
	<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="http://viral.ddc.moph.go.th/ncov-2019/assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="http://viral.ddc.moph.go.th/ncov-2019/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="http://viral.ddc.moph.go.th/ncov-2019/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="http://viral.ddc.moph.go.th/ncov-2019/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="http://viral.ddc.moph.go.th/ncov-2019/assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="http://viral.ddc.moph.go.th/ncov-2019/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="http://viral.ddc.moph.go.th/ncov-2019/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="http://viral.ddc.moph.go.th/ncov-2019/dist/js/custom.min.js"></script>
	<script src="http://viral.ddc.moph.go.th/ncov-2019/assets/libs/jquery-blockUI/jquery.blockUI.js"></script>
<script src="http://viral.ddc.moph.go.th/ncov-2019/assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="http://viral.ddc.moph.go.th/ncov-2019/assets/libs/bootstrap-validate-2.2.0/dist/bootstrap-validate.js"></script>
<script src="http://viral.ddc.moph.go.th/ncov-2019/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
/* flash message */
$('#flash-overlay-modal').modal();
</script>
<script>
$(document).ready(function() {
	/* ajax request */
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	/* work city */
	$('#select_work_country').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "http://viral.ddc.moph.go.th/ncov-2019/country/city",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_work_city').html(response);
					$('#select_work_city').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* current city */
	$('#select_cur_country').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "http://viral.ddc.moph.go.th/ncov-2019/country/city",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_cur_city').html(response);
					$('#select_cur_city').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* sick city */
	$('#select_sick_country').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "http://viral.ddc.moph.go.th/ncov-2019/country/city",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_sick_city').html(response);
					$('#select_sick_city').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* risk_stay_outbreak_city */
	$('#risk_stay_outbreak_country').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "http://viral.ddc.moph.go.th/ncov-2019/country/city",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_risk_stay_outbreak_city').html(response);
					$('#select_risk_stay_outbreak_city').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* risk_stay_outbreak_city */
	$('#treat_first_country').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "http://viral.ddc.moph.go.th/ncov-2019/country/city",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#treat_first_city').html(response);
					$('#treat_first_city').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* treat first_city */
	$('#treat_first_country').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "http://viral.ddc.moph.go.th/ncov-2019/country/city",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#treat_first_city').html(response);
					$('#treat_first_city').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* treat place city */
	$('#treat_place_country').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "http://viral.ddc.moph.go.th/ncov-2019/country/city",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#treat_place_city').html(response);
					$('#treat_place_city').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* work district */
	$('#select_work_province').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "http://viral.ddc.moph.go.th/ncov-2019/province/district",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_work_district').html(response);
					$('#select_work_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* work sub district */
	$('#select_work_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "http://viral.ddc.moph.go.th/ncov-2019/province/district/sub-district",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_work_sub_district').html(response);
					$('#select_work_sub_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* current district */
	$('#select_cur_province').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "http://viral.ddc.moph.go.th/ncov-2019/province/district",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_cur_district').html(response);
					$('#select_cur_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* current sub district */
	$('#select_cur_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "http://viral.ddc.moph.go.th/ncov-2019/province/district/sub-district",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_cur_sub_district').html(response);
					$('#select_cur_sub_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* sick district */
	$('#select_sick_province').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "http://viral.ddc.moph.go.th/ncov-2019/province/district",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_sick_district').html(response);
					$('#select_sick_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* sick sub district */
	$('#select_sick_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "http://viral.ddc.moph.go.th/ncov-2019/province/district/sub-district",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#select_sick_sub_district').html(response);
					$('#select_sick_sub_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* outbreak district */
	$('#risk_stay_outbreak_province').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "http://viral.ddc.moph.go.th/ncov-2019/province/district",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#risk_stay_outbreak_district').html(response);
					$('#risk_stay_outbreak_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* outbreak sub district */
	$('#risk_stay_outbreak_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "http://viral.ddc.moph.go.th/ncov-2019/province/district/sub-district",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#risk_stay_outbreak_sub_district').html(response);
					$('#risk_stay_outbreak_sub_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* treat first district */
	$('#treat_first_province').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "http://viral.ddc.moph.go.th/ncov-2019/province/district",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#treat_first_district').html(response);
					$('#treat_first_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* treat first sub district */
	$('#treat_first_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "http://viral.ddc.moph.go.th/ncov-2019/province/district/sub-district",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#treat_first_sub_district').html(response);
					$('#treat_first_sub_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* treat place district */
	$('#treat_place_province').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "http://viral.ddc.moph.go.th/ncov-2019/province/district",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#treat_place_district').html(response);
					$('#treat_place_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});

	/* treat place sub district */
	$('#treat_place_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "http://viral.ddc.moph.go.th/ncov-2019/province/district/sub-district",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#treat_place_sub_district').html(response);
					$('#treat_place_sub_district').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});


	/* check box */
	$('.flu-vaccine-chk').click(function() {
		$('.flu-vaccine-chk').not(this).prop('checked', false);
	});

	$('.chk_breathing_Tube').click(function() {
		$('.chk_breathing_Tube').not(this).prop('checked', false);
	});

	$('.chk_complication').click(function() {
		$('.chk_complication').not(this).prop('checked', false);
	});

	$('.chk_antivirus').click(function() {
		$('.chk_antivirus').not(this).prop('checked', false);
	});

	$('.chk_risk_stay_outbreak').click(function() {
		$('.chk_risk_stay_outbreak').not(this).prop('checked', false);
	});

	$('.risk_history_human_contact_symptom').click(function() {
		$('.risk_history_human_contact_symptom').not(this).prop('checked', false);
	});

	$('.risk_patient_pneumonia_dead').click(function() {
		$('.risk_patient_pneumonia_dead').not(this).prop('checked', false);
	});

	$('.risk_closeup_flu_or_pneumonia').click(function() {
		$('.risk_closeup_flu_or_pneumonia').not(this).prop('checked', false);
	});

	$('.lab_sputum_culture_result').click(function() {
		$('.lab_sputum_culture_result').not(this).prop('checked', false);
	});

	$('.lab_hemoculture_result').click(function() {
		$('.lab_hemoculture_result').not(this).prop('checked', false);
	});

	$('.lab_cxr1_result').click(function() {
		$('.lab_cxr1_result').not(this).prop('checked', false);
	});

	$('.lab_cxr2_result').click(function() {
		$('.lab_cxr2_result').not(this).prop('checked', false);
	});

	$('.lab_rapid_test_result').click(function() {
		$('.lab_rapid_test_result').not(this).prop('checked', false);
	});

	$('.risk_history_human_contact').click(function() {
		$('.risk_history_human_contact').not(this).prop('checked', false);
	});

	$('.risk_eat_cook_animal').click(function() {
		$('.risk_eat_cook_animal').not(this).prop('checked', false);
	});

	$('.risk_contact_poultry').click(function() {
		$('.risk_contact_poultry').not(this).prop('checked', false);
	});

	$('.risk_poultry_dead').click(function() {
		$('.risk_poultry_dead').not(this).prop('checked', false);
	});

	$('.risk_poultry_market').click(function() {
		$('.risk_poultry_market').not(this).prop('checked', false);
	});

	$('.risk_poultry_market_ii').click(function() {
		$('.risk_poultry_market_ii').not(this).prop('checked', false);
	});

	$('.risk_treat_or_visit_patient').click(function() {
		$('.risk_treat_or_visit_patient').not(this).prop('checked', false);
	});

	$('.risk_care_flu_patient').click(function() {
		$('.risk_care_flu_patient').not(this).prop('checked', false);
	});

	$('.fever_history').click(function() {
		$('.fever_history').not(this).prop('checked', false);
	});

	$('.treat_patient_type').click(function() {
		$('.treat_patient_type').not(this).prop('checked', false);
	});

	$('.chk_risk3_3').click(function() {
		$('.chk_risk3_3').not(this).prop('checked', false);
	});

	/* date picker */
	$('#flu_vaccine_chk_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#flu_vaccine_chk_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#breathing_tube_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#antivirus_1_start_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#antivirus_1_end_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#antivirus_2_start_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#antivirus_2_end_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#antivirus_3_start_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#antivirus_3_end_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#antivirus_4_start_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#antivirus_4_end_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#risk_treat_or_visit_patient_hospital_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#cbcDateInput').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#riskStayOutbreakArriveDate').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#riskStayOutbreakArriveThaiDate').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_cbc_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_covid_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_covid2_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_chemistry_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_liver_function_test_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_sputum_afb_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_sputum_culture_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_hemoculture_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_cxr1_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_cxr2_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_rapid_test_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#lab_other_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#data3_1date_sickdate').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#treat_first_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	$('#treat_place_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

});
</script>
<script>
/* files input */
$(".custom-file-input").on("change", function() {
	var fileName = $(this).val().split("\\").pop();
	$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

</script>
</body>
</html>
