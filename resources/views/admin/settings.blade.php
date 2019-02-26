@extends('layouts.admin')

@section('content')
<div class="forms validation">
    <h2 class="title1">Settings</h2>
  
    <div class="row">
      <div class="col-md-6 validation-grids widget-shadow col-md-offset-3" data-example-id="basic-forms"> 
          @include('layouts.message')
        <div class="form-title">
          <h4>Admin Settings :</h4>
        </div>
        
        <div class="form-body">
          <form data-toggle="validator" method="POST" action="{{ url('admin/update-pwd') }}">
            @csrf
            <div class="form-group">
              <input type="password" name="current_pwd" data-toggle="validator" class="form-control" id="current_pwd" placeholder="Password" required>
              <span id="chkPwd"></span>
            </div>
            <div class="form-group">
              <input type="password" name="new_pwd" data-toggle="validator" class="form-control" id="new_pwd" placeholder="New Password">
            </div>
            <div class="form-group">
              <input type="password" name="confirm_pwd" class="form-control" id="inputPasswordConfirm" placeholder="Confirm password">
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    
      <div class="clearfix"> </div>	
    </div>
  </div>
  <script src="{{ asset('js/backend/js/main.js') }}"></script>
@endsection