@extends('layouts.frontLayout.frontend')

@section('content')
  
      <section id="checkout">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
               <div class="checkout-area">
                 @include('layouts.message')
                   <div class="row">
                     <div class="col-md-6">
                       <div class="checkout-left">
                         <div class="panel-group" id="accordion">
                           <!-- Billing Details -->
                           <div class="panel panel-default aa-checkout-billaddress">
                             <div class="panel-heading">
                               <h4 class="panel-title">
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                   Billing Address
                                 </a>
                               </h4>
                             </div>
                             <div id="collapseThree" class="panel-collapse collapse">
                               <div class="panel-body">
                                 <div class="row">
                                   <div class="col-md-12">
                                     <div class="aa-checkout-single-bill">
                                       {{ $userDetails->name }}
                                     </div>                             
                                   </div>
                                 </div> 
                                 <div class="row">
                                   <div class="col-md-12">
                                     <div class="aa-checkout-single-bill">
                                        {{ $userDetails->address }}
                                     </div>                             
                                   </div>                            
                                 </div>  
                                 <div class="row">
                                   <div class="col-md-6">
                                     <div class="aa-checkout-single-bill">
                                        {{ $userDetails->city }}
                                     </div>                             
                                   </div>
                                   <div class="col-md-6">
                                    <div class="aa-checkout-single-bill">
                                        {{ $userDetails->country }}
                                    </div>   
                                   </div>
                                 </div> 
                                 <div class="row">
                                   <div class="col-md-6">
                                     <div class="aa-checkout-single-bill">
                                        {{ $userDetails->pincode }}
                                     </div>                             
                                   </div>
                                   <div class="col-md-6">
                                     <div class="aa-checkout-single-bill">
                                        {{ $userDetails->mobile }}
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
                                        {{ $shippingDetails->name }}
                                    </div>                             
                                  </div>
                                </div> 
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="aa-checkout-single-bill">
                                        {{ $shippingDetails->address }}
                                   </div>                               
                                  </div>                            
                                </div>  
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="aa-checkout-single-bill">
                                        {{ $shippingDetails->city }}
                                    </div>                             
                                  </div>
                                  <div class="col-md-6">
                                   <div class="aa-checkout-single-bill">
                                      {{ $shippingDetails->country }}
                                   </div>   
                                  </div>
                                </div> 
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="aa-checkout-single-bill">
                                        {{ $shippingDetails->pincode }}
                                    </div>                             
                                  </div>
                                  <div class="col-md-6">
                                    <div class="aa-checkout-single-bill">
                                        {{ $shippingDetails->mobile }}
                                    </div>
                                  </div>
                                </div>                                    
                              </div>
                             </div>
                           </div>
                         </div>
                          <!-- Material unchecked -->
                        
                       </div>
                     
                     </div>

                     <div class="col-md-6">
                        <div class="checkout-right">
                          <h4>Order Summary</h4>
                          <div class="aa-order-summary-area">
                            <table class="table table-responsive">
                              <thead>
                                <tr>
                                  <th>Image</th>
                                  <th>Product name</th>
                                  <th>Size</th>
                                  <th>Price</th>
                                  <th>Quantity</th>
                                  <th>Total</th>
                                </tr>
                              </thead>
                              <tbody>
                                @php
                                    $total_amount = 0;
                                    $grand_total = 0;
                                    $shipping_charge = 0;
                                @endphp
                                
                                
                                @foreach ($userCart as $cart)
                                                       
                                <tr>
                                  <td><a href="#"><img height="90px" src="{{ asset('images/products/small/'. $cart->image) }}" alt=""></a></td>
                                  <td><a class="aa-cart-title" href="#">{{ $cart->product_name }}</a></td>
                                  <td>{{ $cart->size }}</td>
                                  <td>PHP {{ $cart->price }}</td>
                                  <td>{{ $cart->quantity }}</td>
                                  <td>{{ $cart->price * $cart->quantity }}</td>
                                </tr>    
                                
                                @php
                                    $total_amount = $total_amount + ($cart->price * $cart->quantity);
                                @endphp
                                @endforeach                            
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>Sub Total</th>
                                  <td>PHP {{ $total_amount }}</td>
                                 
                                </tr>
                                <tr>
                                    <th>Shipping fee</th>
                                    <td>{{ $total_amount >= 10000 ? $shipping_charge=0 : $shipping_charge=1000}}</td>
                                </tr>

                                <tr>
                                  <th>Grand Total</th>
                                  <td>{{ $total_amount >= 10000 ? $grand_total = $total_amount : $grand_total = $total_amount+1000}}</td>
                                </tr>
                              </tfoot>
                              
                            </table>
                          </div>
                          <h4>Payment Method</h4>
                          <form action="{{ route('place-order') }}" method="POST" id="paymentForm" name="paymentForm">
                            @csrf
                            <input type="hidden" name="grand_total" value="{{ $grand_total }}">
                            <input type="hidden" name="shipping_charge" value="{{ $shipping_charge }}">
                          <div class="aa-payment-method">                    
                            <label for="cashdelivery"><input type="radio" id="cod" name="payment_method" value="cod"> Cash on Delivery </label>
                            <label for="paypal"><input type="radio" id="paypal" name="payment_method" value="paypal"> Via Paypal </label>
                            {{-- <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" border="0" alt="PayPal Acceptance Mark">     --}}
                            <input type="submit" value="Place Order" class="aa-browse-btn" onclick="return selectPaymentMethod();">                
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