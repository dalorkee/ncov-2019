@extends('layouts.index')
@section('custom-style')
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/datatables.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/Buttons-1.6.1/css/buttons.bootstrap4.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/Responsive-2.2.3/css/responsive.bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/libs/select2/dist/css/select2.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/libs/toastr/build/toastr.min.css') }}">
@endsection
@section('internal-style')
<style>
@media
	only screen
	and (max-width: 760px), (min-device-width: 768px)
	and (max-device-width: 1024px)  {
	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr {
		display: block !important;
	}
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr {
		position: absolute !important;
		top: -9999px !important;
		left: -9999px !important;
	}
	tr {
		margin: 0 0 1rem 0 !important;
	}
	tr:nth-child(odd) {
		background: #eee;
	}
	td {
		/* Behave like a "row" */
		/* border: none; */
		border-bottom: 1px solid #eee;
		position: relative !important;
		padding-left: 50% !important;
	}
	td:before {
		/* Now like a table header */
		position: absolute !important;
		/* Top/left values mimic padding */
		top: 0 !important;
		left: 6px !important;
		width: 45% !important;
		padding-right: 10px !important;
		white-space: nowrap !important;
	}
	/* Label the data */
	td:nth-of-type(1):before { content: "ลำดับ";margin-top:10px;font-weight:600;}
	td:nth-of-type(2):before { content: "ชื่อ-สกุล";margin-top:10px;font-weight:600;}
	td:nth-of-type(3):before { content: "HN";margin-top:10px;font-weight:600;}
	td:nth-of-type(4):before { content: "รหัส";margin-top:10px;font-weight:600;}
	td:nth-of-type(5):before { content: "รหัส รพ.";margin-top:10px;font-weight:600;}
	td:nth-of-type(6):before { content: "สถานะ";margin-top:10px;font-weight:600;}
	td:nth-of-type(7):before { content: "จัดการ";margin-top:10px;text-align:left!important;font-weight:600;}
}
/* end media */

.error{
	display: none;
	margin-left: 10px;
}

.error_show{
	color: red;
	margin-left: 10px;
}
input.invalid, textarea.invalid{
	border: 2px solid red;
}

input.valid, textarea.valid{
	border: 2px solid green;
}
.dataTables_wrapper {
	font-family: tahoma !important;
}
</style>
@endsection
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contents')
@php
	//$titleName = $titleName->all();
	$user_hospital_name = Session::get('user_hospital_name');
	$provinces = Session::get('provinces');
