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
					</div>
					<br>
          <table class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>###</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
					<?php for ($x = 1; $x <= 14; $x++) { ?>
            <tr>
							<td>
										ติดตามอาการครั้งที่ <?php echo $x; ?>
								</a>
							</td>
                <td>
                  <a class="btn btn-warning" href="{{ route('followupcontact',["inv_id" => $inv_id,"contact_id" => $contact_id,"contact_id_day" => $x]) }}">
                      กรอกข่อมูลการติดตามอาการ
                  </a>
                </td>
            </tr>
					<?php }?>
        </tbody>
        <tfoot>
            <tr>
              <th>###</</th>
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
