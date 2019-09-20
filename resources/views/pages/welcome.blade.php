@extends('layouts.app')
@section('title', 'Welcome to my Blog page')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1>Welcome to my blog</h1>
                <p class="lead">Thank you for visiting. This is my first Laravel blog. Please read my popular posts!</p>
                <p><a class="btn btn-primary btn-lg" href="/blog" role="button">Read More Blogs</a></p>
            </div>
        </div>
    </div><!-- end of header .row -->

    {{--Blog Container--}}
    <div class="row">
        <div class="col-md-8">
            @foreach($posts as $post)
                <div class="post">
                    <h3>{{$post->title}}</h3>
                    <p>{{substr($post->body, 0, 300)}}{{(strlen($post->body)) > 300 ? '...' : '' }}</p>
                    <a href="/blog/{{$post->slug}}" class="btn btn-primary">Read more</a>
                    <p class="text-muted mt-3">Posted By: {{$post->user->name}} at {{ date( 'M j, Y', strtotime($post->updated_at)) }}</p>
                </div><hr>
            @endforeach

        </div>


        <div class="col-md-3 col-md-offset-1">
            <h2>Sidebar</h2>
        </div>
    </div>

@endsection