@extends('layouts.admin')

@section('content')
    <h2 class="title1">Order details for #{{ $orderDetails->id}}</h2>
    
    @include('layouts.message')
    <div class="col-sm-6 wthree-crd widgettable">
        <div class="card">
            <div class="card-body">
                <div class="agileinfo-cdr">              
                    <div class="card-header">
                        <h3>Order Details</h3>
                    </div>
                    <hr class="widget-separator">                    
                        <div class="widget-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><b>Order Date</b></td>
                                    <td>{{ $orderDetails->created_at->diffForHumans() }}</td>
                                </tr>
                                <tr>
                                    <td><b>Order Status</b></td>
                                    <td>{{ $orderDetails->order_status }}</td>
                                </tr>
                                <tr>
                                    <td><b>Order Total</b></td>
                                    <td>PHP {{ $orderDetails->grand_total }}</td>
                                </tr>   
                                <tr>
                                    <td><b>Shipping Charge</b></td>
                                    <td>PHP {{ $orderDetails->shipping_charges }}</td>    
                                </tr>  
                                    <td><b>Payment Method</b></td> 
                                    <td>{{ $orderDetails->payment_method }}</td>
                                </tr>
                            </tbody>
                        </table>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 wthree-crd widgettable">
        <div class="card">
            <div class="card-body">
                <div class="agileinfo-cdr">              
                    <div class="card-header">
                        <h3>Customer Details</h3>
                    </div>
                    <hr class="widget-separator">                    
                        <div class="widget-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><b>Customer Name</b></td>
                                    <td>{{ $orderDetails->name }}</td>                             
                                </tr>
                                <tr>
                                    <td><b>Customer Email</b></td>
                                    <td>{{ $orderDetails->user_email }}</td>
                                </tr>
                            </tbody>
                        </table>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 wthree-crd widgettable">
            <div class="card">
                <div class="card-body">
                    <div class="agileinfo-cdr">              
                        <div class="card-header">
                            <h3>Update Order Status</h3>
                        </div>
                        <hr class="widget-separator">                    
                            <div class="widget-body">
                                <form action="{{ route('update-order-status')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $orderDetails->id }}">
                                    <table class="table" >
                                    <tr>
                                        <td>
                                            <select name="order_status" id="order_status" required class="form-control">
                                                <option value="New" {{ $orderDetails->order_status == "New" ? 'selected' : ''}}>New</option>
                                                <option value="Pending" {{ $orderDetails->order_status == "Pending" ? 'selected' : ''}}>Pending</option>
                                                <option value="Cancelled" {{ $orderDetails->order_status == "Cancelled" ? 'selected' : ''}}>Cancelled</option>
                                                <option value="In Process" {{ $orderDetails->order_status == "In Process" ? 'selected' : ''}}>In Process</option>
                                                <option value="Shipped" {{ $orderDetails->order_status == "New" ? 'Shipped' : ''}}>Shipped</option>
                                                <option value="Delivered" {{ $orderDetails->order_status == "Delivered" ? 'selected' : ''}}>Delivered</option>
                                            </select>
                                        </td>
                                        
                                        <td><input type="submit" value="Update Status" class="btn btn-primary"></td>
                                    </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 


                <div class="col-sm-6 wthree-crd widgettable">
                    <div class="card">
                        <div class="card-body">
                        <div class="agileinfo-cdr">              
                            <div class="card-header">
                                <h3>Billing Details</h3>
                            </div>
                            <hr class="widget-separator">                    
                                <div class="widget-body">
                                {{ $userDetails->name }}<br>
                                {{ $userDetails->address }}<br>
                                {{ $userDetails->city }}<br>
                                {{ $userDetails->country }}<br>
                                {{ $userDetails->pincode }}<br>
                                {{ $userDetails->mobile }}
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 wthree-crd widgettable">
                        <div class="card">
                            <div class="card-body">
                            <div class="agileinfo-cdr">              
                                <div class="card-header">
                                    <h3>Shipping Details</h3>
                                </div>
                                <hr class="widget-separator">                    
                                    <div class="widget-body">
                                    {{ $orderDetails->name }}<br>
                                    {{ $orderDetails->address }}<br>
                                    {{ $orderDetails->city }}<br>
                                    {{ $orderDetails->country }}<br>
                                    {{ $orderDetails->pincode }}<br>
                                    {{ $orderDetails->mobile }}
                                </div>
                            </div>
                            </div>
                        </div>
                </div>


    <div class="col-sm-12 wthree-crd widgettable">
            <div class="card">
                <div class="card-body">
                <div class="agileinfo-cdr">              
                    <div class="card-header">
                        <h3>Product Details</h3>
                    </div>
                    <hr class="widget-separator">                    
                        <div class="widget-body">
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
        <div class="clearfix"> </div>




    
@endsection