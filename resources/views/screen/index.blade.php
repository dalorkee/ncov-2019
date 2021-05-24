@extends('layouts.index')
@section('custom-style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
<!--<link rel="stylesheet" type="text/css" href="{ URL::asset('assets/libs/toastr/build/toastr.min.css') }}"> -->
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
	.font-fira {
		font-family: 'Fira-code' !important;
	}
	.input-group .bootstrap-select.form-control {
		z-index: 0;
	}
	button {
		cursor: pointer;
	}
	.has-error input[type="text"], .has-error input[type="email"], .has-error select {
		border: 1px solid #a94442;
	}
	ul.err-msg {
		list-style-type: none;
		padding: 0;
	}
	ul.err-msg li {
		margin-left: 20px;
	}
	ul.err-msg li > i {
		padding-right: 8px;
	}
	.span-80 {
		width: 80px !important;
		display: inline-block;
	}
	.child-box {
		margin: 5px 0;
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
			<h4 class="page-title">Screen Form</h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('list-data.invest') }}">Screen PUI</a></li>
						<li class="breadcrumb-item active" aria-current="page">Form</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	@include('flash::message')
	@if(Session::has('success'))
	<div class="alert alert-success">
		<i class="fas fa-check-circle"></i> {{ Session::get('success') }}
		@php
			Session::forget('success');
		@endphp
	</div>
	@elseif(Session::has('error'))
	<div class="alert alert-danger">
		<i class="fas fa-times-circle"></i> {{ Session::get('error') }}
		@php
			Session::forget('error');
		@endphp
	</div>
	@endif
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="card">
				<div class="card-body">
					<div class="d-md-flex align-items-center mb-2">
						<div>
							<h4 class="card-title">แบบฟอร์มลงทะเบียน PUI Covid 2019 รายใหม่</h4>
							<h5 class="card-subtitle">COVID-19 Version 1.3</h5>
						</div>
					</div>
					@if (count($errors) > 0)
					<div class = "alert alert-danger" style="margin-left:15px;">
						<h4 class="alert-heading"><i class=" fas fa-times-circle text-danger"></i> Error!</h4>
						<ul class="err-msg">
						    @foreach ($errors->all() as $error)
							<li><i class="mdi mdi-alert-octagon text-danger"></i> {{ $error }}</li>
						    @endforeach
						</ul>
						<hr>
						<p class="text-danger">โปรดตรวจสอบข้อมูลให้ถูกต้องอีกครั้ง ก่อนบันทึกใหม่</p>
					</div>
					@endif                    
				</div>                
			</div>
		</div>
	</div>

    <div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">	
					<label class="card-title">ข้อมูลบุคคล</label>							
					<div class="row mb-3">
						<div class="col-lg-6">										
							<div class="form-group">
								<label for="hue-demo">เลขบัตรประชาชน</label>
								<input type="text" class="form-control" id="card_id" name="card_id" maxlength="13" pattern="[0-9]{13}">
							</div>                                        
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="hue-demo">Passport</label>
								<input type="text" class="form-control" id="passport" name="passport">
							</div>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-6">										
							<div class="form-group">
								<label for="hue-demo">ชื่อ <span class="badge badge-danger">(ไม่ต้องมีคำนำหน้า)</span></label>
								<input type="text" class="form-control" id="first_name" name="first_name" required>
							</div>                                        
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="hue-demo">นามสกุล</label>
								<input type="text" class="form-control" id="last_name" name="last_name">
							</div>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-6">										
							<div class="form-group">
								<label for="hue-demo">อักษรภาษาอังกฤษตัวแรกของ ชื่อ</label>
								<input type="text" class="form-control" id="first_name" name="fname_prefix" maxlength="1" placeholder="" pattern="[a-zA-Z]{1}" required>
							</div>                                        
						</div>
						<div class="col-lg-6">										
							<div class="form-group">
								<label for="hue-demo">อักษรภาษาอังกฤษตัวแรกของ นามสกุล</label>
								<input type="text" class="form-control" id="first_name" name="lname_prefix" maxlength="1" placeholder="" pattern="[a-zA-Z]{1}" required>
							</div>                                        
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-6">										
							<div class="form-group">
								<label for="hue-demo">เพศ</label>
								<div class="custom-control custom-radio">
									<input type="radio" class="custom-control-input" id="sexm" name="sex" value="ชาย" required>
									<label class="custom-control-label" for="sexm">ชาย</label>
								</div>
								<div class="custom-control custom-radio">
									<input type="radio" class="custom-control-input" id="sexf" name="sex" value="หญิง" required>
									<label class="custom-control-label" for="sexf">หญิง</label>
								</div>
							</div>                                        
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="hue-demo">อายุ</label>
								<input type="text" class="form-control" id="age" name="age" maxlength="3" pattern="[0-9]{1,}">
							</div>
						</div>
					</div>								
					<div class="row mb-3">
						<div class="col-lg-6">										
							<div class="form-group">
								<label for="hue-demo">สัญชาติ</label>
								<select class="select2 form-control custom-select" name="nation" required>
									<option value="">เลือกสัญชาติ</option>
									<option value="1">1</option>
								</select>
							</div>                                        
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="hue-demo">เบอร์โทร</label>
								<input type="text" class="form-control" id="mobile" placeholder="0909998888" name="mobile" maxlength="10" pattern="[0-9]{9,}">
							</div>
						</div>
					</div>									
					<div class="row mb-3">
						<div class="col-lg-6">										
							<div class="form-group">
   								<label for="hue-demo">อาชีพ</label>
    							<select class="select2 form-control custom-select" name="occupation">
   									<option value="">เลือกอาชีพ</option>
									<option value="1">1</option>
								</select>
							</div>                                        
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="hue-demo">ระบุอาชีพอื่นๆ</label>
								<input type="text" class="form-control" id="occupation_oth" name="occupation_oth">
							</div>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-6">										
							<div class="form-group">
								<label for="hue-demo">ที่อยู่</label>										
								<textarea class="form-control" placeholder="บ้านเลขที่/ถนน/ซอย/ตีก/อาคาร/เลขที่ห้องชุด" name="cur_house_no"></textarea>											
							</div>                                        
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="hue-demo">หมู่ที่</label>
								<input type="text" class="form-control" id="cur_village_no" name="cur_village_no" maxlength="2" pattern="[0-9]{1,}">
							</div>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="hue-demo">จังหวัด</label>
								<select class="select2 form-control custom-select" name="cur_province"  id="cur_province">
									<option value="">เลือกจังหวัด</option>
									<option value="1"></option>
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="hue-demo">อำเภอ</label>
								<select class="select2 form-control custom-select" name="cur_district"  id="cur_district">
									<option value="">เลือกอำเภอ</option>
                                    <option value="1"></option>
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="hue-demo">ตำบล</label>
								<select class="select2 form-control custom-select" name="cur_sub_district"  id="cur_sub_district">
									<option value="">เลือกตำบล</option>
                                    <option value="1"></option>
								</select>
							</div>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-12">
							<label for="hue-demo">โรคประจำตัว</label>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="data3_3chk" name="data3_3chk" value="y">
								<label class="custom-control-label" for="data3_3chk">มี</label>
							</div>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-6">										
							<div class="form-group">
								<div class="col-md-9">
									<div class="custom-control custom-checkbox mr-sm-2">
										<input type="checkbox" class="custom-control-input" id="data3_3chk_lung" name="data3_3chk_lung" value="y">
										<label class="custom-control-label" for="data3_3chk_lung">โรคปอดเรื้อรัง</label>
									</div>
									<div class="custom-control custom-checkbox mr-sm-2">
										<input type="checkbox" class="custom-control-input" id="data3_3chk_heart" name="data3_3chk_heart" value="y">
										<label class="custom-control-label" for="data3_3chk_heart">โรคหัวใจ</label>
									</div>
									<div class="custom-control custom-checkbox mr-sm-2">
										<input type="checkbox" class="custom-control-input" id="data3_3chk_cirrhosis" name="data3_3chk_cirrhosis" value="y">
										<label class="custom-control-label" for="data3_3chk_cirrhosis">โรคตับเรื้อรัง</label>
									</div>
									<div class="custom-control custom-checkbox mr-sm-2">
										<input type="checkbox" class="custom-control-input" id="data3_3chk_kidney" name="data3_3chk_kidney" value="y">
										<label class="custom-control-label" for="data3_3chk_kidney">โรคไต,ไตวาย</label>
									</div>
    								<div class="custom-control custom-checkbox mr-sm-2">
										<input type="checkbox" class="custom-control-input" id="data3_3chk_diabetes" name="data3_3chk_diabetes" value="y">
										<label class="custom-control-label" for="data3_3chk_diabetes">เบาหวาน</label>
									</div>
									<div class="custom-control custom-checkbox mr-sm-2">
										<input type="checkbox" class="custom-control-input" id="data3_3chk_blood" name="data3_3chk_blood" value="y">
										<label class="custom-control-label" for="data3_3chk_blood">ความดันโลหิตสูง</label>
									</div>
								</div>
							</div>                                        
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<div class="col-md-9">
									<div class="custom-control custom-checkbox mr-sm-2">
										<input type="checkbox" class="custom-control-input" id="data3_3chk_immune" name="data3_3chk_immune" value="y">
										<label class="custom-control-label" for="data3_3chk_immune">ภูมิคุ้มกันบกพร่อง</label>
									</div>
									<div class="custom-control custom-checkbox mr-sm-2">
										<input type="checkbox" class="custom-control-input" id="data3_3chk_anaemia" name="data3_3chk_anaemia" value="y">
										<label class="custom-control-label" for="data3_3chk_anaemia">โลหิตจาง</label>
									</div>
									<div class="custom-control custom-checkbox mr-sm-2">
										<input type="checkbox" class="custom-control-input" id="data3_3chk_cerebral" name="data3_3chk_cerebral" value="y">
										<label class="custom-control-label" for="data3_3chk_cerebral">พิการทางสมอง</label>
									</div>
									<div class="custom-control custom-checkbox mr-sm-2">
										<input type="checkbox" class="custom-control-input" id="data3_3chk_fat" name="data3_3chk_fat" value="y">
										<label class="custom-control-label" for="data3_3chk_fat">โรคอ้วน</label>
									</div>
									<div class="custom-control custom-checkbox mr-sm-2">
    									<input type="checkbox" class="custom-control-input" id="data3_3chk_cancer" name="data3_3chk_cancer" value="y">
										<label class="custom-control-label" for="data3_3chk_cancer">มะเร็ง</label>
									</div>
									<div class="custom-control custom-checkbox mr-sm-2">
										<input type="checkbox" class="custom-control-input" id="data3_3chk_other" name="data3_3chk_other" value="y">
										<label class="custom-control-label" for="data3_3chk_other">อื่นๆ</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-12">
							<label for="hue-demo">การตั้งครรภ์</label>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="data3_3chk_pregnant" name="data3_3chk_pregnant" value="y">
								<label class="custom-control-label" for="data3_3chk_pregnant">ตั้งครรภ์</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="give_birth_than" name="give_birth_than" value="y">
								<label class="custom-control-label" for="give_birth_than">คลอดบุตรไม่เกิน2เดือน</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



    <div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<div class="form-group row">
						<label class="col-md-3">อาการป่วย</label>
						<div class="col-md-9">
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="fever_history" name="fever_history" value="y">
								<label class="custom-control-label" for="fever_history">ไข้ > 37.5</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="sym_cough" name="sym_cough" value="y">
								<label class="custom-control-label" for="sym_cough">ไอ</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="sym_snot" name="sym_snot" value="y">
								<label class="custom-control-label" for="sym_snot">น้ำมูก</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="sym_breathe" name="sym_breathe" value="y">
								<label class="custom-control-label" for="sym_breathe">หายใจเร็ว/เหนื่อยง่าย</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="sym_anosmia" name="sym_anosmia" value="y">
								<label class="custom-control-label" for="sym_anosmia">ลิ้นไม่รับรส/จมูกไม่ได้กลิ่น</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="sym_uri" name="sym_uri" value="y">
								<label class="custom-control-label" for="sym_uri">อาการทางเดินหายใจอื่น เช่น ปอดอักเสบ</label>
							</div>
						</div>
					</div>
                    <div class="form-group row">
						<label class="col-md-3 m-t-15">วันที่เริ่มป่วย</label>
						<div class="col-md-9">
                            <div class="input-group">
								<input type="text" class="form-control mydatepicker" placeholder="yyyy-mm-dd" name="data3_1date_sickdate">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
						</div>
					</div>
                    <div class="form-group row">
						<label class="col-md-3 m-t-15">จังหวัดสถานที่รักษา</label>
						<div class="col-md-9">
                            <select class="select2 form-control custom-select" name="treat_place_province" id="treat_place_province">
								<option value="">เลือกจังหวัด</option>
								<option value="1">1</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 m-t-15">สถานที่รักษา</label>
						<div class="col-md-9">
                            <select class="select2 form-control custom-select" name="treat_place_hospital" id="treat_place_hospital">
								<option value="">เลือกสถานพยาบาล</option>
                                <option value="1"></option>
							</select>
						</div>
					</div>

                    <div class="form-group row">
						<label class="col-md-3 m-t-15">ที่อยู่ขณะป่วย</label>
						<div class="col-md-9">
                            <textarea class="form-control" placeholder="บ้านเลขที่/ถนน/ซอย/ตีก/อาคาร/เลขที่ห้องชุด" name="sick_house_no"></textarea>
						</div>
					</div>
                    <div class="form-group row">
						<label class="col-md-3 m-t-15">หมู่ที่</label>
						<div class="col-md-9">
                            <input type="text" class="form-control" id="fname" name="sick_village_no" maxlength="2" pattern="[0-9]{1,}">
						</div>
					</div>
                    <div class="form-group row">
						<label class="col-md-3 m-t-15">จังหวัด</label>
						<div class="col-md-9">
                            <select class="select2 form-control custom-select" name="sick_province"  id="sick_province">
								<option value="">เลือกจังหวัด</option>
								<option value="1">1</option>
							</select>
						</div>
					</div>
                    <div class="form-group row">
						<label class="col-md-3 m-t-15">อำเภอ</label>
						<div class="col-md-9">
                            <select class="select2 form-control custom-select" name="sick_district"  id="sick_district">
								<option value="">เลือกอำเภอ</option>
                                <option value="1"></option>
							</select>
						</div>
					</div>
                    <div class="form-group row">
						<label class="col-md-3 m-t-15">ตำบล</label>
						<div class="col-md-9">
                            <select class="select2 form-control custom-select" name="sick_sub_district"  id="sick_sub_district">
								<option value="">เลือกตำบล</option>
                                <option value="1"></option>
							</select>
						</div>
					</div>
				</div>
			</div>                        
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<div class="form-group row">
						<label class="col-md-3">ประวัติเสี่ยง</label>
						<div class="col-md-9">
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="risk_stay_outbreak_chk" name="risk_stay_outbreak_chk" value="y">
								<label class="custom-control-label" for="risk_stay_outbreak_chk">มาจากพื่นที่เสี่ยง 14 วันก่อนป่วย</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="risk_contact_covid_19" name="risk_contact_covid_19" value="y">
								<label class="custom-control-label" for="risk_contact_covid_19">สัมผัสผู้ป่วยโควิด</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="be_health_personel" name="be_health_personel" value="y">
								<label class="custom-control-label" for="be_health_personel">บุคลากรทางการแพทย์</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="link_community_history" name="link_community_history" value="y">
								<label class="custom-control-label" for="link_community_history">ประวัติเชื่อมโยงกับสถานที่ชุมชน</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="during_quarantine" name="during_quarantine" value="y">
								<label class="custom-control-label" for="during_quarantine">ระหว่างกักตัว เดินทางจาก ต่างประเทศ</label>
							</div>										
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 m-t-15">ประเทศที่เดินทาง</label>
						<div class="col-md-9">
							<select class="select2 form-control custom-select" name="risk_stay_outbreak_country"  id="risk_stay_outbreak_country">
								<option value="">เลือกประเทศ</option>
								<option value="1">1</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 m-t-15">จังหวัด</label>
						<div class="col-md-9">
							<select class="select2 form-control custom-select" name="risk_province" id="risk_province">
								<option value="">เลือกจังหวัด</option>                                                                                                                                                                         
								<option value="1">1</option>						
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 m-t-15">อำเภอ</label>
						<div class="col-md-9">
							<select class="select2 form-control custom-select" name="risk_district"  id="risk_district">
								<option value="">เลือกอำเภอ</option>
                                <option value="1">1</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 m-t-15">ตำบล</label>
						<div class="col-md-9">
							<select class="select2 form-control custom-select" name="risk_sub_district"  id="risk_sub_district">
								<option value="">เลือกตำบล</option>
                                <option value="1">1</option>
							</select>
						</div>
					</div>
				</div>
			</div>                        
		</div>
	</div>




    <div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<label class="card-title">ผลตรวจทางห้องปฏิบัติการ</label>																			
					<div class="row mb-3">
						<div class="col-lg-4">
							<label class="m-t-15">ผลตรวจทางห้องปฏิบัติการ <span class="badge badge-primary"> ครั้งที่1</span></label>	
						</div>
						<div class="col-lg-4">
							<label for="hue-demo">วันที่เก็บตัวอย่าง</label>
							<div class="input-group">
								<input type="text" class="form-control mydatepicker" placeholder="yyyy-mm-dd" name="lab_sars_cov2_no_1_date">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<label for="hue-demo">ชนิดตัวอย่าง</label>			
							<select class="select2 form-control custom-select" name="lab_sars_cov2_no_1_specimen">
								<option value="">เลือกชนิดตัวอย่าง</option>
								<option value="1">1</option>
							</select>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-8">
							<label for="hue-demo">สถานที่ส่งตรวจ</label>	
							<select class="select2 form-control custom-select" name="lab_sars_cov2_no_1_lab">
								<option value="">เลือกสถานที่ตรวจ</option>
								<option value="1">1</option>
							</select>
						</div>
						<div class="col-lg-4">
							<label for="hue-demo">วันที่ออกผลการตรวจ</label>	
							<div class="input-group">
								<input type="text" class="form-control mydatepicker" placeholder="yyyy-mm-dd" name="lab_sars_cov2_no_1_result_date">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
						</div>
					</div>								
				</div>
			</div>
		</div>
	</div>


    <div class="row">
    	<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row mb-3">
    					<div class="col-lg-6">
							<label class="card-title">การคัดกรอง</label>
    						<select class="select2 form-control custom-select" name="screen_pt">
								<option value="">เลือกการคัดกรอง</option>
								<option value="1">สนามบิน</option>
								<option value="2">Walkin</option>
								<option value="3">ผู้สัมผัสยืนยันป่วย</option>
								<option value="4">State Quarantine</option>
								<option value="5">Active Case Finding</option>
								<option value="6">Sentinel Surveillance</option>
								<option value="7">คัดกรองก่อนผ่าตัด</option>
								<option value="8">PUI แพทย์สงสัย</option>
								<option value="10">Local Quarantine</option>
								<option value="11">Oraganizational Quarantine</option>
								<option value="12">Asymptomatic Infection Finding</option>
								<option value="99">อื่นๆ</option>
							</select>
						</div>
						<div class="col-lg-6">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="border-top">
		<div class="card-body">
			<button type="submit" class="btn btn-primary">ส่งข้อมูล</button>
			<input type="hidden" name="submit" value= "general">
		</div>
	</div>







</div>
@endsection
@section('bottom-script')
<script src="{{ URL::asset('assets/libs/jquery-blockUI/jquery.blockUI.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-validate-2.2.0/dist/bootstrap-validate.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({ headers:{	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    });
</script>
@endsection