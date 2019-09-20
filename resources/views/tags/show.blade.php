@extends('layouts.app')
@section('title', "| $tag->name Tag")
@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>{{$tag->name}} Tag <small>{{$tag->posts->count()}} Posts</small></h1>
        </div>
        <div class="col-md-2">
            <a href="/tags/{{$tag->id}}/edit" class="btn btn-primary btn-block pull-right" style="margin-top:15px">Edit</a>
        </div>

        <div class="col-md-2">
            <form method="post" action="/tags/{{$tag->id}}">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger btn-block" style="margin-top:15px" value="Delete">
            </form>

        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Tags</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tag->posts as $post)
                            <tr>
                                <th>{{$post->id}}</th>
                                <td>{{$post->title}}</td>
                                <td>@foreach($post->tags as $tag)<span class="badge badge-secondary">{{ $tag->name }}</span> @endforeach</td>
                                <td><a href="/posts/{{$post->id}}" class="btn btn-outline-secondary btn-sm">View</a></td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
