@extends('layouts.index')
@section('custom-style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
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
	.btn-outline-gray {
		border: 1px solid #E4E5E9 !important;
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
			<h4 class="page-title">Genome Form</h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('list-data.invest') }}">Genome</a></li>
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
							<h4 class="card-title">แบบฟอร์ม Genome ของผู้ป่วยโรคปอดอักเสบจากเชื้อไวรัสโคโรนาสายพันธุ์ใหม่ 2019</h4>
							<h5 class="card-subtitle">COVID-19 Version 1.20</h5>
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
					<form method="POST" action="{{ route('invest.store') }}" enctype="multipart/form-data" class="form-horizontal">
						{{ csrf_field() }}
						<div class="bd-callout bd-callout-info" style="margin-top:0;position:relative">
							<div style="position:absolute;top:10px;right:10px;z-index:1">
								<span class="btn btn-info font-weight-bold font-fira">{{ $data->sat_id }}</span>
							</div>
							<div class="card">
								<div class="card-body">
									<h1 class="text-info">1. ข้อมูลส่งตรวจ Genome</h1>
									<input type="hidden" name="id" value="">
									<div class="card">
										<div class="card-body" style="margin:0; padding:0 0 30px 0;">
											<div class="form-row">
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
													<div class="form-group">
														<label for="genome_id">รหัส</label>
														<div class="input-group">
															<input type="text" name="genome_id" value="{{ old('genome_id') ?? $data->genome_id }}" class="form-control" readonly>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
													<div class="form-group">
														<label for="genome_date_send">วันที่ส่งตรวจ</label>
														<div class="input-group date">
															<div class="input-group-append">
																<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
															</div>
															<input type="text" name="genome_date_send" value="{{ old('genome_date_send') ?? $data->genome_date_send }}" data-provide="datepicker" class="form-control border-outline border-gray" id="genome_date_send" readonly>
															<div class="input-group-append">
																<button type="button" class="input-group-text text-danger" id="cls_genome_date_send"><i class="fas fa-times"></i></button>
															</div>
														</div>
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
													<div class="form-group">
														<label for="gnome_lab_place">สถานที่ส่งตรวจ</label>
														<select name="gnome_lab_place" class="form-control selectpicker show-tick" data-style="btn btn-outline-gray" id="gnome_lab_place">
															<option value="">-- โปรดเลือก --</option>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
													<div class="form-group">
														<label for="genome_method">วิธีการตรวจ</label>
														<select name="genome_method" class="form-control selectpicker show-tick" data-style="btn btn-outline-gray" id="genome_method">
															<option value="">-- โปรดเลือก --</option>
														</select>
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
													<div class="form-group">
														<label for="status">วิธีการตรวจอื่นๆ ระบุ</label>
														<div class="input-group">
															<input type="text" name="genome_method_other" value="{{ old('genome_method_other') ?? $data->genome_method_other }}" class="form-control" placeholder="โปรดระบุ">
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
													<div class="form-group">
														<label for="genome_lab_result">ผลการตรวจ</label>
														<select name="genome_lab_result" class="form-control selectpicker show-tick" data-style="btn btn-outline-gray" id="genome_lab_result">
															<option value="">-- โปรดเลือก --</option>
															<option value="1">ไม่ตรวจ</option>
														</select>
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
													<div class="form-group">
														<label for="genome_date_lab_result">วันที่รายงานผลการตรวจ</label>
														<div class="input-group date">
															<div class="input-group-append">
																<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
															</div>
															<input type="text" name="genome_date_lab_result" value="{{ old('genome_date_lab_result') ?? $data->genome_date_lab_result }}" data-provide="datepicker" class="form-control border-outline border-gray" id="genome_date_lab_result" readonly>
															<div class="input-group-append">
																<button type="button" class="input-group-text text-danger" id="cls_genome_date_lab_result"><i class="fas fa-times"></i></button>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
													<div class="form-group">
														<label for="genome_comment">หมายเหตุ</label>
														<div class="input-group">
															<textarea name="genome_comment" class="form-control">{{ old('genome_comment')?? $data->genome_comment }}</textarea>
														</div>
													</div>
												</div>
											</div>
											<div class="border-top">
												<div class="card-body">
													<button type="submit" class="btn btn-primary pt-2 pr-4 pb-2 pl-4">Save</button>
													<button type="reset" class="btn btn-danger pt-2 pr-4 pb-2 pl-4">Reset</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
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
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	$('#cls_genome_date_send').click(function() {
		$('#genome_date_send').val("");
	});
	$('#genome_date_send').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});
	$('#cls_genome_date_lab_result').click(function() {
		$('#genome_date_lab_result').val("");
	});
	$('#genome_date_lab_result').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});
});
</script>
@endsection
