@extends('layouts.index')
@section('custom-style')
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/datatables.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/Buttons-1.6.1/css/buttons.bootstrap4.min.css') }}">
	<link rel='stylesheet' href="{{ URL::asset('assets/libs/datatables-1.10.20/Responsive-2.2.3/css/responsive.bootstrap.min.css') }}">
@section('internal-style')
<style>
.error{
	display: none;
	margin-left: 10px;
}
.error_show{
	color: red;
	margin-left: 10px;
}
input.invalid, textarea.invalid{
	border: 2px solid red;
}
input.valid, textarea.valid{
	border: 2px solid green;
}
.dataTables_wrapper {
	font-family: 'tahoma' !important;
}
</style>
@endsection
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">State Quarantine</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">State Quarantine</a></li>
						<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('list.state_quarantine') }}">Lists</a></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	@include('flash::message')
	<div class="card">
		<div class="card-body">
			<div class="d-md-flex align-items-center mb-2">
				<div>
					<h4 class="card-title">ข้อมูล Self Quarantine</h4>
					<h5 class="card-subtitle">COVID-19</h5>
				</div>
			</div>
			<div class="row border-top">
				<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
					<div class="card">
						<div class="card-body">
							<div id="patient_data">
								<table class="display responsive nowrap mt-0 mb-3" id="code_table" role="table" style="width:100%;" cellspacing="0">
									<thead>
										<tr>
											<th>SatID</th>
                      <th>ชื่อ-สกุล</th>
											<th>เพศ</th>
                      <th>สัญชาติ</th>
                      <th>สถานที่กักกัน</th>
                      <th>จังหวัด</th>
										</tr>
									</thead>
									<tfoot></tfoot>
									<tbody>
                    @if ($datas)
											@foreach ($datas as $key => $value)
												<tr>
													<td style="font-family:'Fira-code';"><span class="text-primary">{{ $value['sat_id'] != "" ? $value['sat_id'] : "-" }}</span></td>
                          <td>@if(isset($value['name_th']) && isset($value['lname_th'])) {{ $value['name_th'] }} {{ $value['lname_th'] }} @elseif(isset($value['name_en']) && isset($value['lname_en'])) {{ $value['name_en'] }} {{ $value['lname_en'] }} @else - @endif</td>
                          <td>@if(isset($value['sex'])) {{ $value['sex'] }} @else - @endif</td>
                          <td>@if(!empty($value['nationality'])) {{ $nationalitys[$value['nationality']] }} @else - @endif</td>
                          <td>@if(isset($value['quarantine_place'])) {{ $value['quarantine_place'] }} @else - @endif</td>
                          <td>@if(!empty($value['prov_code'])) {{ $provinces[$value['prov_code']] }} @else - @endif</td>
                        </tr>
											@endforeach
										@endif
									</tbody>
								</table>
							</div>
						</div><!-- card body -->
					</div><!-- card -->
				</div><!-- column -->
			</div><!-- row -->
		</div><!-- card body -->
	</div><!-- card -->
</div><!-- contrainer -->
@endsection
@section('bottom-script')
<script src="{{ URL::asset('assets/libs/datatables-1.10.20/datatables.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables-1.10.20/Buttons-1.6.1/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables-1.10.20/Responsive-2.2.3/js/responsive.bootstrap.min.js') }}"></script>
<script>
/* flash message */
$('#flash-overlay-modal').modal();
</script>
<script>
$(document).ready(function() {
	/* ajax request */
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	/* data table */
	$('#code_table').DataTable({
		"ordering": false,
		"searching": true,
		"paging": true,
		"pageLength": 25,
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		//"ordering": true,
		"info": false,
	});

});
</script>
<!-- <script type="text/javascript">
	function deleteData(id) {
		var id = id;
		var url = '{{ route("item.destroy", ":id") }}';
		url = url.replace(':id', id);
		$("#deleteForm").attr('action', url);
	}

	function formSubmit() {
		$("#deleteForm").submit();
	}
</script> -->
@endsection
