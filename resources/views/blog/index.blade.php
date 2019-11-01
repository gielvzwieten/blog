@extends('layouts.app')
@section('title', 'Blog Page')
@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Blog</h1>
            @foreach($posts as $post)
                <div class="card mb-5">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        @if($post->category != null)
                        <h6 class="card-subtitle mb-2 text-muted">Category: <span class="badge">{{ $post->category->name }}</span></h6>
                        @endif
                        <p class="card-text">{{ substr($post->body, 0, 250) }}{{strlen($post->body)>250 ? '...' : ''}}</p>
                        <a href="/blog/{{$post->id}}/{{\Illuminate\Support\Str::slug($post->title, '-')}}" class="btn btn-primary">Read More</a>
                        @if($post->tags->count())
                            <p class="text-muted mt-3">Tags: @foreach($post->tags as $tag)<span class="badge badge-secondary">{{ $tag->name }}</span> @endforeach</p>
                        @endif
                        <p class="text-muted mt-3">Published: {{ date('M j, Y', strtotime($post->created_at)) }}</p>
                        <p class="text-muted mt-3">Posted By: {{$post->user->name}}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col-md-4">
            <div>
                @include('partials.filters._dropdown', ['link' => 'blog'])
            </div>
            <div class="card p-2 mt-5">
                @include('partials.filters._category')
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                {{ $posts->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function(){
            // bind change event to select
            $('#sort').on('change', function () {
                var url = $(this).val(); // get selected value
                if (url) { // require a URL
                    window.location = url; // redirect
                }
                return false;
            });
        });
    </script>
@endsection
