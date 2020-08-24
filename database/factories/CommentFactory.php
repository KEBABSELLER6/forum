<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'body'=>$faker->text,
        'user_id'=>App\User::all()->random()->id,
        'post_id'=>App\Post::all()->random()->id,
        'show_id'=>uniqid()
    ];
});
