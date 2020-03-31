<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav" class="p-t-30">
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-database"></i><span class="hide-menu">Data </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{ route('list-data.sat') }}" class="sidebar-link"><i class="mdi mdi-folder-multiple-outline"></i><span class="hide-menu"> SAT</span></a></li>
						<li class="sidebar-item"><a href="{{ route('list-data.invest') }}" class="sidebar-link"><i class="mdi mdi-ambulance"></i><span class="hide-menu"> Invest</span></a></li>
					<li class="sidebar-item"><a href="{{ route('contactfollowtable') }}" class="sidebar-link"><i class="mdi mdi-account-multiple"></i><span class="hide-menu"> FollowUp </span></a>
						</li>
					</ul>
				</li>
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-chart-line"></i><span class="hide-menu">Report </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="#" class="sidebar-link"><i class="mdi mdi-chart-bar"></i><span class="hide-menu"> Report 1</span></a></li>
						<li class="sidebar-item"><a href="#" class="sidebar-link"><i class="mdi mdi-chart-bar"></i><span class="hide-menu"> Report 2</span></a></li>
					</ul>
				</li>
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-folder-download"></i><span class="hide-menu">Export </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{ route('allexport') }}" class="sidebar-link"><i class="mdi mdi-file-document"></i><span class="hide-menu"> PUI For SAT</span></a></li>
						<li class="sidebar-item"><a href="{{ route('export_excel') }}" class="sidebar-link"><i class="mdi mdi-file-document"></i><span class="hide-menu"> PUI For Dr.Darin</span></a></li>
					</ul>
				</li>
				@role('admin')
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-lock"></i><span class="hide-menu">UAC </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{ route('users.index') }}" class="sidebar-link"><i class="mdi mdi-account-multiple"></i><span class="hide-menu"> List Users</span></a></li>
						<li class="sidebar-item"><a href="{{ route('roles.index') }}" class="sidebar-link"><i class="mdi mdi-account-settings-variant"></i><span class="hide-menu"> Role List</span></a></li>
						<li class="sidebar-item"><a href="{{ route('permissions.index') }}" class="sidebar-link"><i class="mdi mdi-account-key"></i><span class="hide-menu"> Permission List</span></a></li>
					</ul>
				</li>
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(1)" aria-expanded="false"><i class="mdi mdi-map-marker-radius"></i><span class="hide-menu">Maps </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{ route('maps.circle') }}" class="sidebar-link"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> Circle</span></a></li>
						<li class="sidebar-item"><a href="{{ route('maps.doughnut') }}" class="sidebar-link"><i class="mdi mdi-chart-arc"></i><span class="hide-menu"> Doughnut</span></a></li>
					</ul>
				</li>
				<!-- <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(1)" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">DashBoard </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{ route('dashboardgraph.index') }}" class="sidebar-link"><i class="mdi mdi-chart-areaspline"></i><span class="hide-menu"> Covid-19 Case Report</span></a></li>
					</ul>
				</li> -->
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
