@extends('layouts.index')
<link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/bootstrap.css') }}" rel="stylesheet">
<link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="../files/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@section('contents')
@section('contents')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">แบบสอบสวน CORONAVIRUS 2019</h4>
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
            <h5>แบบฟอร์มรายละเอียด การติดตามผู้สัมผัส</h5>
            </div>
            <br>
            <div class="card-block">
            <h4 class="sub-title">ข้อมูลทั่วไปผู้สัมผัส</h4>
            <form action="{{route('followupcontactinsert')}}" method="post">
              			{{ csrf_field() }}

										 <?php
											 $sat_id = $_GET['sat_id'];
											?>
											<?php
												$contact_id = $_GET['contact_id'];
											 ?>
						<div class="form-group row">
						<div class="col-sm-3">
						<input type="hidden" name="sat_id" value="{{$sat_id}}" class="form-control">
						</div>
						<div class="col-sm-3">
						<input type="hidden" name="contact_id" value="{{$contact_id}}" class="form-control">
						</div>
						<div class="col-sm-3">
						<input type="hidden" name="contact_id_day" value="{{$contact_id_day}}" class="form-control">
						</div>
						</div>
            <div class="form-group row">
            <div class="col-sm-3">
            <input type="text" name="date_no" id="date_no" class="form-control" placeholder="วันที่ติดตามอาการ">
            </div>
            </div>
						<div class="form-group row">
						<div class="col-sm-3">
						<input type="checkbox" name="clinical"  value="" > ไม่มีอาการ
						</div>
						<div class="col-sm-3">
						<input type="checkbox" name="fever"  value="1" > ไข้
						</div>
						<div class="col-sm-3">
						<input type="checkbox" name="cough"  value="2" > ไอ
						</div>
						<div class="col-sm-3">
						<input type="checkbox" name="sore_throat"  value="3" > เจ็บคอ
						</div>
						</div>
						<div class="form-group row">
						<div class="col-sm-3">
						<input type="checkbox" name="mucous"  value="4" > มีน้ำมูก
						</div>
						<div class="col-sm-3">
						<input type="checkbox" name="sputum"  value="5" > มีเสมหะ
						</div>

						<div class="col-sm-3">
						<input type="checkbox" name="suffocate"  value="9" > หอบเหนื่อย
						</div>
						</div>
						<div class="form-group row">
						<div class="col-sm-3">
						<input type="checkbox" name="muscle_aches"  value="7" > ปวดกล้ามเนื้อ
						</div>
						<div class="col-sm-3">
						<input type="checkbox" name="headache"  value="6" > ปวดศีรษะ
						</div>
						<div class="col-sm-3">
						<input type="checkbox" name="diarrhea"  value="14" > ถ่ายเหลว
						</div>
						</div>
            <div class="form-group row">
            <div class="col-sm-4">
            <textarea rows="3" name="other_symtom" type="text" class="form-control" placeholder="อาการอื่นๆ "></textarea>
            </div>
            </div>
						<div class="form-group row">
						<div class="col-sm-3">
						<select type="text" name="status_followup" class="form-control js-select-basic-single" placeholder="การค้นหาผู้สัมผัส">
							<option value="">สถานะการติดตาม</option>
								<option value="1">จบการติดตาม</option>
								<option value="2">ยังต้องติดตาม</option>
						</select>
						</div>
						<div class="col-sm-3">
						<select type="text" name="available_contact" class="form-control js-select-basic-single" placeholder="การติดตามผู้สัมผัส">
							<option value="">การติดตามผู้สัมผัส</option>
								<option value="1">ติดตามได้</option>
								<option value="2">ติดตามไม่ได้</option>
						</select>
						</div>
						<div class="col-sm-3">
						<select type="text" name="follow_results" class="form-control js-select-basic-single" placeholder="การติดตามผู้สัมผัส">
							<option value="">ผลการติดตามผู้สัมผัส</option>
								<option value="1">อาการปกติ</option>
								<option value="2">ผิดปกติ</option>
						</select>
						</div>
						</div>
						<div class="form-group row">
						<div class="col-sm-3">
						<button type="button" id="close" class="btn btn-xs btn-danger">ไม่มีตัวอย่างและสิ่งส่งตรวจ</button>
						</div>
						<div class="col-sm-3">
						<button type="button" id="open" class="btn btn-xs btn-success">มีตัวอย่างและสิ่งส่งตรวจ</button>
						</div>
						</div>
            <div class="form-group row">
            <div class="col-sm-12">
							<div class="table-responsive">
              <table class="table" id="maintable">
                  <thead>
                    <tr>
                      <th>สถานที่ส่งตรวจ PCR of Novel Coronavirus</th>
											<th>ตัวอย่างสิ่งส่งตรวจ</th>
											<th>สิ่งส่งตรวจอื่นๆ</th>
                      <th>ผล PCR </th>
                      <th>เพิ่ม / ลบ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="data-contact-person">

                      <td>
                        <select class="form-control" name="pcr_contact[]">
                          <option value="">- เลือก -</option>
                          <option value="1">กรมวิทย์ฯ</option>
                          <option value="2">สถาบันบำราศฯ</option>
                          <option value="3">จุฬาลงกรณ์</option>
                          <option value="4">PCR for Mers ที่อื่นๆ</option>
                        </select>
                      </td>
                      <td>
                        <select class="form-control" name="specimen_contact[]">
                          <option value="">- เลือก -</option>
													@foreach ($ref_specimen as $row)
													<option value="{{$row->id}}">{{$row->name_en}}</option>
													@endforeach
                        </select>
                      </td>
											<td>
												<input type="text" id="chkspec_other_contact" name="chkspec_other_contact[]"  class="form-control chkspec_other_contact01" onkeyup="autocomplet()">
											</td>
                      <td>
                        <select class="form-control" name="other_pcr_result_contact[]">
                          <option value="">- เลือก -</option>
                        <option value="รอผล">รอผล</option>
                        <option value="Negative">Negative</option>
                        <option value="Positive">Positive</option>
                      </select>
											</td>
                      <td>
                          <button type="button" id="btnAdd" class="btn btn-xs btn-primary classAdd">Add More</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
							</div>
            </div>
            </div>
            <div class="col-sm-12">
              <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
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
<script type="text/javascript">
				$(document).ready(function () {
					$(document).on("click", ".classAdd", function () { //
						var rowCount = $('.data-contact-person').length + 1;
						var contactdiv = '<tr class="data-contact-person">' +
            '<td><select class="form-control" name="pcr_contact[]' + rowCount + '"">' +
                      '<option value="">- เลือก -</option>' +
                      '<option value="1">กรมวิทย์ฯ</option>' +
                      '<option value="2">สถาบันบำราศฯ</option>' +
                      '<option value="3">จุฬาลงกรณ์</option>' +
                      '<option value="4">PCR for Mers ที่อื่นๆ</option>' +
                      '</select></td>'+
									'<td><select class="form-control" name="specimen_contact[]' + rowCount + '"">' +
                              '<option value="">- เลือก -</option>'+
															@foreach ($ref_specimen as $row)
															'<option value="{{$row->id}}">{{$row->name_en}}</option>'+
															@endforeach
														'</select></td>'+
                            '<td><input type="text" id="chkspec_other_contact' + rowCount + '" name="chkspec_other_contact[]' + rowCount + '"  class="form-control  chkspec_other_contact01" onkeyup="autocomplet()" />' +
                            '<td><select class="form-control" name="other_pcr_result_contact[]' + rowCount + '>' +
                              '<option value="">- เลือก -</option>'+
                              '<option value="รอผล">รอผล</option>'+
                              '<option value="Negative">Negative</option>'+
                              '<option value="Positive">Positive</option>'+
															'</select></td>' +
									'<td><button type="button" id="btnAdd" class="btn btn-xs btn-primary classAdd">Add More</button>' +
										'<button type="button" id="btnDelete" class="deleteContact btn btn btn-danger btn-xs">Remove</button></td>' +
								'</tr>';
					$('#maintable').append(contactdiv); // Adding these controls to Main table class
			});
			$(document).on("click", ".deleteContact", function () {
				$(this).closest("tr").remove(); // closest used to remove the respective 'tr' in which I have my controls
	});
		});
	</script>
	<script>
	$(function(){
		$('#maintable').hide();
	 $('#close').on('click',function(){
	   $('#maintable').hide();
	 });
	 $('#open').on('click',function(){
	   $('#maintable').show();
	 });
	}
	);
	</script>

	<script>
	/* date of birth */
	$('#date_no').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
	});
	</script>
@endsection
