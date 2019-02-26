@extends('layouts.frontLayout.frontend')

@section('content')



  <!-- Cart view section -->
 <section id="aa-myaccount">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
       <div class="aa-myaccount-area">         
           <div class="row">
              @include('layouts.message')
             <div class="col-md-6">
               <div class="aa-myaccount-login">
               <h4>Update Account</h4>
               <form method="POST" id="accountForm" action="{{ route('account-user') }}" class="aa-login-form">
                  @csrf 
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}" >
                   <input value="{{ $userDetails->name }}" type="text" name='name' placeholder="Name">

                   @if($errors->has('name'))
                      <div class="text-danger">
                          <strong>{{ $errors->first('name') }}</strong>
                      </div>
                  @endif
                  </div>

                  <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                   <input value="{{ $userDetails->address }} "type="text" name='address' placeholder="Address">

                   @if($errors->has('address'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('address') }}</strong>
                            </div>
                    @endif  
                  </div>

                  <div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
                      <input value="{{ $userDetails->city }}" type="text" name='city' placeholder="City">

                  @if($errors->has('city'))
                        <div class="text-danger">
                            <strong>{{ $errors->first('city') }}</strong>
                        </div>
                  @endif
                  </div>

                  <div class="form-group {{ $errors->has('country') ? 'has-error' : ''}}">
                   <select name="country" id="country" class="form-control">
                     <option value="">Select Country</option>
                     @foreach ($countries as $country)
                      <option value="{{$country->country_name}}" {{ $userDetails->country == $country->country_name ? 'selected' : '' }}> {{ $country->country_name }}</option>
                     @endforeach
                   </select>
                  </div>


                  <div class="form-group {{ $errors->has('pincode') ? 'has-error' : ''}}">
                      <input value="{{$userDetails->pincode }}" type="text" name='pincode' placeholder="Pincode">
                      @if($errors->has('pincode'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('pincode') }}</strong>
                            </div>
                      @endif
                  </div>

                  <div class="form-group {{ $errors->has('mobile') ? 'has-error' : ''}}">
                      <input value="{{$userDetails->mobile }}" type="text" name='mobile' placeholder="Mobile">
                      @if($errors->has('mobile'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('mobile') }}</strong>
                            </div>
                      @endif
                  </div>
                  
                  <div class="form-group">
                    <button type="submit" class="aa-browse-btn">Update</button>   
                  </div> 
                                    
                 </form>
            
               </div>
             </div>
             <div class="col-md-6">
               <div class="aa-myaccount-register">                 
                <h4>Update Password</h4>
                  <form action="{{ route('update-user-pwd') }}" id="passwordForm" method="POST" class="aa-login-form">
                  @csrf
                    <div class="form-group">
                      <input type="password" name="current_pwd" id="current_pwd" placeholder="Current Password">
                      <span id="chkPwd"></span>
                    </div>

                    <div class="form-group">
                      <input type="password" name="new_pwd" id="new_pwd" placeholder="New Password">
                    </div>
                    
                    <div class="form-group">
                      <input type="password" name="confirm_pwd" id="confrim_pwd" placeholder="Confirm Password">
                    </div>

                    <div class="form-group">
                      <button type="submit" class="aa-browse-btn">Update</button>
                    </div>
                  </form>
                
               </div>
             </div>
           </div>          
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

