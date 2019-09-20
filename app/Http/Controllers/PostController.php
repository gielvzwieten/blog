<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use App\User;
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
        $this->authorize('viewAny', Post::class);
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
        $this->authorize('viewAny', Post::class);
        // validate data

        $attributes = request()->validate([
            'title'       => 'required|max:255',
            'body'        => 'required',
        ]);

        //assign category_id to the id of the Category table
        $attributes['category_id'] = $request->category_id;
        $attributes['user_id'] = auth()->id();

        // store in database and make many to many relation
        Post::create($attributes)->tags()->sync($request->tags, false);


        session()->flash('successmessage', 'Your created blog post has successfully been created');
        // redirect to another page
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
        $this->authorize('viewAny', $post);
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
        $this->authorize('viewAny', $post);
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
        $this->authorize('viewAny', $post);

        $attributes = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'sometimes|integer',
        ]);

        //update data
        $post->update($attributes);

        // adding data to database for the multiple select tags field. if there is nothing set it will set an empty array to the database.
        if (isset($request->tags)) {
            $post->tags()->sync($request->tags, true);
        } else {
            $post->tags()->sync(array());
        }

        //send flash message
        session()->flash('successmessage', 'Changes have been saved');

        //redirect page
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
        $this->authorize('viewAny', $post);
        $post->delete();
        session()->flash('successmessage', 'Post Deleted');
        return redirect()->route('posts.index');
    }
}
