@extends('layouts.app')
@section('title', 'Blog Page')
@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Blog</h1>
        </div>
    </div>
@foreach($posts as $post)
    <div class="row">
        <div class="col-md-8">
            <div class="col-md-offset-2">
                <h2>{{$post->title}}</h2>
                <h5>Published: {{ date('M j, Y', strtotime($post->created_at)) }}</h5>
                <p>{{ substr($post->body, 0, 250) }}{{strlen($post->body)>250 ? '...' : ''}}</p>
                <a class="btn btn-primary" href="/blog/{{$post->id}}/{{\Illuminate\Support\Str::slug($post->title, '-')}}">Read More</a>
                <p class="text-muted mt-3">Posted By: {{$post->user->name}}</p>
                <hr>
            </div>
        </div>
    </div>
@endforeach
    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>

@endsection

