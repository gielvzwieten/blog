@extends('layouts.app')
@section('title', 'Edit Blog Post')
@section('stylesheets')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="row mt-3">
        <div class="col-md-8">
            <form id="editform" method="POST" action="/posts/{{$post->id}}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="title"><strong>Title</strong></label>
                    <input class="form-control" type="text" name="title" id="title" value="{{$post->title}}">
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="form-control" name="category_id">
                        <option value="">Select One</option>
                        @foreach($categories as $category)
                            {{--SELECTED OPTION--}}
                            {{--@if($post->category_id != null)--}}
                            <option {{ $category->id == $post->category_id ?  'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                            {{--@else--}}
                                {{--<option value="{{$category->id}}">{{$category->name}}</option>--}}
                            {{--@endif--}}
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tags">Tags</label>
                    <select class="form-control multiple-s2" name="tags[]" multiple="multiple">
                        @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="body"><strong>Body</strong></label>
                    <textarea class="form-control" rows="5" name="body" id="body">{{ $post->body }}</textarea>
                </div>
            </form>
        </div>

        <div class="col-md-4">
            <div class="card p-2">
                @if($post->category_id != null)
                    <dl class="dl-horizontal">
                        <dt>Category:</dt>
                        <dd>{{ $post->category->name }}</dd>
                    </dl>
                @endif

                <dl class="dl-horizontal">
                    <dt>Created At:</dt>
                    <dd>{{ date( 'M j, Y H:i', strtotime($post->created_at)) }}</dd>
                </dl>

                <dl class="dl-horizontal">
                    <dt>Last Updated:</dt>
                    <dd>{{ date( 'M j, Y H:i', strtotime($post->updated_at)) }}</dd>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="/posts/{{$post->id}}" class="btn btn-danger btn-block">Cancel</a>
                    </div>

                    <div class="col-sm-6">
                            <button type="submit" form="editform" class="btn btn-success btn-block">Save Changes</button>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.multiple-s2').select2();
            $('.multiple-s2').select2().val({!! json_encode($post->tags()->allRelatedIds()) !!}).trigger('change');
        });
    </script>
@endsection