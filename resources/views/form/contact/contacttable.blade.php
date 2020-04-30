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
  {{-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}"> --}}
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
					<div class="d-md-flex align-items-center mb-2">
						<div>
							<h4 class="card-title">ผู้สัมผัสโรคปอดอักเสบจากเชื้อไวรัสโคโรนาสายพันธุ์ใหม่ 2019</h4>
							<h5 class="card-subtitle">COVID-19</h5>
						</div>
					</div>
					<div class="col-lg-12">
												<h5 class="font-light">ผู้สัมผัสของผู้ป่วยรหัส : <?php foreach($patian_data as $valuept) : ?>{{ $valuept->sat_id }}<?php endforeach;?></h5>
																				<div class="row">
																						<div class="col-3 m-t-15">
																								<div class="bg-dark p-10 text-white text-center">
																									 <i class="fa fa-user m-b-5 font-16"></i>
																									 <h5 class="m-b-0 m-t-5">
																										 <?php foreach($count_con as $count_cont) : ?>
																																<h4 class="card-title">{{ $count_cont->count_cont }}</h4>
																											<?php endforeach;?></h5>
																									 <small class="font-light">ผู้สัมผัสทั้งหมด</small>
																								</div>
																						</div>
																						 <div class="col-3 m-t-15">
																								<div class="bg-dark p-10 text-white text-center">
																									 <i class="fa fa-arrow-alt-circle-up m-b-5 font-16"></i>
																									 <h5 class="m-b-0 m-t-5">
																										 <?php foreach($count_hrisk as $valuehrisk) : ?>
																																<h4 class="card-title">{{ $valuehrisk->count_hrisk }}</h4>
																											<?php endforeach;?>
																									 </h5>
																									 <small class="font-light">ผู้ป่วยเสี่ยงสูง</small>
																								</div>
																						</div>
																						<div class="col-3 m-t-15">
																								<div class="bg-dark p-10 text-white text-center">
																									 <i class="fa fa-arrow-alt-circle-down m-b-5 font-16"></i>
																									 <h5 class="m-b-0 m-t-5">
																										 <?php foreach($count_lrisk as $valuecount_lrisk) : ?>
																																<h4 class="card-title">{{ $valuecount_lrisk->count_lrisk }}</h4>
																											<?php endforeach;?>
																									 </h5>
																									 <small class="font-light">ผู้ป่วยเสี่ยงต่ำ</small>
																								</div>
																						</div>
																						 <div class="col-3 m-t-15">
																								<div class="bg-dark p-10 text-white text-center">
																									 <i class="fa fa-vial m-b-5 font-16"></i>
																									 <h5 class="m-b-0 m-t-5">
																										 <?php foreach($count_labcont as $valuecount_labcont) : ?>
																																<h4 class="card-title">{{ $valuecount_labcont->count_labcont }}</h4>
																											<?php endforeach;?>
																									 </h5>
																									 <small class="font-light">ส่ง Lab แล้ว</small>
																								</div>
																						</div>
																				</div>
																		</div>
</br>
					<div class="col-md-12">
						<a class="btn btn-success" target="_blank" href="{{ route('addcontact',$id) }}">
							Add Contact
						</a>
						<a class="btn btn-info" target="_blank" href="{{ route('contactexport',$id) }}">
							export Contact
						</a>
					</div>
					<br>
					<div class="table-responsive">
						<table id="example" class="table display mb-4" role="table">
						<thead>
							<tr>
								<th>ID</th>
									<th>Contact ID</th>
									<th>ชื่อ - นามสกุล</th>
									<th>อายุ</th>
									<th>ระดับความเสี่ยง</th>
									{{-- <th>สถานที่ตรวจ Lab</th> --}}
									<th>เบอร์โทร</th>
									<th>ที่อยู่ในประเทศไทย</th>
									<th>สถานะการติดตาม</th>
									<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($contact_data as  $value) : ?>
							<tr>
								<td>{{ $value->sat_id }}</td>
                <td>{{ $value->contact_id }}</td>
								<td>{{ $value->name_contact }} {{ $value->lname_contact }}</td>
                <td>{{ $value->age_contact }}</td>
								<td>{{ (isset($arr_risk_contact[$value->risk_contact])) ? $arr_risk_contact[$value->risk_contact] : "" }}</td>
								<td>{{ $value->phone_contact }}</td>
                <td>{{ (isset($arrprov[$value->province])) ? $arrprov[$value->province] : "" }}
										{{ (isset($arrdistrict[$value->district])) ? $arrdistrict[$value->district] : "" }}
										{{ (isset( $arr_sub_district[$value->sub_district])) ? $arr_sub_district[$value->sub_district] : "" }}
								</td>
								<td>{{ (isset($arr_status_followup[$value->status_followup])) ? $arr_status_followup[$value->status_followup] : "" }}</td>

								<td>
									<a href="http://viral.ddc.moph.go.th/viral/lab/genlab.php?idx={{ $value->contact_id }}" target="_blank" title="GenLAB" class="btn btn-cyan btn-sm">GenLAB</a>
									<a href="http://viral.ddc.moph.go.th/viral/lab/labfollow.php?idx={{ $value->contact_id }}" target="_blank" title="LabResult" class="btn btn-primary btn-sm">LabResult</a>
									<button type="button" class="btn btn-success btn-sm margin-5 text-white change_st" data-toggle="modal" title="Change status" data-target="#chstatus{{ $value->contact_id }}">ST</button>
									{{-- <a class="btn btn-danger btn-sm" href="{{ route('contactfollowtable',$value->contact_id)}}"> --}}
										<a class="btn btn-warning btn-sm" data-toggle="tooltip" title="Follow up table" data-placement="top" href="/ncov-2019/{{ 'followuptablescon'}}/typid/2/id/{{ $value->contact_id }}">
											FU
									</a>
									{{-- <a class="btn btn-info btn-sm" href="{{ route('detailcontact',$value->contact_id)}}"> --}}
										<a class="btn btn-info btn-sm" data-toggle="tooltip" title="Info" data-placement="top" href="/ncov-2019/{{ 'detailcontact'}}/contact_id/{{ $value->contact_id }}">
										Info
								</a>
								<a class="btn btn-danger btn-sm" href="/ncov-2019/{{'editcontact'}}/pui_id/{{ $value->pui_id }}/contact_rid/{{ $value->contact_rid }}">
									{{-- <a class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit" data-placement="top" href="#"> --}}
										Edit
								</a>
								<a class="btn btn-danger btn-sm" href="/ncov-2019/{{'deletecontact'}}/id/{{ $value->id }}/pui_id/{{ $value->pui_id }}" onclick="return confirm('ต้องการลบข้อมูล ผู้สัมผัส{{ $value->contact_id }} ของผู้ป่วย {{ $value->sat_id }} ใช่หรือไม่?');">
									{{-- <a class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit" data-placement="top" href="#"> --}}
										delete
								</a>
								</td>
							</tr>
							<?php endforeach;?>
						</tbody>
						</table>
	</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php foreach($contact_data as $value) : ?>
	<form action="{{route('contact_st_update')}}" method="post">
					{{ csrf_field() }}
<!-- Modal change status-->
<div class="modal fade" id="chstatus{{ $value->contact_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Change Status ID:{{ $value->contact_id }}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="filechangest">
					<input type="hidden" name="pui_id" value="{{$id}}">
					<input type="hidden" name="id" value="{{ $value->id}}">
					<input type="hidden" name="contact_id" value="{{ $value->contact_id }}">
					<input type="hidden" name="sat_id" value="{{$value->contact_id }}">
					<input type="hidden" name="card_id" value="{{$value->contact_cid }}">
					<input type="hidden" name="title_name" value="{{$value->title_contact }}">
					<input type="hidden" name="first_name" value="{{$value->name_contact }}">
					<input type="hidden" name="mid_name" value="{{$value->mname_contact }}">
					<input type="hidden" name="last_name" value="{{$value->lname_contact }}">
					<input type="hidden" name="sex" value="{{$value->sex_contact }}">
					<input type="hidden" name="age" value="{{$value->age_contact }}">
					<input type="hidden" name="nation" value="{{$value->national_contact }}">
					<input type="hidden" name="walkin_province" value="{{$value->walkin_province }}">
					<input type="hidden" name="walkin_district" value="{{$value->walkin_district }}">
					<input type="hidden" name="walkin_sub_district" value="{{$value->walkin_sub_district }}">
					<input type="hidden" name="walkin_hospital_code" value="{{$value->walkin_hospital_code }}">
					<div class="form-row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<div class="form-group">
								<label for="patient">สถานะการติดตาม</label>
								<select name="status_followup" class="form-control selectpicker show-tick" data-style="btn-danger" id="status_followup">
									<option value="2">ยังต้องติดตาม</option>
									<option value="{{ (!empty($value->status_followup)) ? $value->status_followup : ""  }}" selected="selected">{{ (isset($arr_status_followup[$value->status_followup])) ? $arr_status_followup[$value->status_followup] : "" }}</option>
										<option value="">สถานะการติดตาม</option>
											<option value="2">ยังต้องติดตาม</option>
											<option value="1">จบการติดตาม</option>
									</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<div class="form-group">
								<label for="news">สถานะผู้ป่วย</label>
								@if ($value->pt_status == "2")
									<input type="hidden" name="pt_status" value="{{ $value->pt_status }}" readonly><p>{{ (isset($arr_pts[$value->pt_status])) ? $arr_pts[$value->pt_status] : "Contact" }}</p>
								@else
								<select name="pt_status" class="form-control selectpicker show-tick" data-style="btn-info" id="pt_status{{ $value->contact_id }}">
									<option value="{{ (!empty($value->pt_status)) ? $value->pt_status : "99"  }}" selected="selected">{{ (isset($arr_pts[$value->pt_status])) ? $arr_pts[$value->pt_status] : "Contact" }}</option>
									<option value="">-- สถานะผู้ป่วย --</option>
									<option value="99">Contact</option>
								@foreach ($ref_pt_status as $row)
									<option value="{{$row->pts_id}}">{{$row->pts_name_en}}</option>
								@endforeach
								</select>
								@endif
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<div class="form-group">
								<label for="date_change_st">วันที่เปลี่ยนสถานะ</label>
									  <input type="text" class="form-control" name="date_change_st" data-provide="datepicker" id="date_change_st" value=""  placeholder="" autocomplete="off" >
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					@if ($value->pt_status == "2")
						<input type="submit" class="btn btn-primary" value="Save changes">
					@else
						<input type="submit" class="btn btn-primary" value="Save changes">
					@endif

				</div>
			</div>
		</form>
	</div>
</div>
<?php endforeach;?>
@endsection
@section('bottom-script')
	<script src="{{ URL::asset('assets/libs/datatables-1.10.20/datatables.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/datatables-1.10.20/Buttons-1.6.1/js/buttons.bootstrap4.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/datatables-1.10.20/Responsive-2.2.3/js/responsive.bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
{{-- <script src="{{ URL::asset('assets/contact/datatable/js/jquery-3.3.1.js') }}"></script> --}}
{{-- <script src="{{ URL::asset('assets/contact/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/contact/datatable/js/dataTables.bootstrap4.min.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment.min.js'></script>
<script>
	$(document).ready(function() {
	    $('#example').DataTable();
	} );
</script>
<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>

	<script>
	$('#date_change_st').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});

	</script>

@endsection
