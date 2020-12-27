@extends('layouts.index')
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('custom-style')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/select2/dist/css/select2.min.css') }}">
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
						<li class="breadcrumb-item active" aria-current="page">Create</li>
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
										<label for="title_name">คำนำหน้าชื่อ</label>
										<input type="text" name="title_name" class="form-control other-title-name" placeholder="Title">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="first_name">ชื่อจริง:</label>
										<input type="text" name="name" class="form-control" placeholder="Name">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="last_name">นามสกุล:</label>
										<input type="text" name="lastname" class="form-control" placeholder="Lastname">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="email">อีเมล์:</label>
										<input type="email" name="email" class="form-control" placeholder="Email">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="mobile">โทรศัพท์:</label>
										<input type="text" name="tel" class="form-control" placeholder="Mobile">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="idcard">เลขบัตร ปชช:</label>
										{!! Form::text('card_id', null, array('placeholder' => 'Position','class' => 'form-control')) !!}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="province">จังหวัด</label>
										<select name="prov_code" id="prov_code" class="form-control">
											<option value="">-- เลือกจังหวัด --</optin>
												@foreach ($provinces as $key => $value)
													<option value="{{ $key }}">{{ $value['province_name'] }}</option>
												@endforeach
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="district">อำเภอ:</label>
										<select name="ampur_code" id="ampur_code" class="form-control">
											<option value="">-- เลือกอำเภอ --</optin>
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="sub_district">ตำบล:</label>
										<select name="tambol_code" id="tambol_code" class="form-control">
											<option value="">-- เลือกตำบล --</optin>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="user_type">ประเภทผู้ใช้</label>
										<select name="user_type" id="user_type" class="form-control">
											<option value="">-- เลือกประเภทผู้ใช้ --</option>
											<option value="1">กรมควบคุมโรค</option>
											<option value="2">สำนักงานป้องกันควบคุมโรค</option>
											<option value="3">สำนักงานสาธารณสุขจังหวัด</option>
											<option value="4">โรงพยาบาล</option>
											<option value="5">ห้องปฏบัติการ (Lab)</option>
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
									<div class="form-group">
										<label for="hospcode">หน่วยงาน:</label>
										<select name="hospcode" id="hospcode" class="form-control">
											<option value="">-- เลือกหน่วยงาน --</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
									<div class="form-group">
										<label>ชื่อผู้ใช้:</label>
										{!! Form::password('username', array('placeholder' => 'Username','class' => 'form-control')) !!}
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
									<div class="form-group">
										<label>รหัสผ่าน:</label>
										{!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
									<div class="form-group">
										<label>ยืนยันรหัสผ่าน:</label>
										{!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<div class="form-group">
										<label>สิทธิ์ผู้ใช้:</label>
										{!! Form::select('roles[]', $roles, [], array('class' => 'form-control role', 'multiple')) !!}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
									<div class="form-group">
										<button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
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
			$.ajax({
				method: "POST",
				url: "{{ route('render.district') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#ampur_code').html(response);
				},
				error: function(jqXhr, textStatus, errorMessage){
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		} else {
			$('#ampur_code').html('<option value="0">-- โปรดเลือก --</option>');
		}
	});
});
</script>
@endsection
