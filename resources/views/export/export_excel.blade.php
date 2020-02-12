@extends('layouts.index')
{{-- <link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/bootstrap.css') }}" rel="stylesheet"> --}}
{{-- <link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}
@section('custom-style')
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/datatables.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/Buttons-1.6.1/css/buttons.bootstrap4.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/Responsive-2.2.3/css/responsive.bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/libs/select2/dist/css/select2.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/libs/toastr/build/toastr.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
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
	td:nth-of-type(1):before { content: "ID";margin-top:10px;font-weight:600;}
	td:nth-of-type(2):before { content: "SAT_ID";margin-top:10px;font-weight:600;}
	td:nth-of-type(3):before { content: "Patient";margin-top:10px;font-weight:600;}
	td:nth-of-type(4):before { content: "News";margin-top:10px;font-weight:600;}
	td:nth-of-type(5):before { content: "Discharge";margin-top:10px;font-weight:600;}
	td:nth-of-type(6):before { content: "Sex";margin-top:10px;font-weight:600;}
	td:nth-of-type(7):before { content: "Nationality";margin-top:10px;text-align:left!important;font-weight:600;}
	td:nth-of-type(8):before { content: "#";margin-top:10px;text-align:left!important;font-weight:600;}
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
@section('contents')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">รายชื่อผู้สัมผัส</h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">indexcase</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
  <h4 class="sub-title">ค้นหาข้อมูล</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <br>
        <form action="{{ route('export_excel') }}" method="post">
                {{ csrf_field() }}
      <div class="form-group row">
        <div class="col-sm-6">
        <input type="text" class="form-control" name="notify_date" data-provide="datepicke" id="datecontact"  placeholder="วันที่รับแจ้งเริ่มต้น" required>
        </div>
        <div class="col-sm-6">
        <input type="text" class="form-control" name="notify_date_end" data-provide="datepicke" id="datefollow"  placeholder="วันที่รับแจ้งสิ้นสุด" required>
        </div>
      </div>
      <div class="col-sm-12">
        <button type="submit" class="btn btn-success">ค้นหาข้อมูล</button>
      </div>
      </form>
      </div>
    </div>
  </div>
</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<br>
					<div class="table-responsive">
          <table id="example" class="table-striped" style="width:100%">
        <thead>
            <tr>
							<th>ID</th>
                <th>ว/ด/ป ที่ได้รับแจ้ง</th>
                <th>เพศ</th>
                <th>สัญชาติ</th>
                <th>การคัดกรองผู้ป่วย</th>
                <th>ประเภทผู้ป่วย</th>
                <th>จังหวัด</th>
                <th>เดินวันที่มาถึงไทย</th>
                <th>วันที่เริ่มป่วย</th>
                <th>Case code</th>
                <th>PUI Type</th>
                <th>Patian Status</th>
            </tr>
        </thead>
        <tbody>
					<?php
          foreach($data as $value) :
						?>
            <tr><td>{{ (!empty($value->id)) ? $value->id : "" }}</td>
								<td>{{ (!empty($value->notify_date)) ? $value->notify_date : "" }}</td>
                <td>{{ (!empty($value->sex)) ? $value->sex : "" }}</td>
                <td>{{ (!empty($value->nation)) ? $value->nation : "" }}</td>
                <td>{{ (isset($arr['screen_pt'][$value->screen_pt])) ? $arr['screen_pt'][$value->screen_pt] : "" }}</td>
                <td>{{ (!empty($value->isolated_province)) ? $value->isolated_province : ""  }}</td>
                <td>{{ (!empty($value->travel_from)) ? $value->travel_from : "" }}</td>
                <td>{{ (!empty($value->risk2_6arrive_date)) ? $value->risk2_6arrive_date : "" }}</td>
                <td>{{ (!empty($value->data3_1date_sickdate)) ? $value->data3_1date_sickdate : "" }}</td>
                <td>{{ (!empty($value->sat_id)) ? $value->sat_id : "" }}</td>
                <td>{{ (isset($arr['pui_type'][$value->pui_type])) ? $arr['pui_type'][$value->pui_type] : "" }}</td>
                <td>{{ (!empty($value->pt_status)) ? $value->pt_status : "" }}</td>
            </tr>
						<?php

					 endforeach;
            ?>
        </tbody>
    </table>
	</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('bottom-script')
	<script src="{{ URL::asset('assets/libs/datatables-1.10.20/datatables.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/datatables-1.10.20/Buttons-1.6.1/js/buttons.bootstrap4.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/datatables-1.10.20/Responsive-2.2.3/js/responsive.bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js') }}"></script>
<script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script>
<script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
				"columnDefs": [
    { "width": "80px","targets": 1 },
		{ "width": "150px","targets": 4 },
		{ "width": "90px","targets": 5 }
  ]

    } );
} );
</script>
<script>
/* date of birth */
$('#datecontact').datepicker({
	format: 'dd/mm/yyyy',
	todayHighlight: true,
	todayBtn: true,
	autoclose: true
});
</script>
<script>
/* date of birth */
$('#datefollow').datepicker({
	format: 'dd/mm/yyyy',
	todayHighlight: true,
	todayBtn: true,
	autoclose: true
});
</script>
<script>
/* date of birth */
$('#date_dms_date_contact').datepicker({
	format: 'yyyy/mm/dd',
	todayHighlight: true,
	todayBtn: true,
	autoclose: true
});
</script>
@endsection
