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
						<li class="sidebar-item"><a href="{{ route('investList.index') }}" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> List</span></a></li>
						<li class="sidebar-item"><a href="{{ route('walkincase.create') }}" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> walkincase</span></a></li>
					</ul>
				</li>
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-chart-line"></i><span class="hide-menu">Report </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="#" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> Report#1</span></a></li>
						<li class="sidebar-item"><a href="#" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> Report#2</span></a></li>
					</ul>
				</li>

			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
