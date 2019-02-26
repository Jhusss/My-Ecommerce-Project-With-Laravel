@extends('layouts.frontLayout.frontend')

@section('content')
  <!-- Cart view section -->
 <section id="checkout">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
       <div class="checkout-area">
         @include('layouts.message')
         <form action="{{ route('checkout') }}" method="post">
          @csrf
           <div class="row">
             <div class="col-md-12">
               <div class="checkout-left">
                 <div class="panel-group" id="accordion">
                   <!-- Coupon section -->
                   {{-- <div class="panel panel-default aa-checkout-coupon">
                     <div class="panel-heading">
                       <h4 class="panel-title">
                         <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                           Have a Coupon?
                         </a>
                       </h4>
                     </div>
                     <div id="collapseOne" class="panel-collapse collapse in">
                       <div class="panel-body">
                         <input type="text" placeholder="Coupon Code" class="aa-coupon-code">
                         <input type="submit" value="Apply Coupon" class="aa-browse-btn">
                       </div>
                     </div>
                   </div> --}}
                   <!-- Login section -->
                   {{-- <div class="panel panel-default aa-checkout-login">
                     <div class="panel-heading">
                       <h4 class="panel-title">
                         <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                           Client Login 
                         </a>
                       </h4>
                     </div>
                     <div id="collapseTwo" class="panel-collapse collapse">
                       <div class="panel-body">
                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat voluptatibus modi pariatur qui reprehenderit asperiores fugiat deleniti praesentium enim incidunt.</p>
                         <input type="text" placeholder="Username or email">
                         <input type="password" placeholder="Password">
                         <button type="submit" class="aa-browse-btn">Login</button>
                         <label for="rememberme"><input type="checkbox" id="rememberme"> Remember me </label>
                         <p class="aa-lost-password"><a href="#">Lost your password?</a></p>
                       </div>
                     </div>
                   </div> --}}
                   <!-- Billing Details -->
                   <div class="panel panel-default aa-checkout-billaddress">
                     <div class="panel-heading">
                       <h4 class="panel-title">
                         <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                           Billing Details
                         </a>
                       </h4>
                     </div>
                     <div id="collapseThree" class="panel-collapse collapse">
                       <div class="panel-body">
                         <div class="row">
                           <div class="col-md-12">
                             <div class="aa-checkout-single-bill">
                               <input type="text" name="billing_name" id="billing_name" value="{{ $userDetails->name }}" placeholder="Billing Name">
                             </div>                             
                           </div>
                         </div> 
                         <div class="row">
                           <div class="col-md-12">
                             <div class="aa-checkout-single-bill">
                                <input type="text" name="billing_address" id="billing_address" value="{{ $userDetails->address }}" placeholder="Billing Address">
                             </div>                             
                           </div>                            
                         </div>  
                         <div class="row">
                           <div class="col-md-6">
                             <div class="aa-checkout-single-bill">
                               <input type="text" name="billing_city" id="billing_city" value="{{ $userDetails->city }}" placeholder="Billing City">
                             </div>                             
                           </div>
                           <div class="col-md-6">
                            <div class="aa-checkout-single-bill">
                              <select name="billing_country" id="billing_country">
                                <option value="">Select Your Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->country_name }}" {{ $userDetails->country == $country->country_name ? 'selected' : '' }}>{{ $country->country_name }}</option>
                                @endforeach
                              </select>
                            </div>   
                           </div>
                         </div> 
                         <div class="row">
                           <div class="col-md-6">
                             <div class="aa-checkout-single-bill">
                               <input type="text" name="billing_pincode" id="billing_pincode" value="{{ $userDetails->pincode }}" placeholder="Billing Pincode">
                             </div>                             
                           </div>
                           <div class="col-md-6">
                             <div class="aa-checkout-single-bill">
                               <input type="text" name="billing_mobile" id="billing_mobile" value="{{ $userDetails->mobile }}" placeholder="Billing Mobile">
                             </div>
                           </div>
                         </div>                                    
                       </div>
                     </div>
                   </div>
                   <!-- Shipping Address -->
                   <div class="panel panel-default aa-checkout-billaddress">
                     <div class="panel-heading">
                       <h4 class="panel-title">
                         <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                           Shippping Address
                         </a>
                       </h4>
                     </div>
                     <div id="collapseFour" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="aa-checkout-single-bill">
                              <input name="shipping_name" id="shipping_name" type="text" @if (!empty($shippingDetails->name)) value="{{ $shippingDetails->name }}" @endif placeholder="Shipping Name">
                            </div>                             
                          </div>
                        </div> 
                        <div class="row">
                          <div class="col-md-12">
                            <div class="aa-checkout-single-bill">
                              <input type="text" name="shipping_address" id="shipping_address" @if (!empty($shippingDetails->address)) value="{{ $shippingDetails->address }}" @endif placeholder="Billing Address">
                           </div>                               
                          </div>                            
                        </div>  
                        <div class="row">
                          <div class="col-md-6">
                            <div class="aa-checkout-single-bill">
                              <input name="shipping_city" id="shipping_city" type="text" @if (!empty($shippingDetails->city)) value="{{ $shippingDetails->city }}" @endif placeholder="Shipping City">
                            </div>                             
                          </div>
                          <div class="col-md-6">
                           <div class="aa-checkout-single-bill">
                            <select name="shipping_country" id="shipping_country">
                              <option value="">Select Your Country</option>
                              @foreach ($countries as $country)
                                  <option value="{{ $country->country_name }}" @if (!empty($shippingDetails->name)) {{ $shippingDetails->country == $country->country_name ? 'selected' : ''}} @endif>{{ $country->country_name }}</option>
                              @endforeach
                            </select>
                           </div>   
                          </div>
                        </div> 
                        <div class="row">
                          <div class="col-md-6">
                            <div class="aa-checkout-single-bill">
                              <input name="shipping_pincode" id="shipping_pincode" @if (!empty($shippingDetails->name)) value="{{ $shippingDetails->pincode }}" @endif type="text" placeholder="Shipping Pincode">
                            </div>                             
                          </div>
                          <div class="col-md-6">
                            <div class="aa-checkout-single-bill">
                              <input name="shipping_mobile" id="shipping_mobile" @if (!empty($shippingDetails->name)) value="{{ $shippingDetails->mobile }}" @endif type="text" placeholder="Shipping Mobile">
                            </div>
                          </div>
                        </div>                                    
                      </div>
                     </div>
                   </div>
                 </div>
                  <!-- Material unchecked -->
                <div class="form-check">
                  <input type="checkbox" value={{ $userDetails->name }} class="form-check-input" id="billtoship">
                  <label class="form-check-label" for="materialUnchecked" id="billtoship">Shipping address same as Billing Address</label>
                </div>
               </div>
               <div class="form-group">
                  <input type="submit" value="Place Order" class="aa-browse-btn">     
               </div>
             </div>
             
           </div>
         </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / Cart view section -->
@endsection