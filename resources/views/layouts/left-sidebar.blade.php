<?php
$ts = time();
$signature = "bd6efdd618ef8e481ba2e247b10735b801fbdefe";
$uid = Auth::user()->id;
$sig = sha1($uid.$ts.$signature);
$url_to_voravit = "screen/token.php?uid=".$uid."&ts=".$ts."&sig=".$sig;
$url_to_ddc_ilab = "https://ddc-ilab.invitrace.app?uid=".$uid."&ts=".$ts."&sig=".$sig;
?>
<aside class="left-sidebar font-fira" data-sidebarbg="skin5">
	<div class="scroll-sidebar">
		<nav class="sidebar-nav">
			<ul id="sidebarnav" class="p-t-30">
				<li class="sidebar-item"><a href="{{ route('main') }}" class="sidebar-link waves-effect waves-dark"><i class="fas fa-home"></i><span class="hide-menu">&nbsp;&nbsp;Home</span></a></li>
				<li class="sidebar-item"><a href="{{ route('dashboard') }}" class="sidebar-link waves-effect waves-dark"><i class="fas fa-chart-pie"></i><span class="hide-menu">&nbsp;&nbsp;Dashboard</span></a></li>
				<li class="sidebar-item"> <a href="javascript:void(0)" class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false"><i class="fas fa-expand"></i><span class="hide-menu">&nbsp;&nbsp;PUI </span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item"><a href="{{ URL::to("screen/token.php?uid=".$uid."&ts=".$ts."&sig=".$sig) }}" target="_blank" class="sidebar-link"><i class="mdi mdi-radiobox-marked"></i><span class="hide-menu"> PUI Screen</span></a></li>
						<li class="sidebar-item"><a href="{{ route('list-data.invest') }}" class="sidebar-link"><i class="mdi mdi-radiobox-marked"></i><span class="hide-menu"> PUI List (Full)</span></a></li>
						<li class="sidebar-item"><a href="{{ route('invest.search') }}" class="sidebar-link"><i class="mdi mdi-radiobox-marked"></i><span class="hide-menu"> PUI List (Min)</span></a></li>
						@role('root|ddc')
						<li class="sidebar-item"><a href="{{ route('list-data.sat') }}" class="sidebar-link"><i class="mdi mdi-radiobox-marked"></i><span class="hide-menu"> PUI For SAT</span></a></li>
						@endrole
						<li class="sidebar-item"><a href="{{ route('list-data.contact') }}" class="sidebar-link"><i class="mdi mdi-radiobox-marked"></i><span class="hide-menu"> Contact</span></a></li>
					</ul>
				</li>
				<li class="sidebar-item"> <a href="javascript:void(0)" class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false"><i class="fa fa-download"></i><span class="hide-menu">&nbsp;&nbsp;Export </span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item"><a href="{{ route('export.data') }}" class="sidebar-link"><i class="mdi mdi-radiobox-marked"></i><span class="hide-menu"> PUI</span></a></li>
						<li class="sidebar-item"><a href="{{ route('allcontactexport') }}" class="sidebar-link"><i class="mdi mdi-radiobox-marked"></i><span class="hide-menu"> Contact</span></a></li>
					</ul>
				</li>
				<li class="sidebar-item"> <a href="javascript:void(0)" class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false"><i class="fas fa-link"></i><span class="hide-menu">&nbsp;&nbsp;DDC Links </span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item"><a href="{{ $url_to_ddc_ilab }}" target="_blank" class="sidebar-link"><i class="mdi mdi-radiobox-marked"></i><span class="hide-menu"> iLab</span></a></li>
						<li class="sidebar-item"> <a href="{{ route('risk.place') }}" class="sidebar-link waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-radiobox-marked"></i><span class="hide-menu">Risk place</span></a>
					</ul>
				</li>
				@role('root|ddc')
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(1)" aria-expanded="false"><i class="far fa-map"></i><span class="hide-menu">&nbsp;&nbsp;Maps </span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item"><a href="'maps.circle'" class="sidebar-link"><i class="mdi mdi-radiobox-marked"></i><span class="hide-menu"> Circle</span></a></li>
						<li class="sidebar-item"><a href="'maps.doughnut'" class="sidebar-link"><i class="mdi mdi-radiobox-marked"></i><span class="hide-menu"> Doughnut</span></a></li>
					</ul>
				</li>
				@endrole
				@role('root|ddc|hos|dpc|pho|lab')
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-settings-variant"></i><span class="hide-menu">&nbsp;&nbsp;Users </span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item"><a href="{{ route('users.index') }}" class="sidebar-link"><i class="mdi mdi-radiobox-marked"></i><span class="hide-menu"> Users List</span></a></li>
						@role('root')
						<li class="sidebar-item"><a href="{{ route('roles.index') }}" class="sidebar-link"><i class="mdi mdi-radiobox-marked"></i><span class="hide-menu"> Role List</span></a></li>
						<li class="sidebar-item"><a href="{{ route('permissions.index') }}" class="sidebar-link"><i class="mdi mdi-radiobox-marked"></i><span class="hide-menu"> Permission List</span></a></li>
						@endrole
					</ul>
				</li>
				@endrole
				@role('root|ddc')
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(1)" aria-expanded="false"><i class="fas fa-cog"></i><span class="hide-menu">&nbsp;&nbsp;Manage </span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item"><a href="{{ route('admin.createHospToJsonFrm') }}" class="sidebar-link"><i class="mdi mdi-radiobox-marked"></i><span class="hide-menu"> New Hosp</span></a></li>
					</ul>
				</li>
				@endrole
			</ul>
		</nav>
	</div>
</aside>
