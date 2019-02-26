@extends('layouts.admin')

@section('content')
    <h2 class="title1">CMS Page</h2>
    
    @include('layouts.message')
    <div class="forms">
        <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
            <div class="form-title d inline">
                <h4>All CMS Page</h4>
                <a href="{{ route('add-cms-page') }}" class="btn btn-primary pull-right" style="margin-top: -30px">Add a CMS Page</a>
                
            </div>
            <div class="form-body">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Status</th>
                            <th>Created on</th>
                            <th>Actions</th>                      
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach ($cmsPages as $cms)
                        <tr>
                            <td>{{ $cms->id }}</td>
                            <td>{{ $cms->title }}</td>
                            <td>{{ $cms->url }}</td>
                            <td>{{ $cms->status == 1 ? 'Enabled' : 'Disabled' }}</td>
                            <td>{{ $cms->created_at->diffForHumans() }}</td>
                            {{-- <td><a href="{{ route('products.edit', $product->id) }}" class="btn btn-success">Edit</a></td>
                            
                            <form action="{{ route('products.destroy' , $product->id )}}" method="post">
                                @method('DELETE')
                                @csrf
                            <td><button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button></td>
                            </form> --}}
                            
                        </tr>
                        @endforeach
                            
                    </tbody>
                    
                </table>
                {{-- <div class="text-center">{{ $cms->links() }}</div> --}}
                
            </div>
        </div>
    </div>
@endsection