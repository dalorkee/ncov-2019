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
</div><!-- flu-contrainer -->
@endsection
@section('bottom-script')
	<script src="{{ URL::asset('assets/libs/datatables-1.10.18/datatables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/datatables-1.10.18/Buttons-1.5.6/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/datatables-1.10.18/Responsive-2.2.2/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ URL::asset('vendor/datatables/buttons.server-side.js') }}"></script>
	{{ $dataTable->scripts() }}
@endsection
