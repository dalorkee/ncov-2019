@extends('layouts.index')
@section('custom-style')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/jquery-contextmenu/dist/jquery.contextMenu.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
@endsection
@section('internal-style')
<style>
	.page-wrapper {background: white !important;}
	table.table:hover {cursor: pointer;}
	table.table tbody tr.odd {background-color: red;  border:1px lightgrey;}
	table.table tbody tr.even {background-color: white; border:1px lightgrey;}
	table.table tbody tr:last-child {border-bottom: 1px solid #bbb;}
</style>
@endsection
@section('top-script')
<script src="{{ URL::asset('assets/libs/select2-4.0.13/dist/js/select2.min.js') }}"></script>
<script>
$(document).ready(function() {
	$('#chstatus .myselect').select2({
		placeholder: 'Select a State',
		allowClear: true
	});
});
</script>
@endsection
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">Invest Search</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Data</a></li>
						<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('list-data.invest') }}">Search</a></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	@if (Session::has('success'))
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-2 mb-2">
			<div class="alert alert-success">
				<i class="fas fa-check-circle"></i> {{ Session::get('success') }}
				@php Session::forget('success'); @endphp
			</div>
		</div>
	</div>
	@elseif(Session::has('error'))
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-2 mb-2">
			<div class="alert alert-danger">
				<i class="fas fa-times-circle"></i> {{ Session::get('error') }}
				@php Session::forget('error'); @endphp
			</div>
		</div>
	</div>
	@elseif(Session::has('warning'))
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-2 mb-2">
			<div class="alert alert-warning">
				<i class="fa fa-exclamation-circle"></i> {{ Session::get('warning') }}
				@php Session::forget('warning'); @endphp
			</div>
		</div>
	</div>
	@endif
	<form action="{{ route('admin.createHospToJson') }}" method="POST">
		@csrf
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label for="country" class="text-info">เลือกจังหวัด</label>
					<select name="province_id" class="form-control selectpicker show-tick">
						<option value="0">-- โปรดเลือก --</option>
						@foreach ($provinces as $key => $value)
							<option value="{{ $value->province_id }}">{{ $value->province_name }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="form-group">
					<label>&nbsp;</label>
					<div class="input-group">
						<button type="submit" class="btn btn-primary">Create JSON</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div><!-- flu-contrainer -->
@endsection
@section('bottom-script')
<script src="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-contextmenu/dist/jquery.contextMenu.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-contextmenu/dist/jquery.ui.position.min.js') }}"></script>
@endsection
