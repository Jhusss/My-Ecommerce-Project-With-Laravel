@extends('layouts.admin')

@section('content')
    <h2 class="title1">Users</h2>
    <div class="forms col-md-8 col-md-offset-2">
        <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
            <div class="form-title d inline">
                <h4>Update User: {{ $user->name }}</h4>
                <a href="{{ route('users.index') }}" class="btn btn-primary pull-right" style="margin-top: -30px">Back to Users</a>
            </div>

            <div class="form-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $user->name }}" placeholder="Enter name...">

                        @if($errors->has('name'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" value="{{ $user->email }}" placeholder="Enter an email..">
                    
                    
                      @if($errors->has('email'))
                          <div class="text-danger">
                              <strong>{{ $errors->first('email') }}</strong>
                          </div>
                        @endif
                    </div>

                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Enter password...">
                    </div>

                      @if($errors->has('password'))
                          <div class="text-danger">
                              <strong>{{ $errors->first('password') }}</strong>
                          </div>
                      @endif

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update User</button>
                    </div>
                               
                </form>
                         
            </div>
        </div>
    </div>

@endsection