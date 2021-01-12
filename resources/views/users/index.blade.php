@extends('layouts.index')
@section('custom-style')
<link type="text/css" href="{{ URL::asset('admindek/css/style.css') }}" rel="stylesheet" >
@endsection
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">Users</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
						<li class="breadcrumb-item active" aria-current="page"><a href="#">List</a></li>
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
					@if (Session::get('success'))
						<div class="alert alert-success">
							<p>{{ Session::get('success') }}</p>
						</div>
					@elseif (Session::get('error'))
						<div class="alert alert-danger">
							<p>{{ Session::get('error') }}</p>
						</div>
					@endif
					@if ((auth()->user()->hasRole('root')) || ($chkCreateUserAmount > 0 && auth()->user()->create_user_permission == 'y'))
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-7 col-xl-8  mt-2 mb-2">
								<a class="btn btn-info" href="{{ route('users.create') }}"><i class="fas fa-user-plus"></i> สร้างผู้ใช้ใหม่ <span class="badge text-danger">สร้างผู้ใช้ได้อีก {!! $chkCreateUserAmount !!}</span></a>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4  mt-2 mb-2">
								<form action="{{ route('user.search') }}" method="GET" class="form-inline">
									<input type="text" name="usr_search" class="form-control" placeholder="ค้นหาชื่อผู้ใช้" style="height: 45px;">
									<div class="input-group-append">
										<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
									</div>
								</form>
							</div>
						</div>
					@else
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-7 col-xl-8  mt-2 mb-2">
								<button class="btn btn-danger">ไม่มีสิทธิ์สร้างผู้ใช้ / สิทธิ์สร้างผู้ใช้ครบตามจำนวนแล้ว</button>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4  mt-2 mb-2">
								<form action="{{ route('user.search') }}" method="GET" class="form-inline">
									<input type="text" name="usr_search" class="form-control" placeholder="ค้นหาชื่อผู้ใช้" style="height: 45px;">
									<div class="input-group-append">
										<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
									</div>
								</form>
							</div>
						</div>

					@endif

					<table class="table table-hover responsive">
						<thead class="text-primary">
							<tr>
								<th>รหัส</th>
								<th>ชื่อผู้ใช้</th>
								<th>ชื่อ-สกุล</th>
								<th>อีเมล์</th>
								<th>รหัสหน่วยงาน</th>
								<th>Role</th>
								<th>#</th>
							</tr>
						</thead>
						<tfoot></tfoot>
						<tbody>
							@if (count($data) > 0)
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
													@if ($v == 'root')
														<label class="badge badge-danger">{{ $v }}</label>
													@elseif ($v == 'pho')
														<label class="badge badge-warning">{{ $v }}</label>
													@else
														<label class="badge badge-success">{{ $v }}</label>
													@endif
												@endforeach
											@endif
										</td>
										<td>
											<a class="btn btn-info btn-sm" href="{{ route('users.show', $user->id) }}">Show</a>
											@if (auth()->user()->create_user_permission == 'y')
												<a class="btn btn-warning btn-sm" href="{{ route('users.edit', $user->id) }}">Edit</a>
											@endif
											@role('root')
												{!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
												{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
												{!! Form::close() !!}
											@endrole
										</td>
									</tr>
								@endforeach
							@endif
						</tbody>
					</table>
					@if (count($data) > 0)
						{!! $data->render() !!}
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
