@extends('layouts.admin')

@section('content')
    <h2 class="title1">Products</h2>
    
    @include('layouts.message')
    <div class="forms">
        <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
            <div class="form-title d inline">
                <h4>All Products</h4>
                <a href="{{ route('products.create') }}" class="btn btn-primary pull-right" style="margin-top: -30px">Add a Product</a>
                
            </div>
            <div class="form-body">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Brand</th>
                            <th>Status</th>
                            <th>Featured</th>
                            {{-- <th>Quantity</th>  --}}
                            <th>Attributes</th> 
                            <th>Alternate Images</th> 
                            <th>Edit</th>
                            <th>Delete</th>          
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->title }}</td>
                            <td><img src="{{ asset('/images/products/large/'. $product->product_image) }}" alt="" height="80" width="80"></td>
                            <td>{{ str_limit($product->description, 200) }}</td>
                            <td>{{ $product->category->title }}</td>
                            <td>{{ $product->status == 1 ? 'Enabled' : 'Disabled' }}</td>
                            <td>{{ $product->feature_item == 1 ? 'Featured' : 'Disabled' }}</td>
                            {{-- <td>{{ $product->size->name }}</td> --}}
                            {{-- <td>{{ number_format($product->price,2) }}</td> --}}
                            {{-- <td>{{ $product->quantity }}</td> --}}
                            <td><a href="{{ route('products.add-attributes', $product->id)}}" class="btn btn-primary">Add Attributes</a></td>
                            <td><a href="{{ route('products.add-alternate-img', $product->id)}}" class="btn btn-info">Add Images</a></td>
                            <td><a href="{{ route('products.edit', $product->id) }}" class="btn btn-success">Edit</a></td>
                            
                            <form action="{{ route('products.destroy' , $product->id )}}" method="post">
                                @method('DELETE')
                                @csrf
                            <td><button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button></td>
                            </form>
                            
                        </tr>
                        @endforeach
                            
                    </tbody>
                    
                </table>
                <div class="text-center">{{ $products->links() }}</div>
                
            </div>
        </div>
    </div>
@endsection