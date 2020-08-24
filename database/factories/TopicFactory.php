<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Topic;
use Faker\Generator as Faker;

$factory->define(Topic::class, function (Faker $faker) {
    return [
        'title'=>$faker->text,
        'descr'=>$faker->paragraph,
        'type'=>$faker->randomElement(['general','unique']),
        'user_id'=>App\User::all()->random()->id,
        'show_id'=>uniqid()
    ];
});
