@extends('layouts.index')
@section('custom-style')
	<link rel="stylesheet" href="{{ URL::asset('assets/libs/jquery-contextmenu/dist/jquery.contextMenu.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/datatables-1.10.20/css/jquery.dataTables.min.css') }}">
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
						<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('list-data.sat') }}">Invest</a></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<!-- Modal change status-->
	<div class="modal fade" id="chstatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form name="chStatusFrm" action="{{ route('chConfirmStatusServerSide') }}" method="POST">
				{{ csrf_field() }}
				<div class="modal-content" id="ajax-status"></div>
			</form>
		</div>
	</div>
	<a href="{{ route('screenpui.create') }}" type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="เพิ่มผู้ป่วยรายใหม่"><i class="fas fa-user-plus"></i> New Patient</a>
	{{ $dataTable->table() }}
</div><!-- flu-contrainer -->
@endsection
@section('bottom-script')
	<script src="{{ URL::asset('assets/libs/jquery-contextmenu/dist/jquery.contextMenu.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/jquery-contextmenu/dist/jquery.ui.position.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/datatables-1.10.20/datatables-1.10.20/js/jquery.dataTables.min.js') }}"></script>
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
		});
		*/
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
						let scurl = '{{ route("screenpui.edit", ":id") }}';
						scurl = scurl.replace(':id', id);
						//window.location.replace(scurl);
						window.open(scurl, '_blank');
						break;
					case 'delete':
						//alert('Permission denied !');
						<?php if(auth()->user()->id=='535' || auth()->user()->id=='405'){ ?>
							let dcurl = '{{ route("screenpui.satdel", ":id") }}';
							dcurl = dcurl.replace(':id', id);
							if(confirm('ต้องการลบข้อมูลใช่หรือไม่')==true){
								window.location.replace(dcurl);
							}else{
								alert('You selected to cancel.');
							}
						<?php }else{ ?>
							alert('Permission denied !');
					  <?php	} ?>
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

@endsection
