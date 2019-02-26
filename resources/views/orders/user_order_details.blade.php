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
                            <th>Product Name</th>
                            <th>Product Size</th>
                            <th>Product Price</th>
                            <th>Product Quantity</th>

                        </tr>
                    </thead>
                    <tbody>

                      @foreach ($orderDetails->orders as $pro)
                        <tr>
                          <td>{{ $pro->product_name }}</td>
                          <td>{{ $pro->product_size }}</td>
                          <td>{{ $pro->product_price }}</td>
                          <td>{{ $pro->product_quantity }}</td>


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