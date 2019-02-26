@extends('layouts.admin')

@section('content')
    <h2 class="title1">Products</h2>
    
    <div class="forms">
        <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
            <div class="form-title d inline">
              <h4>Update Product : {{ $product->title }}</h4>
              <a href="{{ route('products.index') }}" class="btn btn-primary pull-right" style="margin-top: -30px">Back to Products</a>
            </div>
            <div class="form-body col-sm-4">
              <img src="{{ asset('/images/products/large/'. $product->product_image) }}" class="img-responsive" alt="">
            </div>

            <div class="form-body col-sm-8">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Name</label>
                        <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ $product->title }}" placeholder="Enter a product name...">

                        @if($errors->has('title'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('title') }}</strong>
                            </div>
                        @endif
                    </div>


                    <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" min="0"  step="0.1" class="form-control  {{ $errors->has('price') ? 'is-invalid' : '' }}" value="{{ $product->price }}" placeholder="Enter price ...">
                            
                            @if($errors->has('price'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('price') }}</strong>
                            </div>
                            @endif
                    </div>

                    <div class="form-group">
                        <label for="category">Brand</label>
                        <select name="category_id" id="category" class="form-control">
                            @foreach($categories as $category)

                                <option value="{{ $category->id }}"
                                    @if ($product->category_id == $category->id)
                                        selected
                                    @endif
                                    >
                                    {{$category->title}}</option>
    
                            @endforeach
                        </select>
                        
                    </div>



                    <div class="form-group">
                        <label for="desc">Description</label>
                        <textarea name="description" id="" rows="5" class="form-control  {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ $product->description }}</textarea>

                        @if($errors->has('description'))
                        <div class="text-danger">
                            <strong>{{ $errors->first('description') }}</strong>
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="hidden" name="current_image" value="{{ $product->product_image }}">
                        <input type="file" name="photo" class="form-control {{ $errors->has('photo') ? 'is-invalid' : ''}}">

                        @if($errors->has('photo'))
                        <div class="text-danger">
                            <strong>{{ $errors->first('photo') }}</strong>
                        </div>
                        @endif
                    </div>

                    <div class="checkbox">
                            <label for="enable">
                            <input type="checkbox" name="status" id="status" value="1" {{ $product->status == 1 ? 'checked' : ''}}> Enable
                            </label>
                    </div>

                    <div class="checkbox">
                        <label for="feature_item">
                        <input type="checkbox" name="feature_item" id="feature_item" value="1" {{ $product->feature_item == 1 ? 'checked' : ''}}> Feature Item
                        </label>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update Product</button>
                    </div>
                    
                
                
                </form>
                
                
            </div>
        </div>
    </div>
@endsection