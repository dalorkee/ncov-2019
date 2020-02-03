@extends('layouts.index')
<link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/bootstrap.css') }}" rel="stylesheet">
<link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="../files/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
{{-- <link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/bootstrap.css') }}" rel="stylesheet"> --}}
{{-- <link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}
{{-- https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css --}}
{{-- <link type="text/css" href="{{ URL::asset('https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css') }}" rel="stylesheet"> --}}
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
          <table id="example" class="table table-striped table-bordered" style="width:100%">
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
          $i = 1;
          foreach($data as $value) : ?>
            <tr><td>{{ $i }}</td>
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
						<?php endforeach;
$i++;
            ?>
        </tbody>
        <tfoot>
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
        </tfoot>
    </table>
	</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('bottom-script')
  <script src="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
{{-- <script src="{{ URL::asset('assets/contact/datatable/js/jquery-3.3.1.js') }}"></script> --}}
<script src="{{ URL::asset('assets/contact/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/contact/datatable/js/dataTables.bootstrap4.min.js') }}"></script>
{{-- <script src="{{ URL::asset('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}"></script> --}}
<script src="{{ URL::asset('https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js') }}"></script>
<script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script>
<script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
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
