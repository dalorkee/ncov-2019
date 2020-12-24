<?php
$ts = time();
$signature = "bd6efdd618ef8e481ba2e247b10735b801fbdefe";
$uid = Auth::user()->id;
$sig = sha1($uid.$ts.$signature);
$url_to_voravit = "screen/token.php?uid=".$uid."&ts=".$ts."&sig=".$sig;
$url_to_ddc_ilab = "https://ddc-ilab.invitrace.app?uid=".$uid."&ts=".$ts."&sig=".$sig;
?>
<aside class="left-sidebar" data-sidebarbg="skin5">
	<div class="scroll-sidebar">
		<nav class="sidebar-nav">
			<ul id="sidebarnav" class="p-t-30">
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-align-center"></i><span class="hide-menu">Manage data </span></a>
					<ul aria-expanded="false" class="collapse first-level">
						@role('root|ddc|dpc|pho|hos')
						<li class="sidebar-item"><a href="{{ route('main') }}" class="sidebar-link"><i class="mdi mdi-chevron-double-right"></i><span class="hide-menu"> Home</span></a></li>
						<li class="sidebar-item"><a href="{{ URL::to("screen/token.php?uid=".$uid."&ts=".$ts."&sig=".$sig) }}" target="_blank" class="sidebar-link"><i class="mdi mdi-chevron-double-right"></i><span class="hide-menu"> PUI Screen</span></a></li>
						<li class="sidebar-item"><a href="{{ route('list-data.invest') }}" class="sidebar-link"><i class="mdi mdi-chevron-double-right"></i><span class="hide-menu"> PUI List</span></a></li>
						@endrole
						<li class="sidebar-item"><a href="{{ route('list-data.contact') }}" class="sidebar-link"><i class="mdi mdi-chevron-double-right"></i><span class="hide-menu"> Contact</span></a></li>
						<li class="sidebar-item"><a href="{{ $url_to_ddc_ilab }}" target="_blank" class="sidebar-link"><i class="mdi mdi-chevron-double-right"></i><span class="hide-menu"> DDC iLab</span></a></li>
						@role('root|ddc')
						<li class="sidebar-item"><a href="{{ route('list-data.sat') }}" class="sidebar-link"><i class="mdi mdi-chevron-double-right"></i><span class="hide-menu"> SAT</span></a></li>
						@endrole
					</ul>
				</li>
				@role('root|ddc|hos|dpc|pho')
				<li class="sidebar-item"> <a href="{{ route('risk.place') }}" class="sidebar-link waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="far fa-bell"></i><span class="hide-menu">Risk place</span></a>
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-download"></i><span class="hide-menu">Export </span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item"><a href="{{ route('export.data') }}" class="sidebar-link"><i class="mdi mdi-chevron-double-right"></i><span class="hide-menu"> PUI</span></a></li>
						<li class="sidebar-item"><a href="{{ route('allcontactexport') }}" class="sidebar-link"><i class="mdi mdi-chevron-double-right"></i><span class="hide-menu"> Contact</span></a></li>
					</ul>
				</li>
				@endrole
				@role('root|ddc')
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(1)" aria-expanded="false"><i class="mdi mdi-map-marker-radius"></i><span class="hide-menu">Maps </span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item"><a href="{{ route('maps.circle') }}" class="sidebar-link"><i class="mdi mdi-chevron-double-right"></i><span class="hide-menu"> Circle</span></a></li>
						<li class="sidebar-item"><a href="{{ route('maps.doughnut') }}" class="sidebar-link"><i class="mdi mdi-chevron-double-right"></i><span class="hide-menu"> Doughnut</span></a></li>
					</ul>
				</li>
				@endrole
				@role('root')
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-settings-variant"></i><span class="hide-menu">Users </span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item"><a href="{{ route('users.index') }}" class="sidebar-link"><i class="mdi mdi-chevron-double-right"></i><span class="hide-menu"> List Users</span></a></li>
						<li class="sidebar-item"><a href="{{ route('roles.index') }}" class="sidebar-link"><i class="mdi mdi-chevron-double-right"></i><span class="hide-menu"> Role List</span></a></li>
						<li class="sidebar-item"><a href="{{ route('permissions.index') }}" class="sidebar-link"><i class="mdi mdi-chevron-double-right"></i><span class="hide-menu"> Permission List</span></a></li>
					</ul>
				</li>
				@endrole
			</ul>
		</nav>
	</div>
</aside>
