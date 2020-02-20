@extends('layouts.index')
@section('custom-style')
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/datatables.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/Buttons-1.6.1/css/buttons.bootstrap4.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/Responsive-2.2.3/css/responsive.bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/libs/select2/dist/css/select2.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/libs/toastr/build/toastr.min.css') }}">
@endsection
@section('internal-style')

@endsection
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
	<table class="table table-bordered" id="data-table">
	<thead>
		<tr>
			<th>Id</th>
			<th>sat_id</th>
			<th>mng</th>
		</tr>
	</thead>
</table>
</div><!-- flu-contrainer -->
@endsection
@section('bottom-script')
	<script src="{{ URL::asset('assets/libs/datatables-1.10.20/datatables.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/datatables-1.10.20/Buttons-1.6.1/js/buttons.bootstrap4.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/datatables-1.10.20/Responsive-2.2.3/js/responsive.bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
	<script src="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
	<script>
	$(document).ready(function() {
		/* ajax request */
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	    $('#data-table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{!! route('invest.data') !!}',
	        columns: [
	            { data: 'id', name: 'id' },
	            { data: 'sat_id', name: 'sat_id' },
				{ data:  'a' },
	        ]
	    });
	});
	</script>
@endsection
