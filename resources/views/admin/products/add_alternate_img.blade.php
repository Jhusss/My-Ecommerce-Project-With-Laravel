@extends('layouts.admin')


@section('content')
<h2 class="title1">Products</h2>

@include('layouts.message')
<div class="forms">
    <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
        <div class="form-title d inline">
            <h4>Product Alternate Images</h4>
            <a href="{{ route('products.index') }}" class="btn btn-primary pull-right" style="margin-top: -30px">Back to Products</a>
        </div>

        <div class="form-body">
            <form action="{{ route('products.add-alternate-img', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                    <label for="title">Product Name: </label>
                    <label for="" class="form-control"><strong>{{ $product->title }}</strong></label>
                </div>



                <div class="form-group {{ $errors->has('photo') ? 'has-error' : ''}}">
                    <label for="image">Image</label>
                    <input type="file" name="photo[]" id="image" multiple="multiple" class="form-control">

                    @if($errors->has('photo'))
                    <div class="text-danger">
                        <strong>{{ $errors->first('photo') }}</strong>
                    </div>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Add Images</button>
                </div>
                
            
            
            </form>
            
            
        </div>
    </div>
</div>

<div class="forms">
  <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
      <div class="form-title d inline">
          <h4>Images</h4>
      </div>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Image id</th>
              <th>Product id</th>
              <th>Image</th>
              <th>Actions</th>
            </tr>
            <tbody>
              @foreach ($productsImages as $image)
                <tr>
                  <td>{{ $image->id }}</td>
                  <td>{{ $image->product_id }}</td>
                  <td><img height="100px" width="100px" src="{{ asset('images/products/small/'. $image->image) }}" alt=""></td>
                  <form action="{{ route('products.destroy-alternate-images', $image->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                      <td><button onclick="return confirm('Are you sure you want to delete image id: {{ $image->id }}?')" class="btn btn-danger">Delete</button></td>
                  </form>
                  
                </tr>
                  
              @endforeach
            </tbody>
          </thead>
        

        </table>
        
        
          
      </div>
  </div>
</div>
@endsection