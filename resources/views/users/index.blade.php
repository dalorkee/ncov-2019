@extends('layouts.index')
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">Users</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
						<li class="breadcrumb-item active" aria-current="page">Manage</li>
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
							<h5 class="card-subtitle">DDC Covid-19</h5>
						</div>
					</div>
					<div class="my-4">
						<a class="btn btn-success" href="{{ route('users.create') }}"> สร้างผู้ใช้ใหม่</a>
					</div>
					@if ($message = Session::get('success'))
						<div class="alert alert-success">
							<p>{{ $message }}</p>
						</div>
					@endif
					<table class="table table-hover">
						<thead class="text-primary">
							<tr>
								<th>รหัส</th>
								<th>ชื่อผู้ใช้</th>
								<th>ชื่อ-สกุล</th>
								<th>อีเมล์</th>
								<th>รหัสหน่วยงาน</th>
								<th>สิทธิ์ผู้ใช้</th>
								<th>#จัดการ</th>
							</tr>
						</thead>
						<tfoot></tfoot>
						<tbody>
							@foreach ($data as $key => $user)
								<tr>
									<td>{{ ++$i }}</td>
									<td>{{ $user->username }}</td>
									<td>{{ $user->name.' '.$user->lname }}</td>
									<td>{{ $user->email }}</td>
									<td>{{ $user->hospcode }}</td>
									<td>
										@if(!empty($user->getRoleNames()))
											@foreach($user->getRoleNames() as $v)
												<label class="badge badge-success">{{ $v }}</label>
											@endforeach
										@endif
									</td>
									<td>
										<a class="btn btn-warning btn-sm" href="{{ route('users.show',$user->id) }}">Show</a>
										@role('root')
										<a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
										@endrole
										{!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
										@role('root')
										{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
										@endrole
										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{!! $data->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
