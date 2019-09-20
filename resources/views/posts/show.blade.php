@extends('layouts.app')
@section('title', 'View a Post')
@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>{{ $post->title }}</h1>
            <p class="lead">{{ $post->body }}</p>
            <hr>
            <div class="tags">
                @foreach($post->tags as $tag)
                    <span class="badge badge-secondary">{{$tag->name}}</span>
                @endforeach
            </div>

            <div class="backend-comments mt-5">
                <h3>Comments <small>{{$post->comments->count()}} total</small></h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Comment</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($post->comments as $comment)
                        <tr>
                            <td>{{$comment->name}}</td>
                            <td>{{$comment->email}}</td>
                            <td>{{$comment->comment}}</td>
                            <td class="row">
                                <a href="" class="btn btn-sm btn-primary col-sm-5">Edit</a>
                                <a href="" class="btn btn-sm btn-danger col-sm-5 offset-2">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>





            </div>

        </div>

        <div class="col-md-4">
            <div class="card p-2">

                <dl class="dl-horizontal">
                    @if($post->category_id != null)
                        <dl class="dl-horizontal">
                            <dt>Category:</dt>
                            <dd>{{ $post->category->name }}</dd>
                        </dl>
                    @endif
                </dl>

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
                        <a href="/posts/{{$post->id}}/edit" class="btn btn-primary btn-block">Edit</a>
                    </div>

                        <div class="col-sm-6">
                            <form method="POST" action="/posts/{{$post->id}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-block">Delete</button>
                            </form>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-secondary btn-block mt-5" href="/posts"> <<< Show All Posts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection