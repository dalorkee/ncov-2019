@extends('layouts.index')
<link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/bootstrap.css') }}" rel="stylesheet">
<link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@section('contents')
@section('contents')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">แบบบันทึกข้อมูลการติดตาม CORONAVIRUS 2019</h4>
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
            <h5>แบบฟอร์มรายละเอียด การติดตามผู้ป่วย</h5>
            </div>
            <br>
						<div class="bd-callout bd-callout-info" style="margin-top:0;position:relative">
							<div style="position:absolute;top:10px;right:10px;z-index:1">
							</div>
            <div class="card-block">
            <h4 class="sub-title">ข้อมูลทั่วไปผู้ป่วย</h4>
            <form action="{{route('followupinsert')}}" method="post">
              			{{ csrf_field() }}
						<div class="form-group row">
						<div class="col-sm-3">
						<input type="hidden" name="typid" value="{{$typid}}" class="form-control">
						</div>
						<div class="col-sm-3">
						<input type="hidden" name="patianid" value="{{$id}}" class="form-control">
						</div>
						<div class="form-group row">
									<div class="col-sm-3">
									<input type="hidden" name="user_id" value="{{$entry_user}}"  class="form-control" placeholder="รหัสผู้ป่วย" readonly>
									</div>
						</div>
						</div>
            <div class="form-group row">
						<div class="col-sm-3">
							<label for="date_no">ครั้งที่ติดตามอาการ</label>
							<input type="number" name="followup_times" id="followup_times" class="form-control" min="1" max="14" placeholder="ครั้งที่ติดตามอาการ" autocomplete="off" required>
						</div>
            <div class="col-sm-3">
						<label for="date_no">วันที่ติดตามอาการ</label>
            <input type="text" name="date_no" id="date_no" class="form-control" value="<?php echo date("d/m/Y"); ?>" placeholder="วันที่ติดตามอาการ" autocomplete="off" readonly>
            </div>
            </div>
					</div>
					</div>
					<div class="bd-callout bd-callout-custom-2" style="margin-top:0;position:relative">
						<div style="position:absolute;top:10px;right:10px;z-index:1">
						</div>
						<h5 class="sub-title">อาการปัจจุบันของผู้ป่วย</h5>
						<div class="form-group row">
							<div class="col-sm-3">
							<input type="radio" name="clinical"  value="n" checked> ไม่มีอาการ
							</div>
							<div class="col-sm-3">
							<input type="radio" name="clinical"  value="y1" > มีอาการเล็กน้อย (สามารถช่วยเหลือตนเองได้)
							</div>
							<div class="col-sm-3">
							<input type="radio" name="clinical"  value="y2"> อาการรุนแรง (ไม่สามารถช่วยเหลือตนเองได้)
							</div>
							<div class="col-sm-3">
							<input type="radio" name="clinical"  value="y3" > อาการสาหัส (Organ failure)
							</div>
						</div>
					</div>
				</div>
				<div class="bd-callout bd-callout-warning" style="margin-top:0;position:relative">
					<div style="position:absolute;top:10px;right:10px;z-index:1">
					</div>
					<div class="form-group row">
						<div class="col-sm-3">
					 <label for="followup_address">สถานที่ที่ติดตามผู้ป่วย</label>
						<select type="text"  name="followup_address" id="hosdivshow" class="form-control js-select-basic-single" placeholder="พื้นที่จังหวัดที่ติดตามผู้ป่วย">
						<option value="">สถานที่ที่ติดตามผู้ป่วย</option>
						<option value="1">บ้าน</option>
						<option value="2">โรงแรม</option>
						<option value="3">โรงพยาบาล</option>
						<option value="4">สถานที่กักกัน</option>
						<option value="5">อื่นๆ</option>
						</select>
						</div>
				</div>
				<div id="follow_address_other" class="form-group row">
				<div class="col-sm-3">
					<label>ชื่อสถานที่ติดตามผู้ป่วย</label>
					<input type="text" name="follow_address_other"  class="form-control"placeholder="ชื่อสถานที่ติดตามผู้ป่วย" >
				</div>
			</div>
				<div id="hosdiv" class="form-group row">
			<div class="col-sm-3">
	<label for="province_follow_contact">จังหวัดที่ติดตามผู้ป่วย</label>
			<select type="text" name="province_follow_contact" id="provincehos" class="form-control provincehos js-select-basic-single" placeholder="พื้นที่จังหวัดที่ติดตามผู้ป่วย">
			<option value="">พื้นที่จังหวัดที่ติดตามผู้ป่วย</option>
			@foreach ($listprovince as $row)
			<option value="{{$row->province_id}}">{{$row->province_name}}</option>
			@endforeach
			</select>
			</div>
			<div class="col-sm-3">
				<label for="hospcode">โรงพยาบาลที่รักษาตัว</label>
				<select name="hospcode" id="chospital_new" class="form-control chospital_new js-select-basic-single" placeholder="โรงพยาบาลที่รักษาตัว">

					<option value="">เลือกโรงพยาบาลที่รักษาตัว</option>
				</select>
			</div>
		</div>
						<div class="form-group row">
            <div class="col-sm-3">
              <label for="division_follow_contact">หน่วยงานที่ติดตามผู้ป่วย</label>
            <select type="text" name="division_follow_contact" id="division_follow_contact" class="form-control js-select-basic-single" placeholder="พื้นที่จังหวัดที่ติดตามผู้ป่วย">
            <option value="">หน่วยงานที่ติดตามผู้ป่วย</option>
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
	              <label for="name_contact">หน่วยงานอื่นๆ</label>
            <input type="text" class="form-control" name="division_follow_contact_other"   placeholder="หน่วยงานอื่นๆ" autocomplete="off" >
            </div>
            </div>
					</div>
					<div class="bd-callout bd-callout-info" style="margin-top:0;position:relative">
						<div style="position:absolute;top:10px;right:10px;z-index:1">
						</div>
						<div class="form-group row">
						<div class="col-sm-3">
              <label for="status_followup">สถานะผู้ป่วย</label>
							<select name="disch_st" class="form-control selectpicker show-tick">
								<option value="">-- โปรดเลือก --</option>
								@foreach($arr['disch_st'] as $key => $val)
								<option value="{{ $key }}">{{ $val }}</option>
								@endforeach
							</select>
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
	<script>
	function show1(){
	  document.getElementById('div1').style.display ='none';
	}
	function show2(){
	  document.getElementById('div1').style.display = 'block';
	}
	</script>
	<script>
	$(document).ready(function(){
		$("#hosdiv").hide();
		$("#follow_address_other").hide();
			$('#hosdivshow').on('change', function() {
				if ( this.value == '1')
				{
					$("#follow_address_other").show();
					$("#hosdiv").hide();
				}
				if ( this.value == '2')
				{
					$("#follow_address_other").show();
					$("#hosdiv").hide();
				}
				if ( this.value == '4')
				{
					$("#follow_address_other").show();
					$("#hosdiv").hide();
				}
				if ( this.value == '3')
				{
					$("#hosdiv").show();
					$("#follow_address_other").hide();
				}
			});
	});
	</script>
	@endsection
