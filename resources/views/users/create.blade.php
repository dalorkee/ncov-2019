@extends('layouts.index')
@section('custom-style')
<link type="text/css" href="{{ URL::asset('admindek/css/style.css') }}" rel="stylesheet" >
@endsection
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('custom-style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
<style>
	label>span {
		padding-left: 10px;
		color: red;
	}
</style>
@endsection
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">Create user</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
						<li class="breadcrumb-item active" aria-current="page"><a href="#">Create</a></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="d-md-flex align-items-center" style="border-bottom:1px solid #EAEAEA">
						<div>
							<h4 class="card-title">เพิ่มผู้ใช้ใหม่</h4>
							<h5 class="card-subtitle">DDC Covid-19</h5>
						</div>
					</div>
					<div class="my-4">
						@if (count($errors) > 0)
							<div class="alert alert-danger">
								<strong>Whoops!</strong> There were some problems with your input.<br><br>
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						{!! Form::open(array('route'=>'users.store', 'method'=>'POST', 'class'=>'mt-4 mb-3')) !!}
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="title_name">คำนำหน้าชื่อ<span>*</span></label>
										<select name="title_name" id="title_name" class="form-control selectpicker show-tick">
											<option value="">-- โปรดเลือก --</option>
											<option value="1">นาย</option>
											<option value="2">นาง</option>
											<option value="3">นางสาว</option>
											<option value="4">ด.ช.</option>
											<option value="5">ด.ญ.</option>
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="first_name">ชื่อจริง:<span>*</span></label>
										<input type="text" name="name" class="form-control" placeholder="Name">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="last_name">นามสกุล:<span>*</span></label>
										<input type="text" name="lname" class="form-control" placeholder="Lastname">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="email">อีเมล์:<span>*</span></label>
										<input type="email" name="email" class="form-control" placeholder="Email">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="mobile">โทรศัพท์:<span>*</span></label>
										<input type="text" name="tel" id="tel" class="form-control" placeholder="Mobile">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="idcard">เลขบัตร ปชช:<span>*</span></label>
										<input type="text" name="card_id" id="card_id" class="form-control" placeholder="ID Card">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="province">จังหวัด<span>*</span></label>
										<select name="prov_code" id="prov_code" class="form-control selectpicker show-tick" data-live-search="true">
											<option value="">-- เลือกจังหวัด --</option>
												@foreach ($provinces as $key => $value)
													<option value="{{ $key }}">{{ $value }}</option>
												@endforeach
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="district">อำเภอ:</label>
										<select name="ampur_code" id="ampur_code" class="form-control selectpicker show-tick" data-live-search="true">
											<option value="">-- เลือกอำเภอ --</option>
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="sub_district">ตำบล:</label>
										<select name="tambol_code" id="tambol_code" class="form-control selectpicker show-tick" data-live-search="true">
											<option value="">-- เลือกตำบล --</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<div class="form-group">
										<label for="hospcode">หน่วยงาน:<span>*</span></label>
										<select name="hospcode" id="hospcode" class="form-control selectpicker show-tick" data-live-search="true">
											<option value="">-- เลือกหน่วยงาน --</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
									<div class="form-group">
										<label>ชื่อผู้ใช้:<span>*</span></label>
										<input type="text" name="username" id="username" class="form-control" placeholder="Username">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
									<div class="form-group">
										<label>รหัสผ่าน:<span>* (อย่างน้อย 6 ตัวอักษร)</span></label>
										<input type="password" name="password" id="password" class="form-control" placeholder="Password">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
									<div class="form-group">
										<label>ยืนยันรหัสผ่าน:<span>*</span></label>
										<input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" >
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="usergroup">กลุ่มผู้ใช้:<span>*</span></label>
										<select name="usergroup" id="usergroup" class="form-control selectpicker show-tick">
											@role('root')
											<option value="">-- เลือกกลุ่ม --</option>
											<option value="-1">ผู้ดูแลระบบ</option>
											@endrole
											@foreach ($user_group as $key => $val)
												<option value="{{ $key }}">{{ $val }}</option>
											@endforeach
										</select>
									</div>
								</div>
								@role('root')
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="user-permissions">สิทธิ์สร้างผู้ใช้:</label>
										<select name="create_user_permission" id="create_user_permission" class="form-control selectpicker show-tick">
											<option value="n">-- เลือกสิทธิ์ --</option>
											<option value="y">Y</option>
											<option value="n">N</option>
										</select>
									</div>
								</div>
								@endrole
								@role('ddc|dpc|pho|hos|lab')
								<input type="hidden" name="create_user_permission" value="n">
								@endrole
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 m-t-40">
									<div class="form-group">
										<input type="submit" value="บันทึกข้อมูล" class="btn btn-primary">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('bottom-script')
<script src="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
<script>
$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#prov_code').change(function() {
		if ($(this).val() != "0") {
			var id = $(this).val();
			var idx = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('render.district') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#ampur_code').html(response);
					$('#ampur_code').selectpicker("refresh");
					$('#tambol_code').html('<option value="">-- โปรดเลือก --</option>');
					$('#tambol_code').selectpicker("refresh");
					$.ajax({
						method: "POST",
						url: "{{ route('render.hosp') }}",
						dataType: "HTML",
						data: {idx:idx},
						success: function(res) {
							$('#hospcode').html(res);
							$('#hospcode').selectpicker("refresh");
						},
						error: function(xhr, status, error){
							alert('Error code: ' + xhr.status + error);
						}
					});
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});

		} else {
			$('#ampur_code').html('<option value="">-- โปรดเลือก --</option>');
			$('#tambol_code').html('<option value="">-- โปรดเลือก --</option>');
			$('#hospcode').html('<option value="">-- โปรดเลือก --</option>');
		}
	});
	$('#ampur_code').change(function() {
		if ($(this).val() != "0") {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('render.sub.district') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#tambol_code').html(response);
					$('#tambol_code').selectpicker("refresh");
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		} else {
			$('#tambol_code').html('<option value="">-- โปรดเลือก --</option>');
		}
	});
});
</script>
@endsection
