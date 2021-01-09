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
		position: absolute !created_at
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
  <h4 class="sub-title">Download</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <br>
        <form action="{{ route('exportcontactbyday') }}" method="post">
                {{ csrf_field() }}
      <div class="form-group row">
        <div class="col-sm-6">
        <input type="text" class="form-control" name="created_date1" data-provide="datepicke" id="datecontact"  placeholder="วันที่รับแจ้งเริ่มต้น" autocomplete="off">
        </div>
        <div class="col-sm-6">
        <input type="text" class="form-control" name="created_date2" data-provide="datepicke" id="datefollow"  placeholder="วันที่รับแจ้งสิ้นสุด" autocomplete="off">
        </div>
      </div>
			<div class="form-group row">
				<div class="col-sm-4">
						<label for="">ระดับความเสี่ยง</label>
						<div class="col-md-8">
							<input type="checkbox" value="all" name="all" class="select-all" checked><label>(All)</label><br>
							<input type="checkbox" value="1" name="risk_contact[]" class="checkboxlistitem" checked><label>เสี่ยงสูง </label><br>
							<input type="checkbox" value="2" name="risk_contact[]" class="checkboxlistitem" checked><label>เสี่ยงต่ำ </label><br>
						</div>
				</div>
				{{-- <div class="col-sm-6">
				<input type="text" class="form-control" name="notify_date_end" data-provide="datepicke" id="datefollow"  placeholder="วันที่รับแจ้งสิ้นสุด" autocomplete="off" required>
				</div> --}}
			</div>
      <div class="col-sm-12">
        <button type="submit" class="btn btn-success">ค้นหาข้อมูล</button>
      </div>
      </form>
		</br>
			<div class="form-group row">
				<div class="col-sm-4">
						<label for=""><h3>ค้นหาล่าสุด</h3></label>
						<div class="col-md-8">
					@if ($count_file_by_user =! '0')
						@foreach ($listfile as $row)
							<div class="d-flex flex-row comment-row m-t-0 ">
								<div class="p-2"><h1 class="error-title text-danger"></h1></div>
								<div class="comment-text w-100">
									{{-- <h6 class="font-medium text-primary"> {{$row->created_at}}</h6> --}}
									{{-- <span class="m-b-2 d-block">ดาวน์โหลดไปแล้ว: {{ $value['export_amount'] }} ครั้ง</span> --}}
									{{-- <span class="m-b-2 d-block">ขนาด: {{ $value['file_size'] }} KB</span> --}}
									{{-- <span class="m-b-10 d-block">สร้างไฟล์เมื่อ:  {{$row->created_at}}</span> --}}
									<div class="comment-footer">
										 <a href="{{ URL::to( '/exports/'. $row->file_name.$row->file_imme_type)  }}" title="Export" class="btn btn-cyan btn-sm btn-rounded waves-effect waves-light">ดาวน์โหลดไฟล์ที่ค้นหาเมื่อ {{$row->created_at}}</a>
										{{-- <a href="{{ URL::to( '/exports/'. $row->file_name)  }}" title="Export" class="btn btn-cyan btn-sm btn-rounded waves-effect waves-light">
											ดาวน์โหลด</a> --}}
									</div>
								</div>
							</div>
						</br>
							{{-- <a href="{{ URL::to( '/exports/'. $row->file_name)  }}" title="Export" class="btn btn-cyan btn-sm btn-rounded waves-effect waves-light">ดาวน์โหลดไฟล์ที่ค้นหาเมื่อ {{$row->created_at}}</a> --}}
						{{-- <a class="btn btn-info" target="_blank" href="{{ URL::to( '/exports/'. $row->file_name)  }}">ดาวน์โหลดไฟล์ที่ค้นหาเมื่อ {{$row->created_at}}</br></a> --}}
						@endforeach
					@else
					@endif
						</div>
				</div>
				{{-- <div class="col-sm-6">
				<input type="text" class="form-control" name="notify_date_end" data-provide="datepicke" id="datefollow"  placeholder="วันที่รับแจ้งสิ้นสุด" autocomplete="off" required>
				</div> --}}
			</div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
@section('bottom-script')
<script src="{{ URL::asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script>
/* date of birth */
$('#datecontact').datepicker({
	format: 'dd/mm/yyyy',
	todayHighlight: true,
	todayBtn: true,
	autoclose: true,
	defaultDate: new Date(),
});
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
<script>
$(".select-all").change(function () {
    $(this).siblings().prop('checked', $(this).prop("checked"));
});

$(".checkboxlistitem").change(function() {
	  var checkboxes = $(this).parent().find('.checkboxlistitem');
    var checkedboxes = checkboxes.filter(':checked');

    if(checkboxes.length === checkedboxes.length) {
     $(this).parent().find('.select-all').prop('checked', true);
    } else {
    $(this).parent().find('.select-all').prop('checked', false);
    }
});
</script>
@endsection
