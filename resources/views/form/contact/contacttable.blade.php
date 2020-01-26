@extends('layouts.index')
<link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/bootstrap.css') }}" rel="stylesheet">
<link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@section('contents')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">ตารางผู้สัมผัส</h4>
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
					<div class="col-md-12">
						<?php
							$poe_id = $_GET['poe_id'];
						 ?>
						<a class="btn btn-success" href="{{ route('addcontact')}}?poe_id=<?php echo $poe_id ;?>">
							+	เพิ่มผู้สัมผัส
						</a>
					</div>
					<br>
          <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>POE ID</th>
                <th>ชื่อ-สกุล</th>
								<th>Passport</th>
                <th>อายุ</th>
                <th>สัญชาติ</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
					<?php foreach($contact_data as $value) : ?>
            <tr>
                <td>{{ $value->poe_id }}</td>
                <td>{{ $value->name_contact }}</td>
                <td>{{ $value->passport_contact }}</td>
                <td>{{ $value->age_contact }}</td>
                <td>{{ $value->national_contact }}</td>
                <td>
                  <a class="btn btn-danger" href="{{ route('contactfollowtable')}}?poe_id={{ $value->poe_id }}&contact_id={{ $value->contact_id }}">
                      ติดตามอาการ
                  </a>
                    <a class="btn btn-info" href="{{ route('addcontact')}}">
                      Detail
                  </a>
                  <a class="btn btn-warning" href="{{ route('addcontact')}}">
                      Edit
                  </a>
                </td>
            </tr>
						<?php endforeach;?>
        </tbody>
        <tfoot>
            <tr>
							<th>POE ID</th>
							<th>ชื่อ-สกุล</th>
							<th>Passport</th>
							<th>อายุ</th>
							<th>สัญชาติ</th>
							<th>Action</th>
            </tr>
        </tfoot>
    </table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('bottom-script')
<script src="{{ URL::asset('assets/contact/datatable/js/jquery-3.3.1.js') }}"></script>
<script src="{{ URL::asset('assets/contact/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/contact/datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection
