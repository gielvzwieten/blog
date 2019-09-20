@extends('layouts.app')
@section('title', 'Posts page')
@section('content')
<div class="row mt-3 mb-2">
    <div class="col-md-10 align-self-end">
        <h1 class="mb-0">All Posts</h1>
    </div>
    
    <div class="col-md-2 align-self-end">
        <a href="/posts/create" class="btn btn-md btn-block btn-primary">Create New Post</a>
    </div>
    <div class="col-md-12 mb-4">

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <th>#</th>
                <th>Title</th>
                <th>Body</th>
                <th>Created At</th>
                <th></th>
            </thead>

            <tbody>
            @foreach($posts as $post)
                <tr>
                    <th>{{$post->id}}</th>
                    <td>{{$post->title}}</td>
                    <td>{{ substr($post->body, 0, 28) }}{{ strlen($post->body) > 28 ? '...' : '' }}</td>
                    <td>{{ date('d M Y, H:i', strtotime($post->created_at)) }}</td>
                    <td><a class="btn btn-success btn-sm" href="/posts/{{$post->id}}">View</a> <a class="btn btn-warning btn-sm" href="/posts/{{$post->id}}/edit">Edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection