@extends('layouts.app')
@section('custom-style')
<link rel="stylesheet" href="{{ URL::asset('dist/css/style.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/boefrs.css') }}">
@endsection
@section('content')
@if (Session::has('error'))
	<div class="modal fade delete-context" id="error_modal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirm" aria-hidden="true">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<div class="icon-box">
						<i class="mdi mdi-account-convert"></i>
					</div>
					<h4 style="font-size:1.275em;">COVID-19</h4>
				</div>
					<div class="modal-body">
						<div style="font-family:'sukhumvit';font-size:1.875em;color:#343A40;">{{ Session::get('error') }}</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	@php
		Session::forget('error');
	@endphp
@endif
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-white-1" style="margin-top: -50px;">
	<div class="auth-box">
			<div class="text-center"><img src="{{ URL::asset('assets/images/logo-ddc.png') }}" alt="logo"></div>
		<div id="loginform">
			<div class="text-center p-t-20 p-b-20">
				<span class="db" style="display:block;font-size:1.675em;color:black;">Coronavirus disease (COVID-19)</span>
			</div>
			<!-- Form -->
			<form method="POST" action="{{ route('login') }}" class="form-horizontal m-t-20" id="loginform">
				{{ csrf_field() }}
				<div class="row p-b-30">
					<div class="col-12">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text bg-primary text-white" id="basic-addon1"><i class="ti-user"></i></span>
							</div>
							<input id="username" type="text" class="form-control form-control-lg @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username" aria-label="E-mail" aria-describedby="basic-addon1" required autocomplete="Username" autofocus>
							@error('user')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text bg-cyan text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
							</div>
							<input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"  placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required autocomplete="current-password">
							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
				</div>
				<div class="row border-top border-secondary">
					<div class="col-12">
						<div class="form-group">
							<div class="p-t-20">
								<button  type="button" class="btn btn-success" id="to-recover"><i class="fa fa-lock m-r-5"></i> Lost password?</button>
								<button type="submit" class="btn btn-danger float-right" >{{ __('Sign in') }}</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div id="recoverform">
			<div class="text-center">
				<span class="text-white">Enter your e-mail address below and we will send you instructions how to recover a password.</span>
			</div>
			<div class="row m-t-20">
				<!-- Form -->
				<form class="col-12" action="index.html">
					<!-- email -->
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
						</div>
						<input type="text" class="form-control form-control-lg" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1">
					</div>
					<!-- pwd -->
					<div class="row m-t-20 p-t-20 border-top border-secondary">
						<div class="col-12">
							<a class="btn btn-success" href="#" id="to-login" name="action">Back To Login</a>
							<button class="btn btn-info float-right" type="button" name="action">Recover</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('bottom-script')
<script type="text/javascript">$(window).on('load',function(){$('#error_modal').modal('show');});</script>
@endsection
