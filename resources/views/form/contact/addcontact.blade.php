@extends('layouts.index')
<?php
$config = [
    'table' => 'tbl_contact',
    'length' => 11,
		'field' => 'contact_id_temp',
    'prefix' => $prefix_sat_id."B".date('d').date('m'),
];
$contact_id = Haruncpi\LaravelIdGenerator\IdGenerator::generate($config);
?>
@section('contents')
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  {{-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}"> --}}
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
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
            <h5>แบบสอบสวน CORONAVIRUS 2019</h5>
            </div>
            <br>
            <div class="card-block">

            <h4 class="sub-title">ข้อมูลทั่วไปผู้สัมผัส</h4>
            <form action="{{route('contactinsert')}}" method="post">
              			{{ csrf_field() }}
                    <br><label>SAT ID : </label>
								<div class="form-group row">
										<div class="col-sm-12 col-md-3">
										<input type="hidden" name="pui_id" value="{{$pui_id}}" class="form-control" readonly>
										</div>
								</div>
                <div class="form-group row">
                    <div class="col-sm-12 col-md-3">
                    <input type="text" name="sat_id" value="{{$sat_id[0]->sat_id}}" class="form-control" readonly>
                    </div>
                </div>
                <label>Contact ID : </label>
                <div class="form-group row">
  										<div class="col-sm-12 col-md-3">
  										<input type="hidden" id="contact_id_temp" name="contact_id_temp" value="{{$contact_id}}"  class="form-control" placeholder="รหัสผู้สัมผัส" readonly>
  										</div>
  							</div>
							<div class="form-group row">
										<div class="col-sm-12 col-md-3">
                      <input type="checkbox" id="cuscontactid" name="cuscontactid"/> : กรณีกรอกรหัสผู้สัมผัสด้วยตนเอง
										<input type="text" id="inputcontact" name="contact_id" value="{{$contact_id}}"  class="form-control" placeholder="รหัสผู้สัมผัส" readonly>
										</div>
							</div>
              <div class="form-group row">
                    <div class="col-sm-12 col-md-3">
                    <input type="hidden" name="user_id" value="{{$entry_user}}"  class="form-control" placeholder="รหัสผู้สัมผัส" readonly>
                    </div>
              </div>
            <div class="form-group row">
            <div class="col-sm-12 col-md-3">
              <label for="name_contact">คำนำหน้าชื่อ</label>
            <select type="text" name="title_contact" class="form-control js-select-basic-single" placeholder="คำนำหน้าชื่อ">
							@foreach ($ref_title_name as $row)
							<option value="{{$row->id}}">{{$row->title_name}}</option>
							@endforeach
            </select>
            </div>
            <div class="col-sm-12 col-md-3">
            <label for="name_contact">ชื่อต้นผู้สัมผัส</label>
            <input type="text" name="name_contact" class="form-control" placeholder="ชื่อต้นผู้สัมผัส">
            </div>
            <div class="col-sm-12 col-md-3">
              <label for="mname_contact">ชื่อกลางผู้สัมผัส</label>
            <input type="text" name="mname_contact" class="form-control" placeholder="ชื่อกลางผู้สัมผัส">
            </div>
            <div class="col-sm-12 col-md-3">
              <label for="lname_contact">นามสกุลผู้สัมผัส</label>
            <input type="text" name="lname_contact" class="form-control" placeholder="นามสกุลผู้สัมผัส">
            </div>
            </div>
            <div class="form-group row">
            <div class="col-sm-4">
              <label for="sex_contact">เพศ</label>
            <select type="text" name="sex_contact" class="form-control" placeholder="col-sm-2">
                <option value="">เพศ</option>
                  <option value="ชาย">ชาย</option>
                <option value="หญิง">หญิง</option>
            </select>
            </div>
            <div class="col-sm-4">
              <label for="age_contact">อายุ</label>
            <input type="text" name="age_contact" class="form-control" placeholder="อายุ">
            </div>
						<div class="col-sm-4">
              <label for="passport_contact">Passport ID</label>
						<input type="text" name="passport_contact" class="form-control" placeholder="Passport ID">
						</div>
            </div>
            <div class="form-group row">

            <div class="col-sm-12 col-md-3">
              <label for="national_contact">สัญชาติผู้สัมผัส</label>
            <select type="text" name="national_contact" class="form-control js-select-basic-single" placeholder="สัญชาติ">
							<option value="">เลือกสัญชาติ</option>
						@foreach ($ref_global_country as $row)
            <option value="{{$row->country_id}}">{{$row->country_name}}</option>
            @endforeach
            </select>
            </div>
            <div class="col-sm-12 col-md-3">
              <label for="province">จังหวัดที่อยู่ในประเทศไทย</label>
            <select type="text" name="province" id="province" class="form-control province js-select-basic-single" placeholder="จังหวัด">
							<option value="">เลือกจังหวัดที่อยู่ในประเทศไทย</option>
						@foreach ($listprovince as $row)
						<option value="{{$row->province_id}}">{{$row->province_name}}</option>
						@endforeach
						</select>
            </div>
            <div class="col-sm-12 col-md-3">
              <label for="district">อำเภอ/เขตที่อยู่ในประเทศไทย</label>
						<select name="district" id="district" class="form-control district js-select-basic-single" placeholder="อำเภอ">
							<option value="">เลือกอำเภอ/เขตที่อยู่ในประเทศไทย</option>
						</select>
						</div>
            <div class="col-sm-12 col-md-3">
              <label for="subdistrict">ตำบลที่อยู่ในประเทศไทย</label>
						<select name="sub_district" id="subdistrict" class="form-control subdistrict js-select-basic-single" placeholder="ตำบล">
							<option value="">เลือกตำบลที่อยู่ในประเทศไทย</option>
						</select>
						</div>
            </div>
            <div class="form-group row">
            <div class="col-sm-4">
              <label for="address_contact">ที่อยู่</label>
            <textarea rows="3" name="address_contact" type="text" class="form-control" placeholder="ที่อยู่"></textarea>
            </div>
            <div class="col-sm-4">
              <label for="phone_contact">เบอร์โทร</label>
            <input  type="text" name="phone_contact" class="form-control" placeholder="เบอร์โทร">
            </div>
            <div class="col-sm-4">
              <label for="patient_contact">การสัมผัสผู้ป่วย</label>
            <textarea rows="3" type="text" name="patient_contact" class="form-control" placeholder="การสัมผัสผู้ป่วย"></textarea>
            </div>
            </div>

						{{-- <div class="form-group row">
						<div class="col-sm-12 col-md-3">
						<button type="button" id="close" class="btn btn-s btn-danger">ไม่มีตัวอย่างและสิ่งส่งตรวจ</button>
						</div>
						<div class="col-sm-12 col-md-3">
						<button type="button" id="open" class="btn btn-s btn-success">มีตัวอย่างและสิ่งส่งตรวจ</button>
						</div>
						</div> --}}
            {{-- <div class="form-group row" id="lab">
            <div class="col-sm-12">
							<div class="table-responsive">
              <table class="table" id="maintable">
                  <thead>
                    <tr>
                      <th>สถานที่ส่งตรวจ PCR of Novel Coronavirus</th>
                      <th>ครั้งที่ตรวจ</th>
                      <th>วันที่ตรวจ</th>
                      <th>ตัวอย่างสิ่งส่งตรวจ</th>
                      <th>สิ่งส่งตรวจอื่นๆ</th>
                      <th>ผล PCR </th>
                      <th>เพิ่ม / ลบ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="data-contact-person">

                      <td>
                        <select class="form-control" name="dms_pcr_contact[]">
                          <option value="">- เลือก -</option>
                          <option value="1">กรมวิทย์ฯ</option>
                          <option value="2">สถาบันบำราศฯ</option>
                          <option value="3">จุฬาลงกรณ์</option>
                          <option value="4">PCR for Mers ที่อื่นๆ</option>
                        </select>
                      </td>
                      <td>
                        <input type="text" id="dms_time_contact" name="dms_time_contact[]"  class="form-control dms_time_contact01" onkeyup="autocomplet()">
                      </td>
                      <td>
                        <input type="text" id="date_dms_date_contact" name="dms_date_contact[]"  class="form-control dms_date_contact01" onkeyup="autocomplet()">
                      </td>
                      <td>
                        <select class="form-control" name="dms_specimen_contact[]">
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
<script type="text/javascript">
				$(document).ready(function () {
					$(document).on("click", ".classAdd", function () { //
						var rowCount = $('.data-contact-person').length + 1;
						var contactdiv = '<tr class="data-contact-person">' +
            '<td><select class="form-control" name="dms_pcr_contact[]' + rowCount + '"">' +
                      '<option value="">- เลือก -</option>' +
                      '<option value="1">กรมวิทย์ฯ</option>' +
                      '<option value="2">สถาบันบำราศฯ</option>' +
                      '<option value="3">จุฬาลงกรณ์</option>' +
                      '<option value="4">PCR for Mers ที่อื่นๆ</option>' +
                      '</select></td>'+
									'<td><input type="text" id="dms_time_contact' + rowCount + '" name="dms_time_contact[]' + rowCount + '"  class="form-control  dms_time_contact01" onkeyup="autocomplet()" />' +
                  '<td><input type="text" id="date_dms_date_contact' + rowCount + '" name="dms_date_contact[]' + rowCount + '"  class="form-control  dms_date_contact01" onkeyup="autocomplet()" />' +
									'<td><select class="form-control" name="dms_specimen_contact[]' + rowCount + '"">' +
                              '<option value="">- เลือก -</option>'+
															@foreach ($ref_specimen as $row)
															'<option value="{{$row->id}}">{{$row->name_en}}</option>'+
															@endforeach
														'</select></td>'+
                            '<td><input type="text" id="chkspec_other_contact' + rowCount + '" name="chkspec_other_contact[]' + rowCount + '"  class="form-control  chkspec_other_contact01" onkeyup="autocomplet()" />' +
                            '<td><select class="form-control" name="other_pcr_result_contact[]' + rowCount + '"  title="ตำแหน่งในทีม" >' +
                              '<option value="">- เลือก -</option>'+
                              '<option value="รอผล">รอผล</option>'+
                              '<option value="Negative">Negative</option>'+
                              '<option value="Positive">Positive</option>'+
															'</select></td>' +
									'<td><button type="button" id="btnAdd" class="btn btn-xs btn-primary classAdd">Add More</button>' +
										'<button type="button" id="btnDelete" class="deleteContact btn btn btn-danger btn-xs">Remove</button></td>' +
								'</tr>';
					$('#maintable').append(contactdiv); // Adding these controls to Main table class
					$('#date_dms_date_contact' + rowCount + '').datepicker({
						format: 'yyyy/mm/dd',
						todayHighlight: true,
						todayBtn: true,
						autoclose: true
					});
			});
			$(document).on("click", ".deleteContact", function () {
				$(this).closest("tr").remove(); // closest used to remove the respective 'tr' in which I have my controls
	});

		});
	</script>

	<script type="text/javascript">
		$('.province').change(function() {
			if ($(this).val() != '') {
				var select = $(this).val();
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "{{route('dropdown.fetch')}}",
					method: "POST",
					data: {
						select: select,
						_token: _token
					},
					success: function(result) {
						$('.district').html(result);
					}
				})
			}
		});
	</script>
	<script type="text/javascript">
		$('.district').change(function() {
			var selectD = $(this).val();
			if ($(this).val() != '') {
				console.log(selectD);
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "{{route('dropdown.fetchD')}}",
					method: "POST",
					data: {
						select: selectD,
						_token: _token
					},
					success: function(result) {
						$('.subdistrict').html(result);
					}
				})
			}
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
		{{-- <script src="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script> --}}

		<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
		<script src="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
		{{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
<script>
$(function(){
	$('#lab').hide();
 $('#close').on('click',function(){
   $('#lab').hide();
 });
 $('#open').on('click',function(){
   $('#lab').show();
 });
}
);
// $('.selectpicker,#cb_send,#cb_result,#nps_ts1_result,#nps_ts2_send,#nps_ts3_send,#nps_ts2_result,#nps_ts1_send,#nps_ts1_result2,#nps_ts1_result3,#nps_ts2_result2,#nps_ts2_result3,#nps_ts3_result,#nps_ts3_result2,#nps_ts3_result3').selectpicker();
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
$('#date_followup').datepicker({
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
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-select-basic-single').select2();
});
</script>
<script>
$('#cuscontactid').change(function(){
   $("#inputcontact").prop("readonly", !$(this).is(':checked'));
});
$('#followup_address').change(function(){
   $("#followup_address_hos").prop("readonly", !$(this).is(':checked'));
});
</script>


@endsection
