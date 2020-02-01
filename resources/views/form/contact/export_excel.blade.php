@extends('layouts.index')
{{-- <link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/bootstrap.css') }}" rel="stylesheet"> --}}
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@section('contents')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"></h4>
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
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
          <div class="card">
            <div class="card-header">
            <h5>ดาวน์โหลดข้อมูล CORONAVIRUS 2019</h5>
            </div>
            <br>
            <div class="card-block">

            <h4 class="sub-title">ค้นหาข้อมูล</h4>
            <form action="{{ route('export_excel.excel') }}" method="get">
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
              <button type="submit" class="btn btn-success">ดาวน์โหลดข้อมูลข้อมูล</button>
            </div>
          </form>
				</div>
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
