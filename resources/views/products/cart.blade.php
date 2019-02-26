@extends('layouts.frontLayout.frontend')

@section('content')
<section id="aa-catg-head-banner">
  <img src="{{ asset('images/frontend_images/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
  <div class="aa-catg-head-banner-area">
    <div class="container">
     <div class="aa-catg-head-banner-content">
       <h2>Cart Page</h2>
       <ol class="breadcrumb">
         <li><a href="{{ route('front') }}">Home</a></li>                   
         <li class="active">Cart</li>
       </ol>
     </div>
    </div>
  </div>
 </section>

 
 <section id="cart-view">
    
  <div class="container">
    <div class="row">
      <div class="col-md-12">        
        <div class="cart-view-area">
            @include('layouts.message')
          <div class="cart-view-table">
            <form action="">
              <div class="table-responsive">
                 <table class="table">
                   <thead>
                     <tr>
                       <th>Remove</th>
                       <th>Image</th>
                       <th>Product</th>
                       <th>Size</th>
                       <th>Price</th>
                       {{-- <td>Description</td> --}}
                       <th>Quantity</th>
                       <th>Total</th>
                     </tr>
                   </thead>
                   <tbody>
                     @php
                         $total_amount = 0;
                     @endphp
                     @foreach ($userCart as $cart)
                         
                    
                     <tr>
                       <td><a class="remove" href="{{ route('deleteCartProduct',$cart->id) }}"><fa class="fa fa-close"></fa></a></td>
                       <td><a href="{{ route('products.details', $cart->id )}}"><img src="{{ asset('images/products/small/'. $cart->image) }}"></a></td>
                       <td><a class="aa-cart-title" href="#">{{ $cart->product_name }}</a></td>
                       <td>{{ $cart->size }}</td>
                       <td>PHP {{ $cart->price }}</td>
                       {{-- <td>{{ $cart->description }}</td> --}}

                       <td>
                        <a href="{{ route('update-cart-quantity',[ $cart->id , 1]) }}"><fa class="fa fa-plus"></span></a> 
                        <input class="aa-cart-quantity text-center" type="text" value="{{ $cart->quantity }}">
                        @if($cart->quantity > 1)
                        <a href="{{ route('update-cart-quantity',[ $cart->id , -1]) }}"><fa class="fa fa-minus"></span></a> 
                        @endif
                        </td>
                       <td>PHP {{ $cart->price * $cart->quantity }}</td>
                     </tr>
                     @php
                         $total_amount = $total_amount + ($cart->price * $cart->quantity);
                     @endphp
                     @endforeach
                     <tr>
                       <td colspan="8" class="aa-cart-view-bottom">
                      
                         {{-- <input href="#" class="aa-cart-view-btn" type="submit" value="Update Cart"> --}}
                       </td>
                     </tr>
                     </tbody>
                 </table>
               </div>
            </form>
            <!-- Cart Total view -->
            <div class="cart-view-total">
              <h4>Cart Totals</h4>
              <table class="aa-totals-table">
                <tbody>
                  <tr>
                    <th>Total</th>
                    <td>PHP @php echo $total_amount @endphp</td>
                  </tr>
                </tbody>
              </table>
              
              <a href="{{ route('checkout') }}" class="aa-cart-view-btn">Proced to Checkout</a>

             
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection