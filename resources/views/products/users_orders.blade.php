@extends('layouts.frontLayout.frontend')
@section('content')
<section id="cart-view">
    
    <div class="container">
      <div class="row">
          <div class="text-center"><h1>My Orders</h1></div>
        <div class="col-md-12">        
          <div class="cart-view-area">
            @include('layouts.message')
            
            <div class="cart-view-table">
                
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Ordered Products</th>
                            <th>Payment</th>
                            <th>Grand_total</th>
                            <th>Purchased</th>

                        </tr>
                    </thead>
                    <tbody>

                      @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                              @foreach ($order->orders as $pro)
                                <a href="{{ url('/orders/'.$order->id) }}">{{ $pro->product_name }}</a><br>
                              @endforeach  
                            
                            </td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ $order->grand_total }}</td>
                            <td>{{ $order->created_at->diffForHumans() }}</td>

                        </tr>
                      @endforeach
                       

      
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection