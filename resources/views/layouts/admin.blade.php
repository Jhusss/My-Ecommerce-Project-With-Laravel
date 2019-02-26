<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Ailoveyu Apparel Admin</title>

<!-- Bootstrap Core CSS -->
<link href="{{ asset('css/backend/css/bootstrap.css') }}" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="{{ asset('css/backend/css/style.css') }}" rel='stylesheet' type='text/css' />
<!-- font-awesome icons CSS -->
<link href="{{ asset('css/backend/css/font-awesome.css') }}" rel="stylesheet"> 
<!-- //font-awesome icons CSS-->
<!-- side nav css file -->
<link href="{{ asset('css/backend/css/SidebarNav.min.css') }}" media='all' rel='stylesheet' type='text/css'/>
<!-- //side nav css file -->
 <!-- js-->
<script src="{{ asset('js/backend/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('js/backend/js/modernizr.custom.js') }}"></script>
<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts--> 
<!-- chart -->
<script src="{{ asset('js/backend/js/Chart.js') }}"></script>
<!-- //chart -->
<!-- Metis Menu -->
<script src="{{ asset('js/backend/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('js/backend/js/custom.js') }}"></script>
<link href="{{ asset('css/backend/css/custom.css') }}" rel="stylesheet">
<!--//Metis Menu -->
</head> 
<body class="cbp-spmenu-push">
		<div class="main-content">
			<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
				<!--left-fixed -navigation-->
				<aside class="sidebar-left">
					<nav class="navbar navbar-inverse">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								</button>
								<h1><a class="navbar-brand" target="_blank" href="{{ route('front') }}"><span class="fa fa-area-chart"></span> Ailoveyu<span class="dashboard_text">Design dashboard</span></a></h1>
							</div>
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<ul class="sidebar-menu">
									<li class="header">MAIN NAVIGATION</li>
									<li class="treeview">
										<a href="{{ route('admin.index') }}">
										<i class="fa fa-dashboard"></i> <span>Dashboard</span>
										</a>
									</li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-laptop"></i>
										<span>Products</span>
										<i class="fa fa-angle-left pull-right"></i>
										</a>
										<ul class="treeview-menu">
											<li><a href="{{ route('products.index') }}"><i class="fa fa-angle-right"></i> All Products</a></li>
											<li><a href="{{ route('products.create') }}"><i class="fa fa-angle-right"></i> Create Product</a></li>
										</ul>
									</li>

									<li>
										<a href="{{ route('categories.index') }}">
										<i class="fa fa-th"></i> <span>Categories</span>
										</a>
									</li>

									<li class="treeview">
										<a href="#">
										<i class="fa fa-user"></i>
										<span>Users</span>
										<i class="fa fa-angle-left pull-right"></i>
										</a>
										<ul class="treeview-menu">
											<li><a href="{{ route('users.index') }}"><i class="fa fa-angle-right"></i> All Users</a></li>
											<li><a href="{{ route('users.create')}}"><i class="fa fa-angle-right"></i> Create User</a></li>
										</ul>
									</li>
				
									<li class="treeview">
										<a href="#">
										<i class="fa fa-file-image-o"></i> <span>Banners</span>
										<i class="fa fa-angle-left pull-right"></i>
										</a>
										<ul class="treeview-menu">
											<li><a href="{{ route('banners.index') }}"><i class="fa fa-angle-right"></i> All Banners</a></li>
											<li><a href="{{ route('banners.create') }}"><i class="fa fa-angle-right"></i> Add Banner</a></li>
										</ul>
									</li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-table"></i> <span>Orders</span>
										<i class="fa fa-angle-left pull-right"></i>
										</a>
										<ul class="treeview-menu">
											<li><a href="{{ route('view-orders')}}"><i class="fa fa-angle-right"></i> View Orders</a></li>
										</ul>
									</li>

									<li class="treeview">
										<a href="#">
										<i class="fa fa-table"></i> <span>Cms Pages</span>
										<i class="fa fa-angle-left pull-right"></i>
										</a>
										<ul class="treeview-menu">
											<li><a href="{{ route('add-cms-page')}}"><i class="fa fa-angle-right"></i> Add CMS Page</a></li>
										</ul>

										<ul class="treeview-menu">
											<li><a href="{{ route('view-cms-pages')}}"><i class="fa fa-angle-right"></i> View CMS Page</a></li>
										</ul>
									</li>
								</ul>
							</div>
							<!-- /.navbar-collapse -->			
					</nav>
					
				</aside>
			</div>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush" style="margin-left: 10px;"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
	
			</div>
			<div class="header-right">			
				<!--search-box-->
				<div class="search-box">
					<form class="input">
						<input class="sb-search-input input__field--madoka" placeholder="Search.." type="search" id="input-31" />
						<label class="input__label" for="input-31">
							<svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
								<path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
							</svg>
						</label>
					</form>
				</div><!--//end-search-box-->
				
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">						
									<div class="user-name">
											<p>Administrator!</p>		
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li> <a href="{{ url('admin/settings') }}"><i class="fa fa-cog"></i> Admin Settings</a> </li> 
								<li> <a href="{{ route('logout') }}"><i class="fa fa-sign-out" ></i> Logout</a> </li>
							</ul>
						</li>
					</ul>
				</div>	
			<div class="clearfix"></div>
			<div class="clearfix"> </div>	
		</div>
		</div>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			
				@yield('content')
				
			</div>
		</div>
	</div>
		
	<!--footer-->

	<div class="footer">
				<p>&copy; 2019 Ailoveyu Apparel Dashboard. All Rights Reserved.</p>		
	</div>


		<!---------  EFFECTS FOR SIDE NAV  ------------->


	<!-- Classie -->
  <script src="{{ asset('js/backend/js/classie.js') }}"></script>
  <script>
    var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
      showLeftPush = document.getElementById( 'showLeftPush' ),
      body = document.body;
      
    showLeftPush.onclick = function() {
      classie.toggle( this, 'active' );
      classie.toggle( body, 'cbp-spmenu-push-toright' );
      classie.toggle( menuLeft, 'cbp-spmenu-open' );
      disableOther( 'showLeftPush' );
    };
    
    function disableOther( button ) {
      if( button !== 'showLeftPush' ) {
        classie.toggle( showLeftPush, 'disabled' );
      }
    }
  </script>
  

	<script src="{{ asset('js/backend/js/SidebarNav.min.js') }}" type='text/javascript'></script>
	<script>
			$('.sidebar-menu').SidebarNav()
	</script>

			
		
	<!-- Bootstrap Core JavaScript -->
	 <script src="{{ asset('js/backend/js/bootstrap.js') }}"></script>
	
</body>
</html>