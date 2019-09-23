<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use \App\Post;

class PagesController extends Controller
{
    public function getIndex()
    {
        $posts = Post::orderBy('id', 'desc')->limit(5)->get();
        return view('pages.welcome', compact('posts'));
    }

    public function getAbout()
    {
        return view('pages.about');
    }

    public function getContact()
    {
        return view('pages.contact');
    }

    public function postContact(Request $request)
    {
        // validate
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'subject' => $request->subject,
            'bodyMessage' => $request->message,
        ];

        Mail::send('emails.contact', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('gielvzwieten@gmail.com');
            $message->subject($data['subject']);
        });

        //session message
        session()->flash('successmessage', 'Mail has been sent!');
        //redirect
        return back();
    }
}