@endphp
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">Invest List</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Data</a></li>
						<li class="breadcrumb-item active" aria-current="page">Lists PUI</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<div class="d-md-flex align-items-center mb-2">
				<div>
					<h4 class="card-title">แบบสอบสวนของผู้ป่วยโรคปอดอักเสบจากเชื้อไวรัสโคโรนาสายพันธุ์ใหม่ 2019</h4>
					<h5 class="card-subtitle">2019-nCoV</h5>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<div id="patient_data">
								<table class="table display mb-4" id="code_table" role="table">
									<thead>
										<tr>
											<th>ID</th>
											<th>SAT_ID</th>
											<th>Patient</th>
											<th>News</th>
											<th>Discharge</th>
											<th>เพศ</th>
											<th>สัญชาติ</th>
											<th>#</th>
										</tr>
									</thead>
									<tfoot></tfoot>
									<tbody>
										@if ($invest)
											@foreach ($invest as $key => $value)
												<tr>
													<td>{{ $value['id'] }}</td>
													<td>{{ $value['sat_id'] != "" ? $value['sat_id'] : "-" }}</td>
													<td><span class="text-danger">{{ $value['pt_status'] != "" ? $status['pt_status'][$value['pt_status']] : "-" }}</span></td>
													<td><span class="text-info">{{ $value['news_st'] != "" ? $status['news_st'][$value['news_st']] : "-" }}</span></td>
													<td><span class="text-success">{{ $value['disch_st'] != "" ? $status['disch_st'][$value['disch_st']] : "-" }}</span></td>
													<td>{{ $value['sex'] != "" ? $value['sex'] : "-" }}</td>
													<td>{{ $value['race'] != "" ? $value['race'] : "-" }}</span></td>
													<td>
														<button type="button" class="btn btn-warning btn-sm margin-5 text-white" data-toggle="modal" title="Status" data-target="#chstatus{{ $value['id'] }}">
															<i class="mdi mdi-table-edit"></i>
														</button>
														<a href="#" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="View"><i class="mdi mdi-eye"></i></a>&nbsp;
														<!-- <button href="#" data-toggle="tooltip" data-placement="top" class="btn btn-warning btn-sm" title="Comming soon" disabled>PUI</button>&nbsp; -->
														<a href="{{ route('screenpui.edit',$value['id'])}}" class="btn btn-warning btn-sm" >Edit</a>
														<!-- <a href="{ route("confirmForm", ["id"=>$value['id']]) }}" data-toggle="tooltip" data-placement="top" class="btn btn-warning btn-sm" title="PUI">PUI</a>&nbsp; -->
														<a href="{{ 'contacttable' }}?id={{ $value['id'] }}&poe_id={{ $value['poe_id'] }}" data-toggle="tooltip" data-placement="top" class="btn btn-cyan btn-sm" title="Contact">CON</a>&nbsp;
														<a href="javascript:" type="button" data-toggle="modal" onclick="deleteData({{ $value['id'] }})" data-target="#DeleteModal" class="btn btn-danger btn-sm"><i class="mdi mdi-delete-empty"></i></button>
													</td>
												</tr>
											@endforeach
										@endif
									</tbody>
								</table>
							</div>
						</div><!-- card body -->
					</div><!-- card -->
				</div><!-- column -->
			</div><!-- row -->
		</div><!-- card body -->
	</div><!-- card -->
	<!-- modal delete confirmation -->
	<div id="DeleteModal" class="modal fade text-danger" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true ">
		<div class="modal-dialog" role="document">
			<!-- Modal content-->
			<form action="" id="deleteForm" method="post">
				<div class="modal-content">
					<div class="modal-header bg-danger">
						<h5 class="modal-title text-center text-white">DELETE CONFIRMATION</h5>
						<button type="button" class="close" data-dismiss="modal aria-label="Close"">
							<span aria-hidden="true ">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<p class="text-center">Are You Sure Want To Delete ?</p>
					</div>
					<div class="modal-footer">
						<center>
							<button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
							<button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Yes, Delete</button>
						</center>
					</div>
				</div>
			</form>
		</div>
	</div><!-- end confirmation delte -->
	@if ($invest)
		@foreach ($invest as $key => $value)
			<!-- Modal change status-->
			<div class="modal fade" id="chstatus{{ $value['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<form name="chStatusFrm{{ $value['id'] }}" action="{{ route('chConfirmStatus') }}" method="POST">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Status ID:{{ $value['id'] }}</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{ $value['id'] }}">
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
										<div class="form-group">
											<label for="patient">Patient</label>
											<select name="pt_status" class="form-control selectpicker show-tick" id="pt_status{{ $value['id'] }}">
												@if (!empty($value['pt_status']))
													<option value="{{ $value['pt_status'] }}" selected="selected">{{ $status['pt_status'][$value['pt_status']] }}</option>
												@endif
												<option value="">-- โปรดเลือก --</option>
												@foreach ($status['pt_status'] as $pts_key => $pts_value)
													<option value="{{ $pts_key }}">{{ $pts_value }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
										<div class="form-group">
											<label for="news">News</label>
											<select name="news_status" class="form-control selectpicker show-tick" id="news_status{{ $value['id'] }}">
												@if (!empty($value['news_st']))
													<option value="{{ $value['news_st'] }}" selected="selected">{{ $status['news_st'][$value['news_st']] }}</option>
												@endif
												<option value="">-- โปรดเลือก --</option>
												@foreach ($status['news_st'] as $nst_key => $nst_value)
													<option value="{{ $nst_key }}">{{ $nst_value }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
										<div class="form-group">
											<label for="sex">Discharge</label>
												<select name="disch_st" class="form-control selectpicker show-tick" id="disch_st{{ $value['id'] }}">
													@if (!empty($value['disch_st']))
														<option value="{{ $value['disch_st'] }}" selected="selected">{{ $status['disch_st'][$value['disch_st']] }}</option>
													@endif
												<option value="">-- โปรดเลือก --</option>
												@foreach ($status['disch_st'] as $dst_key => $dst_value)
													<option value="{{ $dst_key }}">{{ $dst_value }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<input type="submit" class="btn btn-primary" value="Save changes">
							</div>
						</div>
					</form>
				</div>
			</div>
		@endforeach
	@endif
</div><!-- contrainer -->
@endsection
@section('bottom-script')
<script src="{{ URL::asset('assets/libs/datatables-1.10.20/datatables.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables-1.10.20/Buttons-1.6.1/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables-1.10.20/Responsive-2.2.3/js/responsive.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
<script>
$(document).ready(function() {
	/* ajax request */
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	/* data table */
	$('#code_table').DataTable({
		"searching": true,
		"paging": true,
		"pageLength": 25,
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		"ordering": true,
		"info": false,
		responsive: false,
		columnDefs: [{
			targets: -1,
			className: 'dt-head-right dt-body-right'
		}],
		dom: 'frti"<bottom"Bp>',
		buttons: [
			{extend: 'copy', text: '<i class="far fa-copy"></i>', titleAttr: 'Copy', className: 'btn btn-outline-danger'},
			{extend: 'csv', text: '<i class="far fa-file-alt"></i>', titleAttr: 'CSV', className: 'btn btn-outline-danger'},
			{extend: 'excel', text: '<i class="far fa-file-excel"></i>', titleAttr: 'Excel', className: 'btn btn-outline-danger'},
			{extend: 'pdf', text: '<i class="far fa-file-pdf"></i>', titleAttr: 'PDF', className: 'btn btn-outline-danger'},
			{extend: 'print', text: '<i class="fas fa-print"></i>', titleAttr: 'Print', className: 'btn btn-outline-danger'}
		]
	});

	@php
	if ($invest) {
		$htm = "";
			foreach ($invest as $key => $value) {
				$htm .= "
				$('#btn_delete".$value['poe_id']."').click(function(e) {
					toastr.warning(
						'Are you sure to delete? <br><br><button class=\"btn btn-cyan btc\" value=\"0\">Cancel</button> <button class=\"btn btn-danger btk\" value=\"".$value['poe_id']."\">Delete</button>',
						'Flu Right Size',
						{
							'closeButton': true,
							'positionClass': 'toast-top-center',
							'progressBar': true,
							'showDuration': '500'
						}
					);
				});";
			}
		echo $htm;
	}
	@endphp
});
</script>
<script type="text/javascript">
   function deleteData(id)
   {
	   var id = id;
	   var url = '{{ route("item.destroy", ":id") }}';
	   url = url.replace(':id', id);
	   $("#deleteForm").attr('action', url);
   }

   function formSubmit()
   {
	   $("#deleteForm").submit();
   }
</script>


@endsection
