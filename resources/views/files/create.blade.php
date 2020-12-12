@extends('layouts.index')
@section('custom-style')
	<link rel="stylesheet" href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/libs/jquery-contextmenu/dist/jquery.contextMenu.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/DataTables-1.10.20/css/jquery.dataTables.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/Buttons-1.6.1/css/buttons.dataTables.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/Responsive-2.2.3/css/responsive.dataTables.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/libs/select2-4.0.13/dist/css/select2.min.css') }}">
@endsection
@section('internal-style')
<style>
.page-wrapper {
	background: white !important;
}
.dataTables_wrapper, .dataTables_wrapper .badge {
	width: 100% !important;
	font-family: 'Fira-code', tahoma !important;
	font-size: .875em;
}
.dataTables_wrapper .badge {
	padding: 4px;
	font-size: .875em;
	text-align: left;
}
#files-table {
	width: 100% !important;
}
.link-colab {
	color: #FF1543;
}
/* table.dataTable td.sorting_1 { background-color: #eee; border:1px lightgrey; } */
/* table.dataTable td { background-color: red;  border:1px lightgrey;} */
table.dataTable tr.odd { background-color: #F6F6F6;  border:1px lightgrey;}
table.dataTable tr.even{ background-color: white; border:1px lightgrey; }
</style>
@endsection
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contents')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<div>
				<h4 class="page-title">รายการอับโหลดไฟล์</h4>
				<div><span class="badge">Sat ID: {{ $patient[0]['sat_id'] }}</span></div>
			</div>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('list-data.invest') }}">Files</a></li>
						<li class="breadcrumb-item active" aria-current="page">List</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
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
	@if (count($errors) > 0)
		<div class = "alert alert-danger" style="margin-left:15px;width:100%;">
			<h4 class="alert-heading"><i class=" fas fa-times-circle text-danger"></i> Error!</h4>
			<ul class="err-msg">
				@foreach ($errors->all() as $error)
					<li> {{ $error }}</li>
				@endforeach
			</ul>
			<hr>
			<p class="text-danger">โปรดตรวจสอบข้อมูลให้ถูกต้องอีกครั้ง ก่อนบันทึกใหม่</p>
		</div>
	@endif
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">อับโหลดไฟล์ใหม่ <i class="fas fa-upload"></i></button>
	{{$dataTable->table()}}
	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="referConfirm" aria-hidden="true" style="font-family:'sukhumvit'">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-danger"><i class="fas fa-file-medical"></i> อับโหลดไฟล์ <span class="text-info"></span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form name="newFileFrm" class="was-validated" action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<div class="alert alert-warning">Mimes: jpeg, png, svg, txt, csv, xls, doc, pdf & Max: 2 MB <span class="text-info"></span></div>
								<input type="hidden" name="pid" value="{{ $patient[0]['id'] }}">
								<input type="hidden" name="sat_id" value="{{ $patient[0]['sat_id'] }}">
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<div class="form-group">
									<label for="fileType">ประเภทไฟล์</label>
									<select name="file_upload_type" class="form-control custom-selec selectpicker show-tick" id="file_upload_type" required>
										<option value="">-- โปรดเลือก --</option>
										@foreach ($file_type as $key => $value)
											<option value="{{ $key }}">{{ $value }}</option>
										@endforeach
									</select>
									<div class="invalid-feedback">โปรดเลือกชนิดไฟล์</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<div class="form-group">
									<label for="fileDetail">รายละเอียดไฟล์</label>
									<textarea name="file_detail" class="form-control" id="file_detail"></textarea>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<div class="custom-file">
									<input type="file" name="file_upload" class="custom-file-input" id="validatedCustomFile" required>
									<label class="custom-file-label" id="validatedCustomFileLable" for="validatedCustomFile">Choose file...</label>
									<div class="invalid-feedback">โปรดเลือกไฟล์ที่ต้องการอับโหลด</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" id="cancel" data-dismiss="modal">ยกเลิก</button>
						<input type="submit" class="btn btn-success" id="submit" value="บันทึกข้อมูล">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modal Delete confirmation-->
	<div class="modal fade delete-context" id="delete_context" tabindex="-1" role="dialog" aria-labelledby="deleteConfirm" aria-hidden="true" style="font-family:'sukhumvit'">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content" id="confirm_delete">
				<form name="deleteContext" action="{{ route('file.delete') }}" method="POST">
					{{ csrf_field() }}
					<input type="hidden" name="fid" id="fid">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<div class="icon-box">
							<i class="mdi mdi-close"></i>
						</div>
						<h4 class="modal-title">ยืนยันการลบข้อมูล?</h4>
					</div>
					<div class="modal-body">
						<p class="alert alert-warning font-16">เงื่อนไขการลบ: เป็นผู้กรอกข้อมูล</p>
						<p class="text-danger font-18">คุณต้องการลบข้อมูลออกจากระบบฯ ใช่หรือไม่ ?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-info" data-dismiss="modal">ยกเลิก</button>
						<input type="submit" class="btn btn-danger" value="ลบทันที" data-dismiss>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('bottom-script')
<script src="{{ URL::asset('assets/libs/jquery-blockUI/jquery.blockUI.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-validate-2.2.0/dist/bootstrap-validate.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-contextmenu/dist/jquery.contextMenu.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-contextmenu/dist/jquery.ui.position.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables-1.10.20/DataTables-1.10.20/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables-1.10.20/Buttons-1.6.1/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables-1.10.20/Responsive-2.2.3/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('vendor/datatables/buttons.server-side.js') }}"></script>
{{ $dataTable->scripts() }}
<script type="text/javascript">
	$('#validatedCustomFile').on('change', function() {
		var fileName = $(this).val();
		$(this).next('.custom-file-label').html(fileName);
	});

	$('#cancel').on('click', function() {
		$('#file_upload_type').val(null).trigger('change');
		$('#file_detail').val('');
		$('#validatedCustomFile').val('');
		$('.custom-file-label').html('');
	});
</script>
<script>
$(document).ready(function() {
	$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
	$.contextMenu({
		selector: '.context-nav',
		trigger: 'left',
		className: 'data-title',
		callback: function(key, options) {
			var id = $(this).data('id');
			switch (key) {
				case 'download':
					let furl = '{{ route("file.download", ":id") }}';
					furl = furl.replace(':id', id);
					window.location.replace(furl);
					break;
				case 'delete':
						$('#fid').val(id);
						$('.delete-context').modal('show');
					break;
				default:
					break;
			}
		},
		items: {
			"download": {name: "ดาวน์โหลด", icon: "fas fa-download"},
			"delete": {name: "ลบข้อมูล", icon: "fas fa-trash-alt"},
			"sep5": "---------",
			"quit": {name: "ปิด", icon: function($element, key, item){ return 'context-menu-icon context-menu-icon-quit'; }}
		}
	});
});
</script>
@endsection
