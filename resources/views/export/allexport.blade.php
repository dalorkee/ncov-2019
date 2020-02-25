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
        <form action="{{ route('allexport') }}" method="post">
                {{ csrf_field() }}
      <div class="form-group row">
        <div class="col-sm-6">
        <input type="text" class="form-control" name="notify_date" data-provide="datepicke" id="datecontact"  placeholder="วันที่รับแจ้งเริ่มต้น" autocomplete="off" required>
        </div>
        <div class="col-sm-6">
        <input type="text" class="form-control" name="notify_date_end" data-provide="datepicke" id="datefollow"  placeholder="วันที่รับแจ้งสิ้นสุด" autocomplete="off" required>
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
          <table id="example" class="table-striped row-border" style="width:100%  font-size: 9px;">
        <thead>
            <tr>
								<th>SAT ID</th>
								<th>วันที่ได้รับแจ้ง</th>
								<th>สถานที่ที่คัดกรอง</th>
								<th>จังหวัดที่คัดกรอง</th>
								<th>จังหวัด ที่ผู้ป่วย Isolated</th>
								<th>รพ. ที่ ผู้ป่วย Isolated</th>
								<th>ประเทศที่เดินทางมา</th>
								<th>เมืองที่เดินทางมา</th>
								<th>วันที่มาถึงไทย</th>
								<th>สายการบิน</th>
								<th>เที่ยวบิน</th>
								<th>จำนวนผู้ร่วมเดินทาง</th>
								<th>เพศ</th>
								<th>สัญชาติ</th>
								<th>อาชีพ</th>
								<th>โรคประจำตัว</th>
								<th>โรคปอดเรื้อรัง</th>
								<th>โรคหัวใจ </th>
								<th>โรคตับเรื้อรัง</th>
								<th>โรคไต</th>
								<th>เบาหวาน</th>
								<th>ความดันโลหิตสูง</th>
								<th>ภูมิคุ้มกันบกพร่อง</th>
								<th>โลหิตจาง</th>
								<th>พิการทางสมอง</th>
								<th>ตั้งครรภ์</th>
								<th>อ้วน</th>
								<th>มะเร็ง</th>
								<th>วันที่เริ่มป่วย</th>
								<th>วันที่ Isolate</th>
								<th>ประวัติไข้</th>
								<th>ไข้ (องศา)</th>
								<th>ไอ</th>
								<th>น้ำมูก</th>
								<th>เจ็บคอ</th>
								<th>หายใจเหนื่อ</th>
								<th>หายใจลำบาก</th>
								<th>ซึม</th>
								<th>Chest : CXR</th>
								<th>Rapid test</th>
								<th>วินิจฉัยเบื้องต้น</th>
								<th>หน่วยงานที่จะส่งหนังสือ</th>
								<th>เลขหนังสือ</th>
								<th>แจ้งบำราศ เพื่อ</th>
								<th>แจ้งทีม Operation</th>
								<th>PT Status</th>
								<th>PUI TYPE</th>
								<th>การแถลงข่าว</th>
								<th>สถานะการรักษา</th>
								<th>เบอร์ติดต่อผู้รับแจ้ง</th>
								<th>ชื่อผู้แจ้งข้อมูล</th>
								<th>หน่วยงาน</th>
								<th>ชื่อผู้รับแจ้ง</th>
            </tr>
        </thead>
        <tbody>
					@foreach($data as $value)
						<tr>
							<td>{{ (!empty($value->sat_id)) ? $value->sat_id : ""  }}</td>
							<td>{{ (!empty($value->notify_date)) ? ($value->notify_date) : date('Y-m-d')}}</td>
							<td>
								{{ (isset($arr_hos[$value->walkinplace_hosp_code])) ? $arr_hos[$value->walkinplace_hosp_code] : "" }}
								{{ (isset($list_airport[$value->airports_code])) ? $list_airport[$value->airports_code] : "" }}
							</td>
							<td>{{ (isset($arrprov[$value->walkinplace_hosp_province])) ? $arrprov[$value->walkinplace_hosp_province] : "" }}</td>
							<td>{{ (isset($arrprov[$value->isolated_province])) ? $arrprov[$value->isolated_province] : "" }}</td>
							<td>
							{{ (isset($arr_hos[$value->isolated_hosp_code])) ? $arr_hos[$value->isolated_hosp_code] : "" }}
							{{ (!empty($value->risk2_6history_hospital_input)) ? $value->risk2_6history_hospital_input : ""  }}
						</td>
							<td>{{ (isset($nation_list[$value->travel_from_country])) ? $nation_list[$value->travel_from_country] : "" }}</td>
							<td>{{ (isset($arr_city[$value->travel_from_city])) ? $arr_city[$value->travel_from_city] : "" }}</td>
							<td>{{ (!empty($value->risk_stay_outbreak_arrive_date)) ? $value->risk_stay_outbreak_arrive_date : ""  }}</td>
							<td>{{ (!empty($value->risk_stay_outbreak_airline)) ? $value->risk_stay_outbreak_airline : ""  }}</td>
							<td>{{ (!empty($value->risk_stay_outbreak_flight_no)) ? $value->risk_stay_outbreak_flight_no : ""  }}</td>
							<td>{{ (!empty($value->total_travel_in_group)) ? $value->total_travel_in_group : ""  }}</td>
							<td>{{ (!empty($value->sex)) ? $value->sex : "" }}</td>
							<td>{{ (isset($nation_list[$value->nation])) ? $nation_list[$value->nation] : "" }}</td>
							<td>
									{{ (isset($list_occupation[$value->occupation])) ? $list_occupation[$value->occupation] : "" }}
							 		{{(!empty($value->occupation_oth)) ? $value->occupation_oth : ""}}
							</td>
							<td>{{ (!empty($value->data3_3chk_lung)) ? $value->data3_3chk_lung : ""  }} </td>
							<td>{{ (!empty($value->data3_3chk_heart)) ? $value->data3_3chk_heart : ""  }}</td>
							<td>{{ (!empty($value->data3_3chk_cirrhosis)) ? $value->data3_3chk_cirrhosis :""  }}</td>
							<td>{{ (!empty($value->data3_3chk_kidney)) ? $value->data3_3chk_kidney : "" }}</td>
							<td>{{ (!empty($value->data3_3chk_diabetes)) ? $value->data3_3chk_diabetes : ""  }}</td>
							<td>{{ (!empty($value->data3_3chk_blood)) ? $value->data3_3chk_blood : ""  }}</td>
							<td>{{ (!empty($value->data3_3chk_immune)) ? $value->data3_3chk_immune : ""  }}</td>
							<td>{{ (!empty($value->data3_3chk_anaemia)) ? $value->data3_3chk_anaemia : ""  }}</td>
							<td>{{ (!empty($value->data3_3chk_cerebral)) ? $value->data3_3chk_cerebral : ""  }}</td>
							<td>{{ (!empty($value->data3_3chk_cerebral)) ? $value->data3_3chk_cerebral : ""  }}</td>
							<td>{{ (!empty($value->data3_3chk_pregnant)) ? $value->data3_3chk_pregnant : ""  }}</td>
							<td>{{ (!empty($value->data3_3chk_fat)) ? $value->data3_3chk_fat : ""  }}</td>
							<td>
								{{ (!empty($value->data3_3chk_cancer_name)) ? $value->data3_3chk_cancer_name : ""  }}
								{{ (!empty($value->data3_3input_other)) ? $value->data3_3input_other : ""	  }}
							</td>
							<td>{{ (!empty($value->data3_1date_sickdate)) ? $value->data3_1date_sickdate : ""  }}</td>
							<td>{{ (!empty($value->isolate_date)) ? $value->isolate_date : ""  }}</td>
							<td>{{ (!empty($value->fever_history)) ? $value->fever_history : ""  }}</td>
							<td>{{ (!empty($value->fever_current)) ? $value->fever_current : ""  }}</td>
							<td>{{ (!empty($value->sym_cough)) ? $value->sym_cough : ""  }}</td>
							<td>{{ (!empty($value->sym_snot)) ? $value->sym_snot : ""  }}</td>
							<td>{{ (!empty($value->sym_sore)) ? $value->sym_sore : ""  }}</td>
							<td>{{ (!empty($value->sym_dyspnea)) ? $value->sym_dyspnea : ""  }}</td>
							<td>{{ (!empty($value->sym_breathe)) ? $value->sym_breathe : ""  }}</td>
							<td>{{ (!empty($value->sym_stufefy)) ? $value->sym_stufefy : ""  }}</td>
							<td>{{ (!empty($value->xray_result)) ? $value->xray_result : ""  }}</td>
							<td>{{ (!empty($value->rapid_test_result)) ? $value->rapid_test_result : ""  }}</td>
							<td>{{ (!empty($value->first_diag)) ? $value->first_diag : ""  }}</td>
							<td>{{ (!empty($value->letter_division_code)) ? $value->letter_division_code : ""  }}</td>
							<td>{{ (!empty($value->letter_code)) ? $value->letter_code : ""  }}</td>
							<td>
									{{ (isset($arr_refer_bidi[$value->refer_bidi])) ? $arr_refer_bidi[$value->refer_bidi] : "" }}
										{{ (isset($arr_refer_lab[$value->refer_lab])) ? $arr_refer_lab[$value->refer_lab] : "" }}
							</td>
							<td>
								{{ (isset($arr_op_opt[$value->op_opt])) ? $arr_op_opt[$value->op_opt] : "" }}
									{{ (isset($arr_op_dpc[$value->op_dpc])) ? $arr_op_dpc[$value->op_dpc] : "" }}
							</td>
							<td>{{ (isset($arr['pt_status'][$value->pt_status])) ? $arr['pt_status'][$value->pt_status] : "" }}</td>
							<td>{{ (isset($arr['pui_type'][$value->pui_type])) ? $arr['pui_type'][$value->pui_type] : "" }}</td>
							<td>{{ (isset($arr['news_st'][$value->news_st])) ? $arr['news_st'][$value->news_st] : "" }}</td>
							<td>{{ (isset($arr['disch_st'][$value->disch_st])) ? $arr['disch_st'][$value->disch_st] : "" }}</td>
							<td>{{ 	(!empty($value->coordinator_tel)) ? $value->coordinator_tel : ""  }}</td>
							<td>{{ 	(!empty($value->send_information)) ? $value->send_information : ""  }}</td>
							<td>{{ 	(!empty($value->send_information_div)) ? $value->send_information_div : ""  }}</td>
							<td>{{ 	(!empty($value->receive_information)) ? $value->receive_information : ""  }}</td>
            </tr>
					@endforeach
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
