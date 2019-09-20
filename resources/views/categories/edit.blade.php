@extends('layouts.app')
@section('title', "| Edit Tag")
@section('content')

    <form method="post" action="{{ route('categories.update', ['category' => $category]) }}">
        @csrf
        @method('PATCH')

        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{$category->name}}">
        <input style="margin-top:20px" type="submit" value="Save Changes" class="btn btn-success">
    </form>

@endsection

