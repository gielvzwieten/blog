@extends('layouts.app')
@section('title', '| All Categories')
@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Categories</h1>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach($categories as $category)
                <tr>
                    <th>{{$category->id}}</th>
                    <td>{{$category->name}}</td>
                    <td class="row">
                        <a class="col-sm-3 offset-6 btn-sm btn btn-warning btn-block" href="/categories/{{$category->id}}/edit">Edit</a>

                        <form class="col-sm-3" action="{{ route('categories.destroy', ['category' => $category]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn-sm btn btn-danger btn-block" type="submit">Delete</button>
                        </form>

                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- end of col -->
        <div class="col-md-3">
            <div class="card p-2">
                <form method="post" action="/categories">
                    @csrf
                    <h2>New Category</h2>
                    <label for="name">Name</label>
                    <input class="form-control" type="text" id="name" name="name">
                    <input type="submit" value="Create New Category" class="btn btn-primary btn-block mt-2">
                </form>
            </div>
        </div>
    </div>

@endsection

