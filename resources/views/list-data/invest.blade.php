@extends('layouts.index')
@section('custom-style')
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
/* table.dataTable td.sorting_1 { background-color: #eee; border:1px lightgrey; } */
/* table.dataTable td { background-color: red;  border:1px lightgrey;} */
table.dataTable tr.odd { background-color: #F6F6F6;  border:1px lightgrey;}
table.dataTable tr.even{ background-color: white; border:1px lightgrey; }

/* modal confirm */
.modal-confirm {
	color: #636363;
	width: 400px;
}
.modal-confirm .modal-content {
	padding: 20px;
	border-radius: 5px;
	border: none;
	text-align: center;
	font-size: 14px;
}
.modal-confirm .modal-header {
	border-bottom: none;
	position: relative;
	height: 140px;
}
.modal-confirm .modal-header:after {
	content: '';
	display: block;
	clear: both;
}
.modal-confirm .close {
	position: absolute;
	top: -5px;
	right: -2px;
}
.modal-confirm .icon-box {
	position: absolute;
	top: 6px;
	left: 140px;
	width: 80px;
	height: 80px;
	/*margin: 0 auto;*/
	border-radius: 50%;
	z-index: 9;
	/*text-align: center;*/
	border: 3px solid #f15e5e;

}
.modal-confirm .icon-box i {
	color: #f15e5e;
	font-size: 46px;
	display: inline-block;
	margin-top: 2px;
}
.modal-confirm h4 {
	width: 100%;
	text-align: center;
	font-size: 26px;
	position: absolute;
	left: 0;
	top: 90px;
	/*margin: 30px 0 -10px;*/
}

.modal-confirm .modal-body {
	color: #999;
}
.modal-confirm .modal-footer {
	border: none;
	text-align: center;
	border-radius: 5px;
	font-size: 13px;
	padding: 10px 15px 25px;
}
.modal-confirm .modal-footer a {
	color: #999;
}

.modal-confirm .btn {
	color: #fff;
	border-radius: 4px;
	background: #60c7c1;
	text-decoration: none;
	transition: all 0.4s;
	line-height: normal;
	min-width: 120px;
	border: none;
	min-height: 40px;
	border-radius: 3px;
	margin: 0 5px;
	outline: none !important;
}
.modal-confirm .btn-info {
	background: #c1c1c1;
}
.modal-confirm .btn-info:hover, .modal-confirm .btn-info:focus {
	background: #a8a8a8;
}
.modal-confirm .btn-danger {
	background: #f15e5e;
}
.modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
	background: #ee3535;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}
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
	<div class="modal fade" id="chstatus" tabindex="-1" role="dialog" aria-labelledby="changeStatus" aria-hidden="true">
		<div class="modal-dialog">
			<form name="chStatusFrm" action="{{ route('chConfirmStatusServerSide') }}" method="POST">
				{{ csrf_field() }}
				<div class="modal-content" id="ajax-status"></div>
			</form>
		</div>
	</div>
	<!-- Modal Delete confirmation-->
	<div class="modal fade delete-context" id="delete_context" tabindex="-1" role="dialog" aria-labelledby="deleteConfirm" aria-hidden="true">
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
						<h4 class="modal-title">Are you sure?</h4>
					</div>
					<div class="modal-body">
						<p>Do you really want to delete these records?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
						<input type="submit" class="btn btn-danger" value="Delete" data-dismiss>
					</div>
				</form>
			</div>
		</div>
	</div>
	{{ $dataTable->table() }}
</div><!-- flu-contrainer -->
@endsection
@section('bottom-script')
	<script src="{{ URL::asset('assets/libs/jquery-contextmenu/dist/jquery.contextMenu.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/jquery-contextmenu/dist/jquery.ui.position.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/datatables-1.10.20/datatables-1.10.20/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/datatables-1.10.20/Buttons-1.6.1/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/datatables-1.10.20/Responsive-2.2.3/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ URL::asset('vendor/datatables/buttons.server-side.js') }}"></script>
	{{ $dataTable->scripts() }}
	<script>
	$(document).ready(function() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		/* change status */
		/*
		$(document).on('click', '.chstatus', function () {
			var id = $(this).attr('value');
			$.ajax({
				method: 'POST',
				url: '{ route('ch-status') }}',
				data: {id:id},
				dataType: 'HTML',
				success: function(data) {
					//console.log(data);
					$('#ajax-status').html(data);
					$('#chstatus').modal('show');
				},
				error: function(data, status, error) {
					alert(error);
				}
			});
		}); */
		/* change status */
		/*
		$(document).on('click', '.delete-context', function () {
			var id = $(this).attr('value');
			$.ajax({
				method: 'POST',
				url: '{ route('ch-status') }}',
				data: {id:id},
				dataType: 'HTML',
				success: function(data) {
					//console.log(data);
					$('#ajax-status').html(data);
					$('#chstatus').modal('show');
				},
				error: function(data, status, error) {
					alert(error);
				}
			});
		});*/
		/* context nav */
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
					case 'labGen':
						window.open('http://viral.ddc.moph.go.th/viral/lab/genlab.php?idx=' + satid, '_blank');
						break;
					case 'labResult':
						window.open('http://viral.ddc.moph.go.th/viral/lab/labfollow.php?idx=' + satid, '_blank');
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
						@if (auth()->user()->id == 2 || auth()->user()->id == 76)
							$('#del_id').val(id);
							let x = $('#del_id').val();
							$('.delete-context').modal('show');
						@else
							alert('Permission denie.');
						@endif
						break;
					default:
						alert('Something went wrong!');
						break;
				}
			},
			items: {
				"chStatus": {name: "Change status", icon: "fas fa-check-circle"},
				"sep1": "---------",
				"labGen": {name: "Generate lab", icon: "fas fa-barcode"},
				"labResult": {name: "Lab result", icon: "fas fa-flask"},
				"contact": {name: "Contact", icon: "fas fa-handshake"},
				"sep2": "---------",
				"edit": {name: "Edit", icon: "fas fa-edit"},
				"delete": {name: "Delete", icon: "fas fa-trash-alt"},
				"sep3": "---------",
				"quit": {name: "Quit", icon: function($element, key, item){ return 'context-menu-icon context-menu-icon-quit'; }}
			}
		});
	});
	</script>
	<script>
		$('#flash-overlay-modal').modal();
	</script>
@endsection
