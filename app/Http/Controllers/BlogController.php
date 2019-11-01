<?php

namespace App\Http\Controllers;


use App\Category;
use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        $posts = Post::getAllPosts();
        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        return view('blog.show', compact('post'));
    }
}
