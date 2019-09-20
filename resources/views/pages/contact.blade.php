@extends('layouts.app')
@section('title', 'Contact page')
@section('content')
@section('cactive', 'active')
<div class="row">
    <div class="col-md-12">
        <h1>Contact me</h1>
        <hr>
        <form method="POST" action="/contact">
            @csrf
            <div class="form-group">
                <label name="email" for="email">Email:</label>
                <input type="text" id="email" name="email" class="form-control">
            </div>

            <div class="form-group">
                <label name="subject" for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" class="form-control">
            </div>

            <div class="form-group">
                <label name="message" for="message">Message:</label>
                <textarea name="message" id="message" class="form-control" cols="30" rows="10">Type your message here...</textarea>
            </div>
            <button type="submit" class="btn btn-success">Send Message</button>
        </form>
    </div>
</div>

@endsection