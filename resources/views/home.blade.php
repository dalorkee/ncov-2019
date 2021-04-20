@extends('layouts.index')
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('custom-style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('admindek/css/waves.min.css') }}" media="all">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('admindek/css/feather.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('admindek/css/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('admindek/css/sweetalert.css') }}">
@endsection
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('main') }}"><i class="fas fa-home"></i> Home</a></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid font-fira" style="min-height: 90vh;">
	<div class="row">
		<div class="col-lg-12 font-fira">
			<div class="text-center p-t-20 p-b-20">
				<span class="db" style="display:block;font-size:2em;color:#34495e;">Changelog</span>
			</div>
			<div class="text-center p-t-20 p-b-20">
				<span class="badge badge-success">N</span><span class="ml-2 mr-4">New</span>
				<span class="badge badge-danger">F</span><span class="ml-2 mr-4">Fix</span>
				<span class="badge badge-warning">E</span><span class="ml-2">Enhance</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card-block accordion-block color-accordion-block font-fira">
				<div class="color-accordion" id="color-accordion">
					<a class="accordion-msg b-none waves-effect waves-light text-white" style="background: #34495e;">Version 1.0.1</a>
					<div class="accordion-desc">

						<div class="card feed-card font-fira">
							<div class="card-header">
								<h5 class="font-fira">FEBRUARY 25, 2021</h5>
								<div class="card-header-right">
									<ul class="list-unstyled card-option">
										<li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
										<li><i class="feather icon-maximize full-card"></i></li>
										<li><i class="feather icon-minus minimize-card"></i></li>
										<li><i class="feather icon-refresh-cw reload-card"></i></li>
										<li><i class="feather icon-trash close-card"></i></li>
										<li><i class="feather icon-chevron-left open-card-option"></i></li>
									</ul>
								</div>
							</div>
							<div class="card-block font-fira">
								<div class="row m-b-30 align-items-center">
									<div class="col-auto p-r-0">
										<span class="badge badge-success">N</span>
									</div>
									<div class="col">
										<a href="#!">เพิ่มปุ่มลบข้อมูลในหน้า PUI List (Min)</a>
									</div>
								</div>
								<div class="row m-b-30 align-items-center">
									<div class="col-auto p-r-0">
										<span class="badge badge-success">N</span>
									</div>
									<div class="col">
										<a href="#!">เพิ่มเงื่อนไขการค้นหาข้อมูล โดยสามารถค้นหาจาก SAT CODE และ Passport ในหน้า PUI List (Min)</a>
									</div>
								</div>
							</div>
						</div>

						<div class="card feed-card font-fira">
							<div class="card-header">
								<h5 class="font-fira">FEBRUARY 01, 2021</h5>
								<div class="card-header-right">
									<ul class="list-unstyled card-option">
										<li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
										<li><i class="feather icon-maximize full-card"></i></li>
										<li><i class="feather icon-minus minimize-card"></i></li>
										<li><i class="feather icon-refresh-cw reload-card"></i></li>
										<li><i class="feather icon-trash close-card"></i></li>
										<li><i class="feather icon-chevron-left open-card-option"></i></li>
									</ul>
								</div>
							</div>
							<div class="card-block font-fira">
								<div class="row m-b-30 align-items-center">
									<div class="col-auto p-r-0">
										<span class="badge badge-warning">E</span>
									</div>
									<div class="col">
										<a href="#!">เรียงลำดับ PUI List (Min) จากลำดับหลังสุดนำมาแสดงผลก่อน</a>
									</div>
								</div>
								<div class="row m-b-30 align-items-center">
									<div class="col-auto p-r-0">
										<span class="badge badge-danger">F</span>
									</div>
									<div class="col">
										<a href="#!">Fixed bug Colab ไม่สามารถดูผลการส่งได้</a>
									</div>
								</div>
								<div class="row m-b-30 align-items-center">
									<div class="col-auto p-r-0">
										<span class="badge badge-warning">E</span>
									</div>
									<div class="col">
										<a href="#!">เรียงลำดับ Contact List จากลำดับหลังสุดนำมาแสดงผลก่อน</a>
									</div>
								</div>
							</div>
						</div>
						<div class="card feed-card font-fira">
							<div class="card-header">
								<h5 class="font-fira">JANUARY 28, 2021</h5>
								<div class="card-header-right">
									<ul class="list-unstyled card-option">
										<li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
										<li><i class="feather icon-maximize full-card"></i></li>
										<li><i class="feather icon-minus minimize-card"></i></li>
										<li><i class="feather icon-refresh-cw reload-card"></i></li>
										<li><i class="feather icon-trash close-card"></i></li>
										<li><i class="feather icon-chevron-left open-card-option"></i></li>
									</ul>
								</div>
							</div>
							<div class="card-block font-fira">
								<div class="row m-b-30 align-items-center">
									<div class="col-auto p-r-0">
										<span class="badge badge-warning">E</span>
									</div>
									<div class="col">
										<a href="#!">จัดกลุ่มเมนูหลัก โดยเลือกเมนูที่มีความสอดคล้องกันให้มาอยู่ในกลุ่มเดียวกัน</a>
									</div>
								</div>
								<div class="row m-b-30 align-items-center">
									<div class="col-auto p-r-0">
										<span class="badge badge-success">N</span>
									</div>
									<div class="col">
										<a href="#!">เพิ่มเมนูใหม่ PUI List (Min) สำหรับลิ้งค์ไปยังหน้าการค้นหาข้อมูล PUI แบบเร่งด่วน</a>
									</div>
								</div>
								<div class="row m-b-30 align-items-center">
									<div class="col-auto p-r-0">
										<span class="badge badge-success">N</span>
									</div>
									<div class="col">
										<a href="#!">เพิ่มสิทธิ์การค้นหาข้อมูลในหน้าการค้นหาข้อมูล PUI แบบเร่งด่วน ให้แยกตามสิทธิ์ผู้ใช้</a>
									</div>
								</div>
								<div class="row m-b-30 align-items-center">
									<div class="col-auto p-r-0">
										<span class="badge badge-success">N</span>
									</div>
									<div class="col">
										<a href="#!">เพิ่ม Feature การค้นหาข้อมูล PUI แบบเร่งด่วน => PUI List (Min)</a>
									</div>
								</div>
								<div class="row m-b-30 align-items-center">
									<div class="col-auto p-r-0">
										<span class="badge badge-danger">F</span>
									</div>
									<div class="col">
										<a href="#!">Fixed bug การค้นหาข้อมูลในหน้าการจัดการผู้ใช้ที่ไม่สามารถค้นหาในแถบ Pagination ได้ => Users List</a>
									</div>
								</div>
								<div class="row m-b-20 align-items-center">
									<div class="col-auto p-r-0">
										<span class="badge badge-warning">E</span>
									</div>
									<div class="col">
										<a href="#!">ปรับปรุงระบบการส่งข้อมูลผู้สัมผัสไปยังระบบ Colab</a>
									</div>
								</div>
								<div class="row m-b-20 align-items-center">
									<div class="col-auto p-r-0">
										<span class="badge badge-warning">E</span>
									</div>
									<div class="col">
										<a href="#!">ปรับปรุงการดาวน์โหลดข้อมูลผู้สัมผัส</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--
					<a class="accordion-msg bg-darkest-primary b-none waves-effect waves-light">JANUARY 26, 2021</a>
					<div class="accordion-desc">
					</div>
					-->
				</div>
			</div>
		</div>
	</div>
	<div class="modal hide fade in" id="notic" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header bg-danger">
					<h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> ประกาศ</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>เนื่องจากระบบ COLAB อยู่ระหว่างการเปลี่ยน Version อาจทำให้การส่งข้อมูลทางห้องปฏิบัติการ (Lab) จากระบบ DDC Covid-19 ไปยังระบบ COLAB มีอุปสรรคได้</p>
					<p class="text-danger">*** ถ้ามีข้อสงสัยในการส่งข้อมูล โปรดติดต่อทีมงาน COLAB</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger waves-effect " data-dismiss="modal">ปิด</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('bottom-script')
<script type="text/javascript" src="{{ URL::asset('admindek/js/waves.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('admindek/js/accordion.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('admindek/js/script.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('admindek/js/sweetalert.min.js') }}"></script>
<script type="text/javascript">
	$(window).on('load', function() {
		$('#notic').modal('show');
	});
</script>
@endsection
