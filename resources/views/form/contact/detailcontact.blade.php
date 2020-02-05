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
								<div class="row">
									<div class="col-md-12">
											<div class="pull-left">
															<h4> &nbsp;<b class="text-danger">ข้อมูลผู้ป่วย</b></h4>
															<p class="text-muted m-l-5">
																	ชื่อ - นามสกุล : E 104, Dharti-2 เพศ : .............. อายุ :

																	<br/> Passport ID : สัญชาติ :
																	<br/> Talaja Road,
																	<br/> Bhavnagar - 364002</p>
																													<hr>
											</div>
									</div>
										<div class="col-md-12">
												<div class="pull-left">
																<h4> &nbsp;<b class="text-danger">ข้อมูลผู้สัมผัส</b></h4>
																<p class="text-muted m-l-5">
																		ชื่อ - นามสกุล : E 104, Dharti-2 เพศ : .............. อายุ :

																		<br/> Passport ID : สัญชาติ :
																		<br/> ที่อยู่ : เบอร์โทร :
																		<br/> การสัมผัสผู้ป่วย : วันที่สัมผัส : ประเภทผู้สัมผัส :</p>
																														<hr>
												</div>
										</div>
										<div class="col-md-12">
												<div class="table-responsive m-t-40" style="clear: both;">
														<table class="table table-hover">
																<thead>
																		<tr>
																				<th class="text-center">#</th>
																				<th>Description</th>
																				<th class="text-right">Quantity</th>
																				<th class="text-right">Unit Cost</th>
																				<th class="text-right">Total</th>
																		</tr>
																</thead>
																<tbody>
																		<tr>
																				<td class="text-center">1</td>
																				<td>Milk Powder</td>
																				<td class="text-right">2 </td>
																				<td class="text-right"> $24 </td>
																				<td class="text-right"> $48 </td>
																		</tr>
																</tbody>
														</table>
												</div>
										</div>
																						<hr>
										<div class="col-md-12">
												<div class="clearfix"></div>
												<hr>
												<div class="text-right">
														<button class="btn btn-danger" type="submit"> Print </button>
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

@endsection
