<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Post::class);

        $posts = Post::orderBy('id', 'DESC')->paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

            $attributes = $request->validate([
                'title'         => 'required|max:255',
                'body'          => 'required',
                'category_id'   => 'nullable|exists:posts,id',
                'tags'          => 'nullable|array',
            ]);

        $attributes['user_id'] = auth()->id();

        // store in database and make many to many relation
        Post::create([
            'title'         => $attributes['title'],
            'body'          => $attributes['body'],
            'category_id'   => $attributes['category_id'],
            'user_id'       => $attributes['user_id']
        ])->tags()->sync($request->tags, false);

        session()->flash('successmessage', 'Your created blog post has successfully been created');

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $attributes = $request->validate([
            'title'         => 'required|max:255',
            'body'          => 'required',
            'category_id'   => 'nullable|exists:posts,id',
            'tags'          => 'nullable|array',
        ]);

        $post->update([
            'title'         => $attributes['title'],
            'body'          => $attributes['body'],
            'category_id'   => $attributes['category_id']
        ]);

        // adding data to database for the multiple select tags field. if there is nothing set it will set an empty array to the database.
        if (isset($request->tags)) {
            $post->tags()->sync($request->tags, true);
        } else {
            $post->tags()->sync(array());
        }

        session()->flash('successmessage', 'Changes have been saved');

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        session()->flash('successmessage', 'Post Deleted');
        return redirect()->route('posts.index');
    }
}
