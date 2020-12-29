<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence,
        'article_id' => factory(\App\Article::class),
        'completed' => false
    ];
});
