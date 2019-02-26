@extends('layouts.admin')

@section('content')
    <h2 class="title1">Categories</h2>
    @include('layouts.message')
    <div class="forms col-md-8 col-md-offset-2">
        <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
            <div class="form-title d inline">
                <h4>Update Category : {{ $category->title}} </h4>
            </div>

            <div class="form-body">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Name</label>
                        <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ $category->title }}" placeholder="Enter a category name...">

                        @if($errors->has('title'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('title') }}</strong>
                            </div>
                        @endif
                    </div>


                    <div class="form-group">
                            <label for="url">Url</label>
                            <input type="text" name="url" class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" value="{{ $category->url }}" placeholder="Enter a url name...">
    
                            @if($errors->has('url'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('url') }}</strong>
                                </div>
                            @endif
                    </div>


                    <div class="checkbox">
                            <label for="enabled">
                            <input type="checkbox" name="status" id="status" value="1" {{ $category->status == 1 ? 'checked' : ''}}> Enabled
                            </label>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update Category</button>
                    </div>
                               
                </form>
                         
            </div>
        </div>
    </div>

@endsection