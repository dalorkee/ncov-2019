@extends('layouts.index')
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
							<h4 class="card-title">บริหารจัดการผู้ใช้งานระบบ</h4>
							<h5 class="card-subtitle">เพิ่มผู้ใช้ใหม่</h5>
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
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
									<div class="form-group">
										<label for="titleName">คำนำหน้าชื่อ</label>
										<input type="text" name="title_name" class="form-control other-title-name" placeholder="คำนำหน้าชื่อ">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
									<div class="form-group">
										<label for="fname">ชื่อจริง:</label>
										{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
									<div class="form-group">
										<label for="fname">นามสกุล:</label>
										<input type="text" name="lastname" placeholder="Lastname" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
									<div class="form-group">
										<label>อีเมล์:</label>
										{!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
									<div class="form-group">
										<label>รหัสผ่าน:</label>
										{!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
									<div class="form-group">
										<label>ยืนยันรหัสผ่าน:</label>
										{!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
									<div class="form-group">
										<label>Role:</label>
										{!! Form::select('roles[]', $roles, [], array('class' => 'form-control role', 'multiple')) !!}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Create</button>
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
	<script src="{{ URL::asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
@endsection
