@extends('layouts.app')
@section('title', "| $post->title")
@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{$post->title}}</h1>
            <p>{{$post->body}}</p>

        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>comments</h1>
            @foreach($post->comments as $comment)
                <div class="comment">
                    <p><strong>Name:</strong> {{$comment->name}}</p>
                    <p><strong>Comment:</strong><br>{{$comment->comment}}</p><br>

                </div>
            @endforeach
        </div>
    </div>

        <div class="comment-form">
            <form method="post" action="/comments/{{ $post->id }}">
                @csrf

                <input type="hidden" name="post_id" value="{{ $post->id }}">

                <div class="row">
                    <div class="col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                    </div>

                    <div class="col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                    </div>

                    <div class="col-md-12">
                          <label for="comment">Comment</label>
                          <textarea class="form-control" name="comment" rows="5" id="comment" placeholder="Write Your Comment.."></textarea>

                          <input type="submit" class="btn btn-primary btn-block mt-3" value="Post Comment">
                    </div>
                </div>
            </form>
        </div>


@endsection