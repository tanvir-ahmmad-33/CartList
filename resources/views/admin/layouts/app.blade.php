@include('admin.common.head')
	<body class="hold-transition sidebar-mini">
		<!-- Site wrapper -->
		<div class="wrapper">
			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<!-- Right navbar links -->
				@include('admin.common.rightnavbar')
			</nav>
			<!-- /.navbar -->
			<!-- Main Sidebar Container -->
			@include('admin.common.mainsidebar')
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content -->
				@yield('content')
			</div>
			<!-- /.content-wrapper -->
			
            @include('admin.common.footer')
		</div>
		<!-- ./wrapper -->
		@include('admin.common.js')

		@stack('scripts')
	</body>
</html>