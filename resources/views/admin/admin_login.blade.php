<!DOCTYPE HTML>
<html>
<head>
<title>Ailoveyu Apparel Admin Area</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Bootstrap Core CSS -->
<link href="{{ asset('css/backend/css/bootstrap.css') }}" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="{{ asset('css/backend/css/style.css') }}" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS-->
<link href="{{ asset('css/backend/css/font-awesome.css') }}" rel="stylesheet"> 
<!-- //font-awesome icons CSS-->

 
 <!-- js-->
<script src="{{ asset('js/backend/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('js/backend/js/modernizr.custom.js') }}"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts-->
 
<!-- Metis Menu -->
{{-- <script src="{{ asset('js/backend/js/custom.js') }}"></script> --}}
<link href="{{ asset('css/backend/css/custom.css') }}" rel="stylesheet">
<!--//Metis Menu -->

</head> 
<body>
<div class="main-content">
    <!-- main content start-->
    
			<div class="main-page login-page">
				<h2 class="title1">Ailoveyu International -- Admin</h2>
				<div class="panel-primary widget-shadow">
						
					<div>
              <div class="login-body">
									@include('layouts.message')
            <form action="{{ route('admin') }}" method="post">
              @csrf
							<input type="email" name="username" class="form-control" placeholder="Enter Your Email" required>
							<input type="password" name="password" class="form-control" placeholder="Password" required>
							<input type="submit" name="Sign In" value="Sign In">
							
						</form>
					</div>
					</div>
				</div>				
			</div>
	</div>
	
		
	<!-- Bootstrap Core JavaScript -->
   <script src="{{ asset('js/backend/js/bootstrap.js') }}"> </script>
	<!-- //Bootstrap Core JavaScript -->
   
</body>
</html>