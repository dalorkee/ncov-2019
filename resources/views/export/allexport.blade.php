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
								<th>อาการ</th>
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
          foreach($data as $value) :
						?>
            <tr>
						<td>{{ 	(!empty($request->notify_date)) ? $this->Convert_Date($request->notify_date) : date('Y-m-d')}}</td>
						<td>{{ (!empty($request->notify_time)) ? $request->notify_time.":00" : NULL  }}</td>
						<td>{{ 	(!empty($request->screen_pt)) ? trim($request->screen_pt) : "1"  }}</td>
						<td>{{ 	(!empty($request->sex)) ? trim($request->sex) : ""  }}</td>
						<td>{{ 	(!empty($request->age)) ? trim($request->age) : ""  }}</td>
						<td>{{ 	(!empty($request->nation)) ? trim($request->nation) : ""  }}</td>
						<td>{{ 	(!empty($request->race)) ? trim($request->race) : ""  }}</td>
						<td>{{ 	(!empty($request->occupation)) ? trim($request->occupation) : ""  }} {{ 	(!empty($request->occupation_oth)) ? trim($request->occupation_oth) : ""  }}</td>
						<td>{{ 	(!empty($request->travel_from)) ? trim($request->travel_from) : NULL  }}</td>
		        <td>
							{{   (!empty($request->data3_3chk_lung)) ? trim($request->data3_3chk_lung) : "n"  }}
							{{    (!empty($request->data3_3chk_heart)) ? trim($request->data3_3chk_heart) : "n"  }}
							{{   (!empty($request->data3_3chk_cirrhosis)) ? trim($request->data3_3chk_cirrhosis) : "n"  }}
							{{   (!empty($request->data3_3chk_kidney)) ? trim($request->data3_3chk_kidney) : "n"  }}
							{{   (!empty($request->data3_3chk_diabetes)) ? trim($request->data3_3chk_diabetes) : "n"  }}
							{{   (!empty($request->data3_3chk_blood)) ? trim($request->data3_3chk_blood) : "n"  }}
							{{   (!empty($request->data3_3chk_immune)) ? trim($request->data3_3chk_immune) : "n"  }}
							{{   (!empty($request->data3_3chk_anaemia)) ? trim($request->data3_3chk_anaemia) : "n"  }}
							{{   (!empty($request->data3_3chk_cerebral)) ? trim($request->data3_3chk_cerebral) : "n"  }}
							{{   (!empty($request->data3_3chk_cerebral)) ? trim($request->data3_3chk_cerebral) : "n"  }}
							{{   (!empty($request->data3_3chk_pregnant)) ? trim($request->data3_3chk_pregnant) : "n"  }}
							{{   (!empty($request->data3_3chk_fat)) ? trim($request->data3_3chk_fat) : "n"  }}
						</td>
		        <td>{{   (!empty($request->data3_3chk_cancer_name)) ? trim($request->data3_3chk_cancer_name) : ""  }}
								{{   (!empty($request->data3_3input_other)) ? trim($request->data3_3input_other) : ""	  }}
						</td>
		        <td>{{   (!empty($request->walkinplace_hosp)) ? trim($request->walkinplace_hosp) : ""  }}</td>
		        <td>{{   (!empty($request->negative_pressure)) ? trim($request->negative_pressure) : ""  }}</td>
		      	<td>{{   (!empty($request->refer_car)) ? trim($request->refer_car) : ""  }}</td>
		        <td>{{   (!empty($request->risk2_6history_hospital_input)) ? trim($request->risk2_6history_hospital_input) : ""  }} {{   (!empty($request->isolated_province)) ? trim($request->isolated_province) : ""  }}</td>
		        <td>{{   (!empty($request->risk2_6arrive_date)) ? $this->Convert_Date($request->risk2_6arrive_date) : NULL  }}</td>
		        <td>{{   (!empty($request->risk2_6airline_input)) ? trim($request->risk2_6airline_input) : ""  }}</td>
		        <td>{{   (!empty($request->risk2_6flight_no_input)) ? trim($request->risk2_6flight_no_input) : ""  }}</td>
		        <td>{{   (!empty($request->total_travel_in_group)) ? trim($request->total_travel_in_group) : ""  }}</td>
		        <td>{{   (!empty($request->data3_1date_sickdate)) ? $this->Convert_Date($request->data3_1date_sickdate) : NULL  }}</td>
		        <td>{{   (!empty($request->fever)) ? trim($request->fever) : ""  }}</td>
		      	<td>{{   (!empty($request->sym_cough)) ? trim($request->sym_cough) : "n"  }} {{   (!empty($request->sym_snot)) ? trim($request->sym_snot) : "n"  }} {{   (!empty($request->sym_sore)) ? trim($request->sym_sore) : "n"  }}
							 	{{   (!empty($request->sym_dyspnea)) ? trim($request->sym_dyspnea) : "n"  }} {{   (!empty($request->sym_breathe)) ? trim($request->sym_breathe) : "n"  }} {{   (!empty($request->sym_stufefy)) ? trim($request->sym_stufefy) : "n"  }}
						</td>
		        <td>{{   (!empty($request->rr_rpm)) ? trim($request->rr_rpm) : ""  }}</td>
		        <td>{{   (!empty($request->xray_result)) ? trim($request->xray_result) : ""  }}</td>
		       	<td>{{   (!empty($request->rapid_test_result)) ? trim($request->rapid_test_result) : ""  }} {{   (!empty($request->lab_test_result_other)) ? trim($request->lab_test_result_other) : ""  }}</td>
		        <td>{{   (!empty($request->first_diag)) ? trim($request->first_diag) : ""  }}</td>
						<td>{{ 	(!empty($request->sat_id)) ? trim($request->sat_id) : NULL  }}</td>
						<td>{{ 	(!empty($request->letter_division_code)) ? trim($request->letter_division_code) : NULL  }}</td>
						<td>{{ 	(!empty($request->letter_code)) ? trim($request->letter_code) : NULL  }}</td>
						<td>{{ 	(!empty($request->refer_bidi)) ? trim($request->refer_bidi) : ""  }}</td>
					 	<td>{{ 	(!empty($request->refer_lab)) ? trim($request->refer_lab) : ""  }}</td>
						<td>{{ 	(!empty($request->lab_send_detail)) ? trim($request->lab_send_detail) : NULL  }}</td>
						<td>{{ 	(!empty($request->lab_send_date)) ? $this->Convert_Date($request->lab_send_date) : NULL  }}</td>
						<td>{{ 	(!empty($request->not_send_bidi)) ? trim($request->not_send_bidi) : ""  }}</td>
						<td>{{ 	(!empty($request->op_opt)) ? trim($request->op_opt) : ""  }}</td>
						<td>{{ 	(!empty($request->op_dpc)) ? trim($request->op_dpc) : ""  }}</td>
						<td>{{ 	(!empty($request->pt_status)) ? trim($request->pt_status) : "1"  }}</td>
						<td>{{ 	(!empty($request->pui_type)) ? trim($request->pui_type) : NULL  }}</td>
						<td>{{ 	(!empty($request->news_st)) ? trim($request->news_st) : NULL  }}</td>
						<td>{{ 	(!empty($request->disch_st)) ? trim($request->disch_st) : NULL  }}</td>
						<td>{{ 	(!empty($request->coordinator_tel)) ? trim($request->coordinator_tel) : ""  }}</td>
						<td>{{ 	(!empty($request->send_information)) ? trim($request->send_information) : ""  }}</td>
						<td>{{ 	(!empty($request->send_information_div)) ? trim($request->send_information_div) : ""  }}</td>
						<td>{{ 	(!empty($request->receive_information)) ? trim($request->receive_information) : ""  }}</td>
            </tr>
						<?php

					 endforeach;
            ?>
        </tbody>
        <tfoot>
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
							<th>อาการ</th>
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
