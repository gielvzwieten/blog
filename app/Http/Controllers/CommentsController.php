<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name'      => 'required|max:255',
            'email'     => 'required|email',
            'comment'   => 'required',
            'post_id'   => 'required|exists:posts,id',
        ]);

        Comment::create($attributes);

        session()->flash('successmessage', 'Comment Posted');

        return back();
    }
}
