<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'=>$faker->text,
        'descr'=>$faker->paragraph(3),
        'topic_id'=>factory(\App\Topic::class),
        'created_by'=>$faker->userName,
        'show_id'=>uniqid()
    ];
});
