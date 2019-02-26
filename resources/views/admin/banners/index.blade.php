@extends('layouts.admin')

@section('content')
    <h2 class="title1">Banners</h2>
    @include('layouts.message')

    <div class="forms">
      <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
          <div class="form-title d inline">
              <h4>All Banners</h4>
              <a href="{{ route('banners.create') }}" class="btn btn-primary pull-right" style="margin-top: -30px">Add Banner</a>
          </div>

          <div class="form-body">
              <table class="table table-hover">
                <thead class="thead-light">
                  <tr>
                    <th>Id</th>
                    <th>Banner Title</th>
                    <th>Image</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $banner)
                        <tr>
                            <td>{{ $banner->id }}</td>
                            <td>{{ $banner->title }}</td>
                            <td><img width="140px" height="80px" src="{{ asset('images/banners/' . $banner->image) }}" alt=""></td>
                            <td><a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-success">Edit</a></td>
                            <td>
                            <form action="{{ route('banners.destroy', $banner->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete {{ $banner->title }}?')">
                            </form>    
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
                       
          </div>
      </div>
  </div>
@endsection