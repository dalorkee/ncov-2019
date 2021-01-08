   @extends('layouts.index')
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">Users</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
						<li class="breadcrumb-item active" aria-current="page">List</li>
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
					@if ($chkCreateUserAmount != 'forbidden')
						<div class="row mt-2 mb-2">
							<div class="col-lg-8">
								<a class="btn btn-info" href="{{ route('users.create') }}"><i class="fas fa-user-plus"></i> สร้างผู้ใช้ใหม่ <span class="badge text-danger">สร้างผู้ใช้ได้อีก {!! $chkCreateUserAmount !!}</span></a>
							</div>
							<div class="col-lg-4">
								<form action="{{ route('user.search') }}" method="GET" class="form-inline">
									<input type="text" name="usr_search" class="form-control" placeholder="ค้นหาชื่อผู้ใช้" style="height: 45px;">
									<div class="input-group-append">
										<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
									</div>
								</form>
							</div>
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
													@else
													<label class="badge badge-success">{{ $v }}</label>
													@endif
												@endforeach
											@endif
										</td>
										<td>
											<a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}">Show</a>
											@role('root')
											<a class="btn btn-warning btn-sm" href="{{ route('users.edit',$user->id) }}">Edit</a>
											@endrole
											{!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
											@role('root')
											{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
											@endrole
											{!! Form::close() !!}
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
