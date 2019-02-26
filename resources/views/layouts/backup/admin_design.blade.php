@include('layouts/admin_header')
			
	<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">

		<!---- SIDE NAV -->

		@include('layouts/admin_sidenav')
	
	</div>
		
		<!--- TOP NAV -->
		@include('layouts/admin_topnav')



		<!-- main content start-->


		@yield('content')
		
				
	
@include('layouts/admin_footer')