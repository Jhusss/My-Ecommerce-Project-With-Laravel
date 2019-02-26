@extends('layouts.admin')

@section('content')
    <h2 class="title1">Categories</h2>
    @include('layouts.message')
    <div class="forms col-md-7">
        <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
            <div class="form-title d inline">
                <h4>Category</h4>
            </div>

            <div class="form-body">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Name</label>
                        <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title') }}" placeholder="Enter a category name...">

                        @if($errors->has('title'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('title') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                            <label for="url">Url</label>
                            <input type="text" name="url" class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" value="{{ old('url') }}" placeholder="Enter a url name...">
    
                            @if($errors->has('url'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('url') }}</strong>
                                </div>
                            @endif
                    </div>


                    <div class="checkbox">
                            <label for="enable">
                            <input type="checkbox" name="status" id="status" value="1"> Enable
                            </label>
                    </div>
    

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Create Category</button>
                    </div>
                               
                </form>
                         
            </div>
        </div>
    </div>


    <div class="forms col-md-5">
      <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
          <div class="form-title d inline">
              <h4>All Categories</h4>
          </div>

          <div class="form-body">
              <table class="table table-hover">
                <thead class="thead-light">
                  <tr>
                    <th>Id</th>
                    <th>Category Name</th>
                    <th>Url</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>                   
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach($categories as $category)
                  <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->url }}</td>
                    <td>{{ $category->status }}</td>
                    <td><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success btn-sm">Edit</a></td>
                    <form action="{{ route('categories.destroy', $category->id)}}" method="POST">
                      @csrf
                      @method('DELETE')
                        <td><button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete {{ $category->title }}')">Delete</button></td>
                    </form>
                  </tr>
                  @endforeach
                </tbody>
              </table>
                       
          </div>
      </div>
  </div>
@endsection