<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav" class="p-t-30">
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fas fa-tasks"></i><span class="hide-menu">Form </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{ route('pui-screen') }}" class="sidebar-link"><i class="fas fa-filter"></i><span class="hide-menu"> PUI Screen</span></a></li>
						@role('root|ddc|dpc')
						<li class="sidebar-item"><a href="{{ route('list-data.sat') }}" class="sidebar-link"><i class="mdi mdi-folder-multiple-outline"></i><span class="hide-menu"> SAT</span></a></li>
						@endrole
						@role('root|ddc|dpc|pho|hos')
						<li class="sidebar-item"><a href="{{ route('list-data.invest') }}" class="sidebar-link"><i class="mdi mdi-ambulance"></i><span class="hide-menu"> Invest</span></a></li>
						@endrole
					<li class="sidebar-item"><a href="{{ route('contactfollowtable') }}" class="sidebar-link"><i class="mdi mdi-cube-unfolded"></i><span class="hide-menu"> FollowUp </span></a>
						</li>
					</ul>
				</li>
				@role('root|ddc|hos|dpc|pho')
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-cloud-download"></i><span class="hide-menu">Export </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{ route('allexport') }}" class="sidebar-link"><i class="mdi mdi-file-document"></i><span class="hide-menu"> PUI For SAT</span></a></li>
						<li class="sidebar-item"><a href="{{ route('allcontactexport') }}" class="sidebar-link"><i class="mdi mdi-file-document"></i><span class="hide-menu"> Contact For SAT</span></a></li>
					</ul>
				</li>
				@endrole
				@role('root|ddc')
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(1)" aria-expanded="false"><i class="mdi mdi-map-marker-radius"></i><span class="hide-menu">Maps </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{ route('maps.circle') }}" class="sidebar-link"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> Circle</span></a></li>
						<li class="sidebar-item"><a href="{{ route('maps.doughnut') }}" class="sidebar-link"><i class="mdi mdi-chart-arc"></i><span class="hide-menu"> Doughnut</span></a></li>
					</ul>
				</li>
				@endrole
				@role('root')
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-settings-variant"></i><span class="hide-menu">Users </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{ route('users.index') }}" class="sidebar-link"><i class="mdi mdi-account-multiple"></i><span class="hide-menu"> List Users</span></a></li>
						<li class="sidebar-item"><a href="{{ route('roles.index') }}" class="sidebar-link"><i class="mdi mdi-account-settings-variant"></i><span class="hide-menu"> Role List</span></a></li>
						<li class="sidebar-item"><a href="{{ route('permissions.index') }}" class="sidebar-link"><i class="mdi mdi-account-key"></i><span class="hide-menu"> Permission List</span></a></li>
						<li class="sidebar-item"><a href="{{ route('export-page') }}" class="sidebar-link"><i class="mdi mdi-file-document"></i><span class="hide-menu"> PUI</span></a></li>
					</ul>
				</li>
				@endrole
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
