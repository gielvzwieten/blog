@extends('layouts.app')
@section('title', '| Create New Post')
@section('stylesheets')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2 m-auto">
            <h1>Create New Post</h1>
            <hr>
            <form method="post" action="/posts">
                @csrf

                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input class="form-control" type="text" id="title" name="title" placeholder="Title" value="{{old('title')}}">
                </div>

                <div class="form-group">
                    <label for="category_id">category</label>
                    <select class="form-control" name="category_id">
                        <option value="">Select One</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tags">Tags</label>
                    <select class="form-control multiple-s2" multiple="multiple" name="tags[]">
                        @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="body">Post Description</label>
                    <textarea class="form-control" name="body" id="body">{{old('body')}}</textarea>
                </div>

                <input type="submit" value="Create Post" class="btn btn-success btn-lg btn-block">
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.multiple-s2').select2();
        });
    </script>
@endsection