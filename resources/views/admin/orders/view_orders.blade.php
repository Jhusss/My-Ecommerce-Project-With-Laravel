@extends('layouts.admin')

@section('content')
    <h2 class="title1">Orders</h2>
    
    @include('layouts.message')
    <div class="forms">
        <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
            <div class="form-title d inline">
                <h4>All Orders</h4>
                {{-- <a href="{{ route('products.create') }}" class="btn btn-primary pull-right" style="margin-top: -30px">Add a Product</a> --}}
                
            </div>
            <div class="form-body">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Order id</th>
                            <th>Order Date</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Ordered Products</th>
                            <th>Order Amount</th>
                            <th>Order Status</th> 
                            <th>Payment Method</th> 
                            <th>Actions</th>    
                        </tr>
                    </thead>
                    <tbody>
                    
                      @foreach ($orders as $order)
                          
                        
                        <tr>
                          <td>{{ $order->id }}</td>
                          <td>{{ $order->created_at->diffForHumans() }}</td>
                          <td>{{ $order->name }}</td>
                          <td>{{ $order->user_email }}</td>
                          <td>
                          @foreach ($order->orders as $item)
                          {{ $item->product_name }}
                          {{ $item->product_quantity }}pc(s)
                          @endforeach    
                          </td>                   
                          <td>{{ $order->grand_total }}</td>
                          <td>{{ $order->order_status }}</td>
                          <td>{{ $order->payment_method }}</td>
                          <td><a target="_blank" href="{{ url('admin/view-order/' . $order->id )}}" class="btn btn-primary btn-sm">View Order Details</a> <br><br>
                            <a target="_blank" href="{{ url('admin/view-order-invoice/' . $order->id )}}" class="btn btn-success btn-sm">View Order Invoice</a>
                        
                        </td>
                          
                        </tr>

                      @endforeach
                            
                    </tbody>
                    
                </table>
                {{-- <div class="text-center">{{ $products->links() }}</div> --}}
                
            </div>
        </div>
    </div>
@endsection