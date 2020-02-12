<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav" class="p-t-30">
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false"><i class="mdi mdi-speedometer"></i><span class="hide-menu"> Dashboard</span></a></li>
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-format-list-bulleted"></i><span class="hide-menu">Data </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{ route('investList.index') }}" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> Lists PUI</span></a></li>
						<li class="sidebar-item"><a href="{{ route('screenpui.create') }}" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> Screen PUI</span></a></li>
						<li class="sidebar-item"><a href="{{ route('allcasecontacttable') }}" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> Lists Contact</span></a></li>
					</ul>
				</li>
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-chart-line"></i><span class="hide-menu">Report </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{ route('export_excel') }}" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> Download PUI (For DA)</span></a></li>
						<li class="sidebar-item"><a href="{{ route('allexport') }}" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> Download PUI (For SAT)</span></a></li>
					</ul>
				</li>
				@role('admin')
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('users.index') }}" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Users</span></a></li>
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
