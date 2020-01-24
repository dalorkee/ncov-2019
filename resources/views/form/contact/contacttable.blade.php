@extends('layouts.index')
<link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/bootstrap.css') }}" rel="stylesheet">
<link type="text/css" href="{{ URL::asset('assets/contact/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@section('contents')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Contact Table</h4>
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
						<a class="btn btn-success" href="{{ route('addcontact',["inv_id" => '1']) }}">
							+	เพิ่มผู้สัมผัส
						</a>
					</div>
					<br>
          <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sex</th>
                <th>Age</th>
                <th>Nation</th>
                <th>Province</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Michael Bruce</td>
                <td>Javascript Developer</td>
                <td>Singapore</td>
                <td>29</td>
                <td>2011/06/27</td>
                <td>$183,000</td>
                <td>
                  <a class="btn btn-danger" href="{{ route('contactfollowtable',["inv_id" => '1',"contact_id" => '1']) }}">
                      ติดตามอาการ
                  </a>
                    <a class="btn btn-info" href="{{ route('addcontact',["inv_id" => '1']) }}">
                      Detail
                  </a>
                  <a class="btn btn-warning" href="{{ route('addcontact',["inv_id" => '1']) }}">
                      Edit
                  </a>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
              <th>ID</th>
              <th>Sex</th>
              <th>Age</th>
              <th>Nation</th>
              <th>Province</th>
              <th>Status</th>
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
