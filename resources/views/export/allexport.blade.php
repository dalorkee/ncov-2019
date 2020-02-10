@extends('layouts.index')
<link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/bootstrap.css') }}" rel="stylesheet">
<link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
{{-- <link rel="stylesheet" href="../files/assets/pages/waves/css/waves.min.css" type="text/css" media="all"> --}}
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
								<th>วันที่ได้รับแจ้ง</th>
                <th>เวลาได้รับแจ้ง</th>
                <th>การคัดกรอง</th>
                <th>เพศ</th>
                <th>อายุ/ปี</th>
                <th>สัญชาติ</th>
                <th>เชื้อชาติ</th>
                <th>อาชีพ</th>
                <th>ชื่อเมือง</th>
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
								<th>ประเภทมะเร็ง</th>
								<th>สถานที่ (ชื่อสนามบิน/รพ.)</th>
								<th>มีห้อง Neagtive pressure หรือไม่</th>
								<th>มีรถ Refer ผู้ป่วยหรือไม่</th>
								<th>ผู้ป่วย Isolated ที่ รพ.</th>
								<th>วันที่มาถึงไทย</th>
								<th>สายการบิน</th>
								<th>เที่ยวบิน</th>
								<th>จำนวนผู้ร่วมเดินทางในกลุ่มเดียวกัน</th>
								<th>วันที่เริ่มป่วย</th>
								<th>ไข้(องศา)</th>
								<th>ไอ</th>
								<th>น้ำมูก</th>
								<th>เจ็บคอ</th>
								<th>หายใจเหนื่อ</th>
								<th>หายใจลำบาก</th>
								<th>ซึม</th>
								<th>RR(ครั้ง/นาที)</th>
								<th>xray_result</th>
								<th>Rapid Test</th>
								<th>แพทย์วินิจฉัยเบื้องต้น</th>
								<th>PUI Code</th>
								<th>หน่วยงานที่จะส่งหนังสือ</th>
								<th>เลขหนังสือ</th>
								<th>แจ้งศูนย์ Refer บำราศ</th>
								<th>รับ Lab</th>
								<th>ส่งมาเมื่อ</th>
								<th>วันที่</th>
								<th>ไม่แจ้งบำราศ เนื่องจาก</th>
								<th>ทีม Operation ลงเอง</th>
								<th>ทีม สคร. ลง</th>
								<th>PT Status</th>
								<th>PUI TYPE</th>
								<th>การแถลงข่าว</th>
								<th>สถานะการรักษา</th>
								<th>เบอร์ติดต่อผู้ประสานงาน</th>
								<th>ชื่อผู้แจ้งข้อมูล</th>
								<th>หน่วยงาน</th>
								<th>ชื่อผู้รับแจ้ง</th>
            </tr>
        </thead>
        <tbody>
					<?php
					// dd($query_globalcountry);
          foreach($data as $value) :

						?>
            <tr>
						<td>{{ 	(!empty($value->notify_date)) ? ($value->notify_date) : date('Y-m-d')}}</td>
						<td>{{ (!empty($value->notify_time)) ? $value->notify_time.":00" : ""  }}</td>
						<td>{{ (isset($arr['screen_pt'][$value->screen_pt])) ? $arr['screen_pt'][$value->screen_pt] : "" }}</td>
						<td>{{ (!empty($value->sex)) ? $value->sex : "" }}</td>
						<td>{{ (!empty($value->age)) ? $value->age : "" }}</td>
						<td>{{ (isset($nation_list[$value->nation])) ? $nation_list[$value->nation] : "" }}</td>
						<td>{{ (isset($nation_list[$value->race])) ? $nation_list[$value->race] : "" }}</td>
						<td>{{ (isset($occu_list[$value->occupation])) ? $occu_list[$value->occupation] : "" }} {{ 	(!empty($value->occupation_oth)) ? $value->occupation_oth : ""  }}</td>
						<td>{{ (!empty($value->travel_from)) ? $value->travel_from : ""  }}</td>
		        <td>{{   (!empty($value->data3_3chk_lung)) ? $value->data3_3chk_lung : ""  }} </td>
							<td>{{   (!empty($value->data3_3chk_heart)) ? $value->data3_3chk_heart : ""  }}</td>
							<td>{{   (!empty($value->data3_3chk_cirrhosis)) ? $value->data3_3chk_cirrhosis :""  }}</td>
							<td>{{   (!empty($value->data3_3chk_kidney)) ? $value->data3_3chk_kidney : "" }}</td>
							<td>{{   (!empty($value->data3_3chk_diabetes)) ? $value->data3_3chk_diabetes : ""  }}</td>
							<td>{{   (!empty($value->data3_3chk_blood)) ? $value->data3_3chk_blood : ""  }}</td>
							<td>{{   (!empty($value->data3_3chk_immune)) ? $value->data3_3chk_immune : ""  }}</td>
							<td>{{   (!empty($value->data3_3chk_anaemia)) ? $value->data3_3chk_anaemia : ""  }}</td>
							<td>{{   (!empty($value->data3_3chk_cerebral)) ? $value->data3_3chk_cerebral : ""  }}</td>
							<td>{{   (!empty($value->data3_3chk_cerebral)) ? $value->data3_3chk_cerebral : ""  }}</td>
							<td>{{   (!empty($value->data3_3chk_pregnant)) ? $value->data3_3chk_pregnant : ""  }}</td>
							<td>{{   (!empty($value->data3_3chk_fat)) ? $value->data3_3chk_fat : ""  }}</td>
		        <td>{{   (!empty($value->data3_3chk_cancer_name)) ? $value->data3_3chk_cancer_name : ""  }}
								{{   (!empty($value->data3_3input_other)) ? $value->data3_3input_other : ""	  }}
						</td>
		        <td>{{   (!empty($value->walkinplace_hosp)) ? $value->walkinplace_hosp : ""  }}</td>
		        <td>{{   (!empty($value->negative_pressure)) ? $value->negative_pressure : ""  }}</td>
		      	<td>{{   (!empty($value->refer_car)) ? $value->refer_car : ""  }}</td>
		        <td>{{   (!empty($value->risk2_6history_hospital_input)) ? $value->risk2_6history_hospital_input : ""  }}</td>
		        <td>{{   (!empty($value->risk2_6arrive_date)) ? ($value->risk2_6arrive_date) : ""  }}</td>
		        <td>{{   (!empty($value->risk2_6airline_input)) ? $value->risk2_6airline_input : ""  }}</td>
		        <td>{{   (!empty($value->risk2_6flight_no_input)) ? $value->risk2_6flight_no_input : ""  }}</td>
		        <td>{{   (!empty($value->total_travel_in_group)) ? $value->total_travel_in_group : ""  }}</td>
		        <td>{{   (!empty($value->data3_1date_sickdate)) ? ($value->data3_1date_sickdate) : ""  }}</td>
		        <td>{{   (!empty($value->fever)) ? $value->fever : ""  }}</td>
		      	<td>{{   (!empty($value->sym_cough)) ? $value->sym_cough : ""  }}</td>
							<td>{{   (!empty($value->sym_snot)) ? $value->sym_snot : ""  }}</td>
							<td>	{{   (!empty($value->sym_sore)) ? $value->sym_sore : ""  }}</td>
							<td> 	{{   (!empty($value->sym_dyspnea)) ? $value->sym_dyspnea : ""  }}</td>
							<td>	{{   (!empty($value->sym_breathe)) ? $value->sym_breathe : ""  }}</td>
							<td>	{{   (!empty($value->sym_stufefy)) ? $value->sym_stufefy : ""  }}</td>
		        <td>{{   (!empty($value->rr_rpm)) ? $value->rr_rpm : ""  }}</td>
		        <td>{{   (!empty($value->xray_result)) ? $value->xray_result : ""  }}</td>
		       	<td>{{   (!empty($value->rapid_test_result)) ? $value->rapid_test_result : ""  }} {{   (!empty($value->lab_test_result_other)) ? $value->lab_test_result_other : ""  }}</td>
		        <td>{{   (!empty($value->first_diag)) ? $value->first_diag : ""  }}</td>
						<td>{{ 	(!empty($value->sat_id)) ? $value->sat_id : ""  }}</td>
						<td>{{ 	(!empty($value->letter_division_code)) ? $value->letter_division_code : ""  }}</td>
						<td>{{ 	(!empty($value->letter_code)) ? $value->letter_code : ""  }}</td>
						<td>{{ 	(!empty($value->refer_bidi)) ? $value->refer_bidi : ""  }}</td>
					 	<td>{{ 	(!empty($value->refer_lab)) ? $value->refer_lab : ""  }}</td>
						<td>{{ 	(!empty($value->lab_send_detail)) ? $value->lab_send_detail : ""  }}</td>
						<td>{{ 	(!empty($value->lab_send_date)) ? ($value->lab_send_date) : ""  }}</td>
						<td>{{ 	(!empty($value->not_send_bidi)) ? $value->not_send_bidi : ""  }}</td>
						<td>{{ 	(!empty($value->op_opt)) ? $value->op_opt : ""  }}</td>
						<td>{{ 	(!empty($value->op_dpc)) ? $value->op_dpc : ""  }}</td>
						<td>{{ (isset($arr['pt_status'][$value->pt_status])) ? $arr['pt_status'][$value->pt_status] : "" }}</td>
						<td>{{ (isset($arr['pui_type'][$value->pui_type])) ? $arr['pui_type'][$value->pui_type] : "" }}</td>
						<td>{{ (isset($arr['news_st'][$value->news_st])) ? $arr['news_st'][$value->news_st] : "" }}</td>
						<td>{{ (isset($arr['disch_st'][$value->disch_st])) ? $arr['disch_st'][$value->disch_st] : "" }}</td>
						<td>{{ 	(!empty($value->coordinator_tel)) ? $value->coordinator_tel : ""  }}</td>
						<td>{{ 	(!empty($value->send_information)) ? $value->send_information : ""  }}</td>
						<td>{{ 	(!empty($value->send_information_div)) ? $value->send_information_div : ""  }}</td>
						<td>{{ 	(!empty($value->receive_information)) ? $value->receive_information : ""  }}</td>
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