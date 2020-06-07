@extends('layouts.index')
@section('custom-style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/libs/jquery-contextmenu/dist/jquery.contextMenu.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/datatables-1.10.20/css/jquery.dataTables.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/Buttons-1.6.1/css/buttons.dataTables.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/Responsive-2.2.3/css/responsive.dataTables.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/libs/select2-4.0.13/dist/css/select2.min.css') }}">
@endsection
@section('internal-style')
<style>
.page-wrapper {
	background: white !important;
}
.dataTables_wrapper {
	width: 100% !important;
	font-family: 'Fira-code', tahoma !important;
}
#list-data-table {
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
			<h4 class="page-title"><span style="display:none;">Invest List</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Data</a></li>
						<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('list-data.invest') }}">Invest</a></li>
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
	<!-- Modal change status-->
	<div class="modal fade" id="chstatus" tabindex="-1" role="dialog" aria-labelledby="changeStatus" aria-hidden="true" style="font-family:'sukhumvit'">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="chStatusFrm" action="{{ route('chConfirmStatusServerSide') }}" method="POST">
					{{ csrf_field() }}
					<div id="ajax-status"></div>
				</form>
			</div>
		</div>
	</div>
	<!-- modal refer out -->
	<div class="modal fade" id="refer_out" tabindex="-1" role="dialog" aria-labelledby="referConfirm" aria-hidden="true" style="font-family:'sukhumvit'">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="refer" action="{{ route('store.refer') }}" method="POST">
					{{ csrf_field() }}
					<div id="ajax-refer"></div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modal Delete confirmation-->
	<div class="modal fade delete-context" id="delete_context" tabindex="-1" role="dialog" aria-labelledby="deleteConfirm" aria-hidden="true" style="font-family:'sukhumvit'">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content" id="confirm_delete">
				<form name="deleteContext" action="{{ route('invest.delete') }}" method="POST">
					{{ csrf_field() }}
					<input type="hidden" name="pid" id="del_id">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<div class="icon-box">
							<i class="mdi mdi-close"></i>
						</div>
						<h4 class="modal-title">ยืนยันการลบข้อมูล?</h4>
					</div>
					<div class="modal-body">
						<p class="alert alert-warning font-16">เงื่อนไข: สถานะไม่เท่ากับ Confirmed และวันที่ลงข้อมูลไม่เกิน 3 วัน และเป็นผู้กรอกข้อมูล</p>
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
	{{ $dataTable->table() }}
</div><!-- flu-contrainer -->
@endsection
@section('bottom-script')
	<script src="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/jquery-contextmenu/dist/jquery.contextMenu.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/jquery-contextmenu/dist/jquery.ui.position.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/datatables-1.10.20/datatables-1.10.20/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/datatables-1.10.20/Buttons-1.6.1/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/datatables-1.10.20/Responsive-2.2.3/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ URL::asset('vendor/datatables/buttons.server-side.js') }}"></script>
	{{ $dataTable->scripts() }}
	<?php
	$ts = time();
	$signature = "bd6efdd618ef8e481ba2e247b10735b801fbdefe";
	$uid = Auth::user()->id;
	$sig = sha1($uid.$ts.$signature);
	$url_gen_lab = "http://viral.ddc.moph.go.th/viral/token.php?uid=".$uid."&ts=".$ts."&sig=".$sig."&typelab=1";
	$url_lab_result = "http://viral.ddc.moph.go.th/viral/token.php?uid=".$uid."&ts=".$ts."&sig=".$sig."&typelab=2";
	?>
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
					case 'chStatus':
						$.ajax({
							method: 'POST',
							url: '{{ route('ch-status') }}',
							data: {id:id},
							dataType: 'HTML',
							success: function(data) {
								$('#ajax-status').html(data);
								$('#chstatus').modal('show');
							},
							error: function(data, status, error) {
								alert(error);
							}
						});
						break;
					case 'refer':
						$('#refer_pid').val(id);
						$.ajax({
							method: 'POST',
							url: '{{ route('refer') }}',
							data: {id:id},
							dataType: 'HTML',
							success: function(data) {
								$('#ajax-refer').html(data);
								$('#refer_out').modal('show');
							},
							error: function(data, status, error) {
								alert(error);
							}
						});
						break;
					case 'labSendColab':
						//window.open('<php echo $url_gen_lab;>&idx=' + satid, '_blank');
						let labSendUrl = '{{ route('colab.send', ':id') }}';
						labSendUrl = labSendUrl.replace(':id', id);
						window.open(labSendUrl, '_blank');
						break;
					case 'labResultColab':
						let labResultUrl = '{{ route('colab.result', ':id') }}';
						labResultUrl = labResultUrl.replace(':id', id);
						window.open(labResultUrl, '_blank');
						break;
					case 'labResult':
						window.open('<?php echo $url_lab_result; ?>&idx=' + satid, '_blank');
						break;
					case 'contact':
						let cturl = '{{ route("contacttable", ":id") }}';
						cturl = cturl.replace(':id', id);
						window.location.replace(cturl);
						break;
					case 'edit':
						let cfurl = '{{ route("invest.create", ":id") }}';
						cfurl = cfurl.replace(':id', id);
						window.open(cfurl, '_blank');
						break;
					case 'delete':
							$('#del_id').val(id);
							//let x = $('#del_id').val();
							$('.delete-context').modal('show');
						break;
					case 'files':
						let furl = '{{ route("file.list", ":id") }}';
						furl = furl.replace(':id', id);
						window.location.replace(furl);
					default:
						break;
				}
			},
			items: {
				"chStatus": {name: "เปลี่ยนสถานะ", icon: "fas fa-check-circle"},
				"refer": {name: "ส่งต่อผู้ป่วย", icon: "fas fa-ambulance"},
				"sep1": "---------",
				"labSendColab": {name: "ส่งแลป", icon: "fas fa-external-link-alt", className: 'link-colab'},
				"labResultColab": {name: "ดูผลแลป", icon: "fas fa-external-link-alt", className: 'link-colab'},
				"labResult": {name: "ดูผลแลป (ก่อนวันที่ 23 พ.ค. 63)", icon: "fas fa-flask"},
				"sep2": "---------",
				"files": {name: "ไฟล์อับโหลด", icon: "fas fa-file"},
				"sep3": "---------",
				"contact": {name: "ผู้สัมผัส", icon: "fas fa-handshake"},
				"sep4": "---------",
				"edit": {name: "แก้ไขข้อมูล (Invest Form:2)", icon: "fas fa-edit"},
				"delete": {name: "ลบข้อมูล", icon: "fas fa-trash-alt"},
				"sep5": "---------",
				"quit": {name: "ปิด", icon: function($element, key, item){ return 'context-menu-icon context-menu-icon-quit'; }}
			}
		});
	});
	</script>
	<script>
		$('#flash-overlay-modal').modal();
	</script>
@endsection
