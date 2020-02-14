@extends('layouts.index')
<link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/bootstrap.css') }}" rel="stylesheet">
<link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
{{-- <link rel="stylesheet" href="../files/assets/pages/waves/css/waves.min.css" type="text/css" media="all"> --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
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

						<div class="form-group row">
						<div class="col-sm-3">
						<input type="hidden" name="sat_id" value="{{$sat_id[0]->sat_id}}" class="form-control">
						</div>
						<div class="col-sm-3">
						<input type="hidden" name="pui_id" value="{{$sat_id[0]->pui_id}}" class="form-control">
						</div>
						<div class="col-sm-3">
						<input type="hidden" name="contact_id" value="{{$contact_id}}" class="form-control">
						</div>
						<div class="col-sm-3">
						<input type="hidden" name="contact_id_day" value="{{$followup_date}}" class="form-control">
						</div>
						<div class="form-group row">
									<div class="col-sm-3">
									<input type="hidden" name="user_id" value="{{$entry_user}}"  class="form-control" placeholder="รหัสผู้สัมผัส" readonly>
									</div>
						</div>
						</div>
            <div class="form-group row">
            <div class="col-sm-3">
						<label for="date_no">วันที่ติดตามอาการ</label>
            <input type="text" name="date_no" id="date_no" class="form-control" placeholder="วันที่ติดตามอาการ" autocomplete="off">
            </div>
            </div>
						<div class="form-group row">
						<div class="col-sm-3">
						<input type="checkbox" name="clinical"  value="1" > ไม่มีอาการ
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
            <input type="checkbox" name="breath_labored"  value="" > หายใจลำบาก
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
						 <label for="followup_address">สถานที่ที่ติดตามผู้สัมผัส</label>
              <select type="text"  name="followup_address" id="followup_address" class="form-control js-select-basic-single" placeholder="พื้นที่จังหวัดที่ติดตามผู้ป่วย">
              <option value="">สถานที่ที่ติดตามผู้สัมผัส</option>
              <option value="1">บ้าน</option>
              <option value="2">โรงแรม</option>
              <option value="3">โรงพยาบาล</option>
              <option value="4">สถานที่กักกัน</option>
              <option value="5">อื่นๆ</option>
              </select>
              </div>
            <div class="col-sm-3">
			<label for="province_follow_contact">จังหวัดที่ติดตามผู้สัมผัส</label>
            <select type="text" name="province_follow_contact" id="provincehos" class="form-control provincehos js-select-basic-single" placeholder="พื้นที่จังหวัดที่ติดตามผู้ป่วย">
						<option value="">พื้นที่จังหวัดที่ติดตามผู้สัมผัส</option>
            @foreach ($listprovince as $row)
            <option value="{{$row->province_id}}">{{$row->province_name}}</option>
            @endforeach
            </select>
            </div>
            <div class="col-sm-3">
              <label for="hospcode">โรงพยาบาลที่รักษาตัว</label>
              <select name="hospcode" id="chospital_new" class="form-control chospital_new js-select-basic-single" placeholder="อำเภอ">
  							<option value="">เลือกโรงพยาบาลที่รักษาตัว</option>
  						</select>
            </div>
          </div>
						<div class="form-group row">
            <div class="col-sm-3">
              <label for="division_follow_contact">หน่วยงานที่ติดตามผู้สัมผัส</label>
            <select type="text" name="division_follow_contact" id="division_follow_contact" class="form-control js-select-basic-single" placeholder="พื้นที่จังหวัดที่ติดตามผู้ป่วย">
            <option value="">หน่วยงานที่ติดตามผู้สัมผัส</option>
            <option value="99">ส่วนกลาง</option>
            <option value="13">สปคม.</option>
            <option value="1">สคร.1</option>
            <option value="2">สคร.2</option>
            <option value="3">สคร.3</option>
            <option value="4">สคร.4</option>
            <option value="5">สคร.5</option>
            <option value="6">สคร.6</option>
            <option value="7">สคร.7</option>
            <option value="8">สคร.8</option>
            <option value="9">สคร.9</option>
            <option value="10">สคร.10</option>
            <option value="11">สคร.11</option>
            <option value="12">สคร.12</option>
            <option value="999">อื่นๆ</option>
            </select>
            </div>
            <div class="col-sm-3">
	              <label for="name_contact">คำนำหน้าชื่อ</label>
            <input type="text" class="form-control" name="division_follow_contact_other"   placeholder="หน่วยงานอื่นๆ" autocomplete="off" >
            </div>
            </div>
						<br>
						<h6 class="sub-title">ผู้ป่วยมีอาการเข้าได้กับนิยามผู้ป่วยติดเชื้อโคโรนาสายพันธ์ใหม่ 2019 (PUI 2019-nCoV)</h6>
						<div class="form-group row">
						<div class="col-sm-3">
							<div class="col-sm-6">
							<input type="radio" name="sat_id_class"  value="Q" checked> ไม่ใช่
							</div>
							<div class="col-sm-6">
							<input type="radio" name="sat_id_class"  value="A" > ใช่
							</div>
						</div>
						</div>
						<h6 class="sub-title">หมายเหตุ นิยาม: เป็นผู้สัมผัสที่มี มีประวัติไข้ หรือ วัดอุณหภูมิได้ตั้งแต่ 37.5 องศาขึ้นไป <br>ร่วมกับ มีอาการระบบทางเดินหายใจอย่างใดอย่างหนึ่ง (ไอ น้ำมูก เจ็บคอ หายใจเร็ว หายใจเหนื่อย หรือ หายใจลำบาก)</h6>
						<br>
						<div class="form-group row">
						<div class="col-sm-3">
              <label for="status_followup">สถานะการติดตาม</label>
						<select type="text" name="status_followup" class="form-control js-select-basic-single" placeholder="การค้นหาผู้สัมผัส">
							<option value="">สถานะการติดตาม</option>
								<option value="1">จบการติดตาม</option>
								<option value="2">ยังต้องติดตาม</option>
						</select>
						</div>
						<div class="col-sm-3">
              <label for="available_contact">การติดตามผู้สัมผัส</label>
						<select type="text" name="available_contact" class="form-control js-select-basic-single" placeholder="การติดตามผู้สัมผัส">
							<option value="">การติดตามผู้สัมผัส</option>
								<option value="1">ติดตามได้</option>
								<option value="2">ติดตามไม่ได้</option>
						</select>
						</div>
						<div class="col-sm-3">
              <label for="follow_results">ผลการติดตามผู้สัมผัส</label>
						<select type="text" name="follow_results" class="form-control js-select-basic-single" placeholder="การติดตามผู้สัมผัส">
							<option value="">ผลการติดตามผู้สัมผัส</option>
							<option value="1">ไม่มี</option>
							<option value="2">เล็กน้อย</option>
							<option value="3">หนัก</option>
							<option value="5">สาหัส</option>
						</select>
						</div>
						</div>
						{{-- <div class="form-group row">
						<div class="col-sm-3">
						<button type="button" id="close" class="btn btn-xs btn-danger">ไม่มีตัวอย่างและสิ่งส่งตรวจ</button>
						</div>
						<div class="col-sm-3">
						<button type="button" id="open" class="btn btn-xs btn-success">มีตัวอย่างและสิ่งส่งตรวจ</button>
						</div>
						</div> --}}
            {{-- <div class="form-group row">
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
            </div> --}}
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
	<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
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

	<script type="text/javascript">
		$('.provincehos').change(function() {
			if ($(this).val() != '') {
				var select = $(this).val();
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "{{route('dropdown.fetchos')}}",
					method: "POST",
					data: {
						select: select,
						_token: _token
					},
					success: function(result) {
						$('.chospital_new').html(result);
					}
				})
			}
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
	<script>
	// In your Javascript (external .js resource or <script> tag)
	$(document).ready(function() {
	    $('.js-select-basic-single').select2();
	});
	</script>
@endsection
