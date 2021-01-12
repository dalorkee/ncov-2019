@extends('layouts.index')
@section('custom-style')
<link type="text/css" href="{{ URL::asset('admindek/css/style.css') }}" rel="stylesheet" >
@endsection
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">User show</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
						<li class="breadcrumb-item active" aria-current="page"><a href="#">Manage</a></li>
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
							<h5 class="card-subtitle">DDC Covid-19</h5>
						</div>
					</div>
					<div class="row my-4">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group"><strong class="text-info">ชื่อ-สกุล:</strong> {{ $user->name.' '.$user->lname }}</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group"><strong class="text-info">ชื่อผู้ใช้:</strong> {{ $user->username }}</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group"><strong class="text-info">อีเมล์:</strong> {{ $user->email }}</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group"><strong class="text-info">หน่วยงาน:</strong> {{ $user_hosp_name[(int)$user->hospcode] }}</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group"><strong class="text-info">กลุ่มผู้ใช้:</strong> {{ $user_group[$user->usergroup] }}</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group"><strong class="text-info">สิทธิ์ผู้ใช้:</strong>
								@if(!empty($user->getRoleNames()))
									@foreach($user->getRoleNames() as $v)
										<span class="badge badge-success">{{ $v }}</span>
									@endforeach
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
