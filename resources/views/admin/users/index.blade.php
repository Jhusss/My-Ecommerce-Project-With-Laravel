@extends('layouts.admin')

@section('content')
    <h2 class="title1">Users</h2>
    @include('layouts.message')

    <div class="forms">
      <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
          <div class="form-title d inline">
              <h4>All Users</h4>
              <a href="{{ route('users.create') }}" class="btn btn-primary pull-right" style="margin-top: -30px">Add User</a>
          </div>

          

          <div class="form-body">
              <table class="table table-hover">
                <thead class="thead-light">
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>Pincode</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Created at</th>
                    {{-- <th>Edit</th>
                    <th>Delete</th> --}}
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->city }}</td>
                            <td>{{ $user->country }}</td>
                            <td>{{ $user->pincode }}</td>
                            <td>{{ $user->mobile }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            {{-- <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-success">Edit</a></td>
                            <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete {{ $user->name }}?')">
                            </form>    
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
              </table>
                       
          </div>
      </div>
  </div>
@endsection