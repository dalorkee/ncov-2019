@extends('layouts.index')
{{-- <link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/bootstrap.css') }}" rel="stylesheet"> --}}
<link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
		<!-- ============================================================== -->
		<!-- Start Page Content -->
		<!-- ============================================================== -->
		<div class="row">
				<div class="col-md-12">
						<div class="card card-body printableArea">
								{{-- <h4><b>ข้อมูลผู้สัมผัส</b> <span class="pull-right"></span></h4>
								<hr> --}}
								<?php
									$sat_id = $_GET['sat_id'];
								 ?>
								 <?php
									 $contact_id = $_GET['contact_id'];
									?>
								<div class="row" id="DivIdToPrint">
									<div class="col-md-12" >
											<div class="pull-left">
															<h4> &nbsp;<b class="text-danger">ข้อมูลผู้ป่วย</b></h4>
															<p class="text-muted m-l-5">
																	ชื่อ - นามสกุล :	 {{ $ref_detail_pt[0]->first_name }} {{ $ref_detail_pt[0]->mid_name }} {{ $ref_detail_pt[0]->last_name }}
																 	</br> เพศ : {{ $ref_detail_pt[0]->sex }}
																 	</br>อายุ : {{ $ref_detail_pt[0]->age }}
																	<br/>สัญชาติ : {{ $nation_list[$ref_detail_pt[0]->nation] }}
																</br>อาชีพ : {{ $arr_occu[$ref_detail_pt[0]->occupation] }}
																	<br/>ผู้ป่วย Isolated ที่ รพ. : {{ $arrprov[$ref_detail_pt[0]->isolated_province] }}</p>
																													<hr>
											</div>
									</div>
										<div class="col-md-12">
												<div class="pull-left">
																<h4> &nbsp;<b class="text-danger">ข้อมูลผู้สัมผัส</b></h4>
																<p class="text-muted m-l-5">
																		ชื่อ - นามสกุล : {{ $ref_detail_contact[0]->name_contact }} {{ $ref_detail_contact[0]->mname_contact }} {{ $ref_detail_contact[0]->lname_contact }}
																		<br/>เพศ : {{ $ref_detail_contact[0]->sex_contact }}
																		<br/>อายุ :{{ $ref_detail_contact[0]->age_contact }}
																		<br/> Passport ID : {{ $ref_detail_contact[0]->passport_contact }}
																		<br/>สัญชาติ :{{ $nation_list[$ref_detail_contact[0]->national_contact] }}
																		<br/>ที่อยู่ : {{ $ref_detail_contact[0]->address_contact }}
																		<br/>เบอร์โทร :{{ $ref_detail_contact[0]->phone_contact }}
																		<br/>การสัมผัสผู้ป่วย : {{ $ref_detail_contact[0]->patient_contact }}
																		<br/>วันที่สัมผัส : {{ $ref_detail_contact[0]->datecontact }}</p>
																														<hr>
												</div>
										</div>
										<div class="col-md-12">
												<div class="table-responsive m-t-40" style="clear: both;">
													<h4> &nbsp;<b class="text-danger">ข้อมูลการติดตาม</b></h4>
														<table class="table table-hover">
																<thead>
																		<tr>
																				<th>ติดตามอาการ</th>
																				<th>วันที่ติดตามอาการ</th>
																				<th>อาการ</th>
																				<th>ตัวอย่างสิ่งส่งตรวจ</th>
																				<th>ผล PCR</th>
																		</tr>
																</thead>
																<tbody>
																	<?php foreach($ref_detail_follow as $value) : ?>
																		<tr>
																				<td>ครั้งที่ {{ $value->contact_id_day }}</td>
																				<td>{{ $value->date_no }}</td>
																				<td>
																					{{ (isset($arrsymptoms[$value->clinical])) ? $nation_list[$value->clinical] : "" }}
																					{{ (isset($arrsymptoms[$value->fever])) ? $nation_list[$value->fever] : "" }}
																					{{ (isset($arrsymptoms[$value->cough])) ? $nation_list[$value->cough] : "" }}
																					{{ (isset($arrsymptoms[$value->sore_throat])) ? $nation_list[$value->sore_throat] : "" }}
																					{{ (isset($arrsymptoms[$value->mucous])) ? $nation_list[$value->mucous] : "" }}
																					{{ (isset($arrsymptoms[$value->sputum])) ? $nation_list[$value->sputum] : "" }}
																					{{ (isset($arrsymptoms[$value->breath_labored])) ? $nation_list[$value->breath_labored] : "" }}
																					{{ (isset($arrsymptoms[$value->suffocate])) ? $nation_list[$value->suffocate] : "" }}
																					{{ (isset($arrsymptoms[$value->muscle_aches])) ? $nation_list[$value->muscle_aches] : "" }}
																					{{ (isset($arrsymptoms[$value->headache])) ? $nation_list[$value->headache] : "" }}
																					{{ (isset($arrsymptoms[$value->diarrhea])) ? $nation_list[$value->diarrhea] : "" }}
																					{{ $value->other_symtom }}
																				</td>
																				<td>
																					{{ (isset($arrspecimen[$value->specimen_contact])) ? $nation_list[$value->specimen_contact] : "" }}
																					{{ $value->chkspec_other_contact }}
																				</td>
																				<td>{{ $value->other_pcr_result_contact }}</td>
																		</tr>
																		<?php endforeach;?>
																</tbody>
														</table>
												</div>
										</div>
																						<hr>
										<div class="col-md-12">
												<div class="clearfix"></div>
												<hr>
												<div class="text-center">
														<button class="btn btn-sucess" type="button" id='btn' value='Print' onclick='printDiv();'> Print </button>
												</div>
										</div>
								</div>
						</div>
				</div>
		</div>

		<!-- ============================================================== -->
		<!-- End PAge Content -->
		<!-- ============================================================== -->

@endsection
@section('bottom-script')
<script>
function printDiv() {
  var divToPrint = document.getElementById('DivIdToPrint');
  var newWin = window.open('', 'Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
  newWin.document.close();
  setTimeout(function() {
    newWin.close();
  }, 10);
}

</script>
@endsection
