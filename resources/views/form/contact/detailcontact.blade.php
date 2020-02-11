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
