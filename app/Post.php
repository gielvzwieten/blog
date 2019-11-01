<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class Post extends Model
{

    public static function getAllPosts()
    {
        return $posts = app(Pipeline::class)
            ->send(Post::query())
            ->through([
                \App\QueryFilters\Sort::class,
                \App\QueryFilters\Category::class,
                \App\QueryFilters\Published::class,
            ])
            ->thenReturn()
            ->paginate(5);
    }

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // One to One relationship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // many to many relationship with tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
