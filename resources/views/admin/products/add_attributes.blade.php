@extends('layouts.admin')


@section('content')
<h2 class="title1">Products</h2>

@include('layouts.message')
<div class="forms">
    <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
        <div class="form-title d inline">
            <h4>Product Attribute</h4>
            <a href="{{ route('products.index') }}" class="btn btn-primary pull-right" style="margin-top: -30px">Back to Products</a>
        </div>

        <div class="form-body">
            <input type="hidden" id="sizes" value="{{ $sizes }}">
            <form action="{{ route('products.add-attributes', $product->id) }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                    <label for="title">Product Name: </label>
                    <label for="" class="form-control"><strong>{{ $product->title }}</strong></label>
                </div>



                <div class="form-group">
                    <label for="category">Attributes</label>
                    <div class="field_wrapper">
                      <div>
                          <input type="text" required name="sku[]" id="sku" placeholder="SKU" width="120px"/>
                          {{-- <input type="text" required name="size[]" id="size" placeholder="Size" width="120px"/> --}}
                          <select name="size[]" id="size" style="width:200px;">
                            @foreach ($sizes as $size)
                             <option value="{{ $size->name }}">{{ $size->name }}</option> 
                            @endforeach    
                          </select>
                         
                          <input type="number" required name="price[]" min="1" step=".01" id="sku" placeholder="Price" width="120px"/>
                          <input type="text" required name="stock[]" id="sku" placeholder="Stock" width="120px"/>
                          <a href="javascript:void(0);" class="add_button btn btn-primary btn-sm" title="Add field">Add Field</a>
                      </div>
                  </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Add Attributes</button>
                </div>
                
            
            
            </form>
            
            
        </div>
    </div>
</div>

<div class="forms">
  <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
      <div class="form-title d inline">
          <h4>Attributes</h4>        
      </div>
            <form action="{{ route('products.edit-attributes', $product->id) }}" method="POST">
            @csrf
            <table class="table table-hover">
            <thead>
                <tr>
                    <th>Attribute Id</th>
                    <th>SKU</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
                <tbody>
                @foreach ($product->attributes as $attribute)
                    
                <tr>
                    <td><input type="hidden" name="idAttr[]" value="{{ $attribute->id }}">{{ $attribute->id }}</td>
                    <td>{{ $attribute->sku }}</td>
                    <td>{{ $attribute->size }}</td>
                    <td><input type="number" name="price[]" min="1" step=".01" value="{{ $attribute->price }}"></td>
                    <td><input type="text" name="stock[]" value="{{ $attribute->stock }}"></td>    
                    <td><button type="submit" class="btn btn-primary btn-sm">Update</button></td>
                    </form>
                    <form action="{{ route('products.destroy-attribute', $attribute->id )}}" method="post">
                        @csrf
                        @method('DELETE')
                        <td><button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete these attributes?')">Delete</button></td>
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