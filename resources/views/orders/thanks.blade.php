@extends('layouts.frontLayout.frontend')
@section('content')
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
                  <h4>Redirect to <a href="{{ route('front') }}">homepage</a></h4>
                
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
