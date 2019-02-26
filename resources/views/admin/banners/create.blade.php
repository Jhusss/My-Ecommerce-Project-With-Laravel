@extends('layouts.admin')

@section('content')
    <h2 class="title1">Banners</h2>
    
    <div class="forms">
        <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
            <div class="form-title d inline">
                <h4>Create Banner</h4>
                <a href="{{ route('banners.index') }}" class="btn btn-primary pull-right" style="margin-top: -30px">Back to Banners</a>
            </div>

            <div class="form-body">
                <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Enter a banner name...">

                        @if($errors->has('title'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('title') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
                        <label for="image">Banner Image</label>
                        <input type="file" name="image" id="image" class="form-control">

                        @if($errors->has('image'))
                        <div class="text-danger">
                            <strong>{{ $errors->first('image') }}</strong>
                        </div>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
                        <label for="link">Link</label>
                        <input type="text" name="link" id="link" class="form-control" placeholder="Enter link">

                        @if($errors->has('link'))
                        <div class="text-danger">
                            <strong>{{ $errors->first('link') }}</strong>
                        </div>
                        @endif
                    </div>

                    <div class="checkbox">
                        <label for="enable">
                            <input type="checkbox" name="status" id="status" value="1"> Enable
                        </label>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Create Banner</button>
                    </div>
                    
                
                
                </form>
                
                
            </div>
        </div>
    </div>
@endsection