@extends('layouts.index')
@section('custom-style')
<link type="text/css" href="{{ URL::asset('admindek/css/style.css') }}" rel="stylesheet" >
@endsection
@section('custom-style')
<style>
	input:-moz-read-only { /* For Firefox */
		background-color: #fafafa !important;
	}
	input:read-only {
		background-color: #fafafa !important;
	}
	.select-custom select option {
		padding: 18px!important;
	}
	.font-fira {
		font-family: 'Fira-code' !important;
	}
	.input-group .bootstrap-select.form-control {
		z-index: 0;
	}
</style>
@endsection
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">Users</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
						<li class="breadcrumb-item active" aria-current="page"><a href="#">Manage</a></li>
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
					<div class="d-md-flex align-items-center" style="border-bottom:1px solid #EAEAEA">
						<div>
							<h4 class="card-title">บริหารจัดการผู้ใช้งานระบบ</h4>
							<h5 class="card-subtitle">ID Flu-BOE</h5>
						</div>
					</div>
					<div class="my-4">
							<a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
					</div>
					@if ($message = Session::get('success'))
						<div class="alert alert-success">
							<p>{{ $message }}</p>
						</div>
					@endif
					<table class="table table-bordered">
						<tr>
							<th>No</th>
							<th>Name</th>
							<th width="280px">Action</th>
						</tr>
						@foreach ($roles as $key => $role)
						<tr>
							<td>{{ ++$i }}</td>
							<td>{{ $role->name }}</td>
							<td>
								<a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
								@can('role-edit')
									<a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
								@endcan
								@can('role-delete')
									{!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
									{!! Form::submit('Delete', ['class' => 'btn btn-danger text-primary']) !!}
									{!! Form::close() !!}
								@endcan
							</td>
						</tr>
						@endforeach
					</table>
					{!! $roles->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
