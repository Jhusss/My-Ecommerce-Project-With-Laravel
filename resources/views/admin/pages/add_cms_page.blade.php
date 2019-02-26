@extends('layouts.admin')

@section('content')
    <h2 class="title1">CMS PAGES</h2>
    @include('layouts.message')
    <div class="forms">
        <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
            <div class="form-title d inline">
                <h4>Create CMS</h4>
                <a href="{{ route('view-cms-pages') }}" class="btn btn-primary pull-right" style="margin-top: -30px">Back to CMS</a>
            </div>

            <div class="form-body">
                <form action="{{ route('add-cms-page') }}" name="add_cms_page" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Enter a product name...">

                        @if($errors->has('title'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('title') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('url') ? 'has-error' : ''}}">
                     <label for="title">CMS Url</label>
                     <input type="text" name="url" class="form-control" value="{{ old('url') }}" placeholder="Enter a CMS URL...">

                     @if($errors->has('url'))
                         <div class="text-danger">
                             <strong>{{ $errors->first('url') }}</strong>
                         </div>
                     @endif
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

                    <div class="checkbox">
                        <label for="enable">
                            <input type="checkbox" name="status" id="status" value="1"> Enable
                        </label>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Create CMS</button>
                    </div>
                    
                
                
                </form>
                
                
            </div>
        </div>
    </div>
@endsection