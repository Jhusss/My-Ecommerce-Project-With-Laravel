@extends('layouts.frontLayout.frontend')
@section('content')
@php
    use App\Order;
@endphp
<section id="aa-product">
    <div class="container">
      <div class="row">
        <div class="col-md-12" style="height: 400px">
          <div class="row">
            <div class="aa-product-area">
              <div class="aa-product-inner" >

                <div class="text-center" style="margin-top: 150px">
                  <h1>Your Cash on Delivery order has been placed!</h1>
                  <h4>Your order number is <b>{{ Session::get('order_id') }}</b> and the total purchased is <b>PHP{{ Session::get('grand_total') }}</b></h4>
                  <h4>Please make payment by clicking on below Payment button</h4>
                  @php
                    $orderDetails = Order::getOrderDetails(Session::get('order_id'));
                    $orderDetails = json_decode(json_encode($orderDetails));
                    // echo "<pre>"; print_r($orderDetails); die;
                      $nameArr = explode(' ', $orderDetails->name);
                      $getCountryCode= Order::getCountryCode($orderDetails->country);
                 @endphp
                  <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                    <input type="hidden" name="cmd" value="_xclick">
                    {{-- <input type="hidden" name="cmd" value="_s-xclick"> --}}
                    <input type="hidden" name="business" value="justinoneil.fidelis0817-facilitator@gmail.com">
                    <input type="hidden" name="item_name" value="{{ Session::get('order_id') }}">
                    <input type="hidden" name="currency_code" value="PHP">
                    <input type="hidden" name="amount" value="{{ Session::get('grand_total') }}">
                    <input type="hidden" name="first_name" value="{{ $nameArr[0] }}">
                    <input type="hidden" name="last_name" value="{{ $nameArr[1] }}">
                    <input type="hidden" name="address1" value="{{ $orderDetails->address }}">
                    <input type="hidden" name="address2" value="">
                    <input type="hidden" name="city" value="{{ $orderDetails->city }}">
                    <input type="hidden" name="state" value="">
                    <input type="hidden" name="country" value="{{ $getCountryCode->country_code }}">
                    <input type="hidden" name="zip" value="{{ $orderDetails->pincode }}">
                    <input type="hidden" name="email" value="{{ $orderDetails->user_email }}">   
                    <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_paynow_107x26.png" alt="Pay Now">
                    <img alt="" src="https://paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
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

@php
  Session::forget('grand_total'); 
  Session::forget('order_id');  
@endphp
