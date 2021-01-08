<header class="topbar" data-navbarbg="skin5">
	<nav class="navbar top-navbar navbar-expand-md navbar-dark">
		<div class="navbar-header" data-logobg="skin5">
			<a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
			<a class="navbar-brand" href="#">
				<b class="logo-icon p-l-10">
					<img src="{{ URL::asset('assets/images/small-moph-logo.png') }}" alt="BOE" class="light-logo" style="width:95%;">
				</b>
				<span class="logo-text text-white">COVID-19</span>
			</a>
			<a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
		</div>
		<div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
			<ul class="navbar-nav float-left mr-auto">
				<li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(1)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
				<li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
					<form class="app-search position-absolute">
						<input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
					</form>
				</li>
			</ul>
			<ul class="navbar-nav float-right">
				<li class="nav-item"><a class="nav-link">{{ auth()->user()->name }}&nbsp;[@if(session()->has('user_role')) {{ Session::get('user_role') }} @endif]</a></li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						{{ Html::image('assets/images/users/1.jpg', 'alt=user', ['class'=>'rounded-circle', 'width'=>'31']) }}
					</a>
					<div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
						<ul class="list-style-none">
							<li>
								<div class="">
									<a href="javascript:void(0)" class="link border-top">
										<div class="d-flex no-block align-items-center p-10">
											<span class="btn btn-success btn-circle"><i class="mdi mdi-account"></i></span>
											<div class="m-l-10">
												<h6 class="m-b-0">{{ auth()->user()->name }}&nbsp;{{ auth()->user()->lname }}</h6>
												<span class="mail-desc">{{ auth()->user()->email }}</span>
											</div>
										</div>
									</a>
									<a href="javascript:void(0)" class="link border-top">
										<div class="d-flex no-block align-items-center p-10">
											<span class="btn btn-info btn-circle"><i class="fas fa-map-pin"></i></span>
											<div class="m-l-10">
												<h5 class="m-b-0">หน่วยงาน</h5>
												<span class="mail-desc">{{ auth()->user()->wposi }}</span>
											</div>
										</div>
									</a>
									<a href="{{ route('logout')}}" class="link border-top">
										<div class="d-flex no-block align-items-center p-10">
											<span class="btn btn-danger btn-circle"><i class="fa fa-power-off"></i></span>
											<div class="m-l-10">
												<h5 class="m-b-0">Logout</h5>
												<span class="mail-desc"></span>
											</div>
										</div>
									</a>
								</div>
							</li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
	</nav>
</header>
