<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'body' => $faker->paragraph,
        'category_id' => factory(\App\Category::class)->create(),
        'user_id' => factory(\App\User::class)->create(),
    ];
});
