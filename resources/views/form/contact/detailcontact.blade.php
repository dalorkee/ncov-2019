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

								<div class="row" id="DivIdToPrint">
									{{-- <div class="col-md-12" >
											<div class="pull-left">
															<h4> &nbsp;<b class="text-danger">ข้อมูลผู้ป่วย</b></h4>
															<p class="text-muted m-l-5">
																	ชื่อ - นามสกุล :	{{ (!empty($ref_detail_pt[0]->first_name)) ? $ref_detail_pt[0]->first_name : "" }} {{ (!empty($ref_detail_pt[0]->mid_name)) ? $ref_detail_pt[0]->mid_name : "" }} {{ (!empty($ref_detail_pt[0]->last_name)) ? $ref_detail_pt[0]->last_name : "" }}
																 	</br> เพศ : {{ (!empty($ref_detail_pt[0]->sex)) ? $ref_detail_pt[0]->sex : "" }}
																 	</br>อายุ : {{ (!empty($ref_detail_pt[0]->age)) ? $ref_detail_pt[0]->age : "" }}
																	<br/>สัญชาติ : {{ $nation_list[$ref_detail_pt[0]->nation] }}
																</br>อาชีพ : {{ $arr_occu[$ref_detail_pt[0]->occupation] }}
																	<br/>ผู้ป่วย Isolated ที่ รพ. : {{ $arrprov[$ref_detail_pt[0]->isolated_province] }}</p>
																													<hr>
											</div>
									</div> --}}
										<div class="col-md-12">
												<div class="pull-left">
																<h4> &nbsp;<b class="text-danger">ข้อมูลผู้สัมผัส</b></h4>
																<p class="text-muted m-l-5">
																		ชื่อ - นามสกุล : {{ (!empty($ref_detail_contact[0]->name_contact)) ? $ref_detail_contact[0]->name_contact : "" }}
																		{{ (!empty($ref_detail_contact[0]->mname_contact)) ? $ref_detail_contact[0]->mname_contact : "" }}
																		 {{ (!empty($ref_detail_contact[0]->lname_contact)) ? $ref_detail_contact[0]->lname_contact : "" }}
																		<br/>เพศ : {{ (!empty($ref_detail_contact[0]->sex_contact)) ? $ref_detail_contact[0]->sex_contact : "" }}
																		<br/>อายุ : {{ (!empty($ref_detail_contact[0]->age_contact)) ? $ref_detail_contact[0]->age_contact : "" }}
																		<br/>Passport ID : {{ (!empty($ref_detail_contact[0]->passport_contact)) ? $ref_detail_contact[0]->passport_contact : "" }}
																		{{-- <br/>สัญชาติ :{{ (isset($nation_list[$ref_detail_contact->$national_contact])) ? $nation_list[$ref_detail_contact->$national_contact] : "" }} --}}
																		<br/>ที่อยู่ : {{ (!empty($ref_detail_contact[0]->address_contact)) ? $ref_detail_contact[0]->address_contact : "" }}
																		<br/>เบอร์โทร :{{ (!empty($ref_detail_contact[0]->phone_contact)) ? $ref_detail_contact[0]->phone_contact : "" }}
																		<br/>การสัมผัสผู้ป่วย : {{ (!empty($ref_detail_contact[0]->patient_contact)) ? $ref_detail_contact[0]->patient_contact : "" }}
																		<br/>วันที่สัมผัส : {{ (!empty($ref_detail_contact[0]->datecontact)) ? $ref_detail_contact[0]->datecontact : "" }}</p>
																														<hr>
												</div>
										</div>
										<div class="col-md-12">
											<table class="table display mb-4" role="table">
											        <thead>
											          <tr>
											            <th>ครั้งที่</th>
											            <th>วันที่ติดตาม</th>
																	<th>สถานที่ที่ติดตามผู้สัมผัส</th>
											            <th>หน่วยงานที่ติดตามผู้สัมผัส</th>
											            <th>สถานะการติดตาม</th>
																	<th>การติดตามผู้สัมผัส</th>
											          </tr>
											        </thead>
											        <tbody>
											          <tr>
											            <td>{{ (!empty($ref_detail_follow[0]->contact_id_day)) ? $ref_detail_follow[0]->contact_id_day : "" }}</td>
											            <td>{{ (!empty($ref_detail_follow[0]->date_no)) ? $ref_detail_follow[0]->date_no : "" }}</td>
											            <td>{{ (!empty($ref_detail_follow[0]->followup_address)) ? $ref_detail_follow[0]->followup_address : "" }}</td>
											            <td>{{ (!empty($ref_detail_follow[0]->division_follow_contact)) ? $ref_detail_follow[0]->division_follow_contact : "" }}</td>
																	<td>{{ (!empty($ref_detail_follow[0]->status_followup)) ? $ref_detail_follow[0]->status_followup : "" }}</td>
																	<td>{{ (!empty($ref_detail_follow[0]->follow_results)) ? $ref_detail_follow[0]->follow_results : "" }}</td>
											          </tr>
											        </tbody>
											      </table>
										</div>
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
