@extends('layouts.index')
@section('custom-style')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/jquery-contextmenu/dist/jquery.contextMenu.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('admindek/css/style.css') }}">
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
	@endif
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-2 mb-2">
			<form action="{{ route('invest.search') }}" method="GET" class="form-inline">
				@csrf
				<input type="text" name="str_search" class="form-control" placeholder="ค้นหาจาก SAT ID" style="height:45px;width:36%;">
				<div class="input-group-append">
					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-2 mb-2">
			<div class="table-responsive">
			<table class="table table-hover font-fira">
				<thead class="text-info">
					<tr>
						<th>รหัส</th>
						<th>SAT ID</th>
						<th>ชื่อ-นามสกุล</th>
						<th style="text-align:right;">#</th>
					</tr>
				</thead>
				<tfoot></tfoot>
				<tbody>
				@if (count($data) > 0)
					@foreach ($data as $key => $val)
						<tr>
							<td>{{ $val->id }}</td>
							<td>{{ $val->sat_id }}</td>
							<td>{{ $val->first_name.' '.$val->mid_name.' '.$val->last_name }}
							<td style="text-align:right;"><button class="context-nav btn btn-custom-1 btn-sm" data-satid="{{ $val->sat_id }}" data-id="{{ $val->id }}">Manage <i class="fas fa-angle-down"></i></button></td>
						</tr>
					@endforeach
				@endif
				</tbody>
			</table>
			</div>
			@if (count($data) > 0)
				{{ $data->links() }}
			@endif
		</div>
	</div>
</div><!-- flu-contrainer -->
@endsection
@section('bottom-script')
<script src="{{ URL::asset('assets/libs/jquery-contextmenu/dist/jquery.contextMenu.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-contextmenu/dist/jquery.ui.position.min.js') }}"></script>
<script>
$(document).ready(function() {
	$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
	$.contextMenu({
		selector: '.context-nav',
		trigger: 'left',
		className: 'data-title',
		callback: function(key, options) {
			var id = $(this).data('id');
			var satid = $(this).data('satid');
			switch (key) {
				case 'labSendColab':
					let labSendUrl = '{{ route('colab.send', ':id') }}';
					labSendUrl = labSendUrl.replace(':id', id);
					window.open(labSendUrl, '_self');
					break;
				case 'labResultColab':
					let labResultUrl = '{{ route('colab.result', ':id') }}';
					labResultUrl = labResultUrl.replace(':id', id);
					window.open(labResultUrl, '_self');
					break;
				case 'edit':
					let cfurl = '{{ route("invest.create", ":id") }}';
					cfurl = cfurl.replace(':id', id);
					window.open(cfurl, '_self');
					break;
				case 'files':
					let furl = '{{ route("file.list", ":id") }}';
					furl = furl.replace(':id', id);
					window.open(furl, '_self');
				default:
					break;
			}
		},
		items: {
			"edit": {name: "แก้ไขข้อมูล (Invest Form:2)", icon: "fas fa-edit"},
			"sep1": "---------",
			"labSendColab": {name: "ส่งแลป (Colab)", icon: "fas fa-link", className: 'link-colab'},
			"labResultColab": {name: "ดูผลแลป (Colab)", icon: "fas fa-flask", className: 'link-colab'},
			"sep2": "---------",
			"files": {name: "ไฟล์อับโหลด", icon: "fas fa-upload"},
			"sep3": "---------",
			"quit": {name: "ปิด", icon: function($element, key, item){ return 'context-menu-icon context-menu-icon-quit'; }}
		}
	});
});
</script>
@endsection
