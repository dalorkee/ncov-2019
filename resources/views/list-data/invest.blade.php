@extends('layouts.index')
@section('custom-style')
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.18/datatables-1.10.18/css/jquery.dataTables.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.18/Buttons-1.5.6/css/buttons.dataTables.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.18/Responsive-2.2.2/css/responsive.dataTables.min.css') }}">
@endsection
@section('internal-style')
<style>
.dataTables_wrapper {
	width: 100% !important;
	font-family: 'Fira-code', tahoma !important;
}
#list-data-table {
	width: 100% !important;
}
</style>
@endsection
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">Invest List</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Data</a></li>
						<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('investList.index') }}">Invest</a></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	{{ $dataTable->table() }}

			<!-- Modal change status-->
			<div class="modal fade" id="chstatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<form name="chStatusFrm" action="" method="POST">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Change Status ID:</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="">
								<div class="form-row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
										<div class="form-group">
											<label for="patient">Patient</label>
											<select name="pt_status" class="form-control selectpicker show-tick" data-style="btn-danger">

												<option value="">-- โปรดเลือก --</option>

											</select>
										</div>
									</div>
								</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<input type="submit" class="btn btn-primary" value="Save changes">
							</div>
						</div>
					</form>
				</div>
			</div>

</div><!-- flu-contrainer -->
@endsection
@section('bottom-script')
	<script src="{{ URL::asset('assets/libs/datatables-1.10.18/datatables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/datatables-1.10.18/Buttons-1.5.6/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/datatables-1.10.18/Responsive-2.2.2/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ URL::asset('vendor/datatables/buttons.server-side.js') }}"></script>
	{{ $dataTable->scripts() }}
@endsection
