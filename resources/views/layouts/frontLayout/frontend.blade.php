<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <meta name="csrf-token" content="{{ csrf_token() }}">   
    <title>Ailoveyu International</title>
    
    <!-- Font awesome -->
    <link href="{{ asset('css/frontendcss/font-awesome.css') }}" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="{{ asset('css/frontendcss/bootstrap.css') }}" rel="stylesheet">   
    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="{{ asset('css/frontendcss/jquery.smartmenus.bootstrap.css') }}" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontendcss/jquery.simpleLens.css') }}">    
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontendcss/slick.css') }}">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontendcss/nouislider.css') }}">
    <!-- Theme color -->
    <link id="switcher" href="{{ asset('css/frontendcss/theme-color/default-theme.css') }}" rel="stylesheet">
    <!-- <link id="switcher" href="css/theme-color/bridge-theme.css" rel="stylesheet"> -->
    <!-- Top Slider CSS -->
    <link href="{{ asset('css/frontendcss/sequence-theme.modern-slide-in.css') }}" rel="stylesheet" media="all">  
    <!-- PassStrength -->
    <link href="{{ asset('css/frontendcss/passtrength.css') }}" media='all' rel='stylesheet' type='text/css'/>
    <!-- Main style sheet -->
    <link href="{{ asset('css/frontendcss/style.css') }}" rel="stylesheet">    
    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    
  

  </head>
  <body> 
   <!-- wpf loader Two -->
    <div id="wpf-loader-two">          
      <div class="wpf-loader-two-inner">
        <span>Loading</span>
      </div>
    </div> 
    <!-- / wpf loader Two -->       
  <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->


  @include('layouts.frontLayout.frontheader')
    
  @yield('content')

  @include('layouts.frontLayout.frontfooter')

  <!-- Login Modal -->  
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Login or Register</h4>
          <form id="formLogin" class="aa-login-form" action="{{ route('login-user') }}" method="POST">
            @csrf
            <div class="form-group">
              <input name="email" type="text" placeholder="Email">

            </div>
            <div class="form-group">
            <input name="password" type="password" placeholder="Password">
            </div>

            <div class="form-group">
            <button class="aa-browse-btn" type="submit">Login</button>
            </div>

            {{-- <label for="rememberme" class="rememberme"><input type="checkbox" id="rememberme"> Remember me </label>
            <p class="aa-lost-password"><a href="#">Lost your password?</a></p> --}}
            <div class="aa-register-now">
              Don't have an account?<a href="{{ route('login-register-user')}}">Register now!</a>
            </div>
          </form>
        </div>                        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>    

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{ asset('js/frontendjs/bootstrap.js') }}"></script>  
  <!-- SmartMenus jQuery plugin -->
  <script type="text/javascript" src="{{ asset('js/frontendjs/jquery.smartmenus.js') }}"></script>
  <!-- SmartMenus jQuery Bootstrap Addon -->
  <script type="text/javascript" src="{{ asset('js/frontendjs/jquery.smartmenus.bootstrap.js') }}"></script>  
  <!-- To Slider JS -->

  <!-- Product view slider -->
  <script type="text/javascript" src="{{ asset('js/frontendjs/jquery.simpleGallery.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/frontendjs/jquery.simpleLens.js') }}"></script>
  <!-- slick slider -->
  <script type="text/javascript" src="{{ asset('js/frontendjs/slick.js') }}"></script>
  <!-- Price picker slider -->
  <script type="text/javascript" src="{{ asset('js/frontendjs/nouislider.js') }}"></script>
  
  <!-- PassStrength js -->
  <script src="{{ asset('js/frontendjs/passtrength.js') }}"></script> 

  <!-- Custom js -->
  <script src="{{ asset('js/frontendjs/custom.js') }}"></script> 
  <script src="{{ asset('js/frontendjs/main.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

  </body>
</html>