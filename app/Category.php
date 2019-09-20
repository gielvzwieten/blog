<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // protected $table = 'categories'; // You only have to do this if the table name and model name are different

    protected $guarded = [];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
