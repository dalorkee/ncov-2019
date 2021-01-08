@extends('layouts.index')
@section('internal-style')
@endsection
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('main') }}">Home</a></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid" style="min-height: 90vh;">
	<div style="margin-top: 80px;">
		<div>
			<div class="text-center"><img src="{{ URL::asset('assets/images/logo-ddc.png') }}" alt="logo"></div>
		</div>
		<div class="text-center p-t-20 p-b-20">
			<span class="db" style="display:block;font-size:1.675em;color:black;">Coronavirus disease (COVID-19)</span>
		</div>
	</div>
</div>
@endsection
@section('bottom-script')
@endsection
