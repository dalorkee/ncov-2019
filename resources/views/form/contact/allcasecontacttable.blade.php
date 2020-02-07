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
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<br>
					<div class="table-responsive">
          <table id="example" class="table-striped" style="width:100%">
        <thead>
            <tr>
							<th>ID</th>
                <th>Contact ID</th>
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
								<td>{{ $value->id }}</td>
                <td>{{ $value->contact_id }}</td>
                <td>{{ $value->name_contact }}</td>
                <td>{{ $value->passport_contact }}</td>
                <td>{{ $value->age_contact }}</td>
								<td>{{ $value->national_contact }}</td>
                <td>
                  <a class="btn btn-danger" href="{{ route('contactfollowtable')}}?sat_id={{ $value->sat_id }}&contact_id={{ $value->contact_id }}">
                      ติดตามอาการ
                  </a>
                    <a class="btn btn-info" href="{{ route('detailcontact')}}?sat_id={{ $value->sat_id }}&contact_id={{ $value->contact_id }}">
                      รายละเอียด
                  </a>
                  <a class="btn btn-warning" href="#">
                      แก้ไขข้อมูล
                  </a>
                </td>
            </tr>
						<?php endforeach;?>
        </tbody>
    </table>
	</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('bottom-script')
{{-- <script src="{{ URL::asset('assets/contact/datatable/js/jquery-3.3.1.js') }}"></script> --}}
<script src="{{ URL::asset('assets/contact/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/contact/datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
			} );
</script>
<script>
document.getElementById("btnPrint").onclick = function () {
    printElement(document.getElementById("printThis"));
}

function printElement(elem) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
}
</script>
@endsection
