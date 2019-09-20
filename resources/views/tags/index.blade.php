@extends('layouts.app')
@section('title', '| All Tags')
@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Tags</h1>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                </tr>
                </thead>

                <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <th>{{$tag->id}}</th>
                        <td><a href="{{ route('tags.show', $tag->id) }}">{{$tag->name}}</a></td>
{{--                        <td>{{$tag->posts->title}}</td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- end of col -->
        <div class="col-md-3">
            <div class="card p-2">
                <form method="post" action="/tags">
                    @csrf
                    <h2>New Tag</h2>
                    <label for="name">Name</label>
                    <input class="form-control" type="text" id="name" name="name">
                    <input type="submit" value="Create New Tag" class="btn btn-primary btn-block mt-2">
                </form>
            </div>
        </div>
    </div>
@endsection