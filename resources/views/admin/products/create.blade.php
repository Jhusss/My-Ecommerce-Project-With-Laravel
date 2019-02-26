@extends('layouts.admin')

@section('content')
    <h2 class="title1">Products</h2>
    
    <div class="forms">
        <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
            <div class="form-title d inline">
                <h4>Create Product</h4>
                <a href="{{ route('products.index') }}" class="btn btn-primary pull-right" style="margin-top: -30px">Back to Products</a>
            </div>

            <div class="form-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                        <label for="title">Name</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Enter a product name...">

                        @if($errors->has('title'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('title') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                            <label for="price">Price</label>
                            <input type="number" name="price" min="1"  step=".01" class="form-control" value="{{ old('price') }}" placeholder="Enter price ...">
                            
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
    
                                <option value="{{ $category->id}}">{{$category->title}}</option>
    
                            @endforeach
                        </select>
                        
                    </div>

                    <div class="form-group  {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="desc">Description</label>
                            <textarea name="description" id="" rows="5" class="form-control">{{ old('description') }}</textarea>

                            @if($errors->has('description'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('description') }}</strong>
                            </div>
                            @endif
                    </div>

                    <div class="form-group {{ $errors->has('photo') ? 'has-error' : ''}}">
                        <label for="image">Image</label>
                        <input type="file" name="photo" class="form-control">

                        @if($errors->has('photo'))
                        <div class="text-danger">
                            <strong>{{ $errors->first('photo') }}</strong>
                        </div>
                        @endif
                    </div>

                    <div class="checkbox">
                        <label for="enable">
                            <input type="checkbox" name="status" id="status" value="1"> Enable
                        </label>
                    </div>

                    <div class="checkbox">
                        <label for="feature">
                            <input type="checkbox" name="feature_item" id="feature_item" value="1"> Feature Item
                        </label>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Create Product</button>
                    </div>
                    
                
                
                </form>
                
                
            </div>
        </div>
    </div>
@endsection