<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'description' => $faker->sentence(4),
        'earliest_date'         => $faker->DateTime(),
        'latest_date'           => $faker->DateTime(),
        'image_file_names'      => '["testjson","testjson2"]',
        'physical_description'  => $faker->sentence(4),
        'designer'              => $faker->sentence(4),
        'origin'                => $faker->word(4),
        'materials'             => $faker->sentence(4),
        'techniques'            => $faker->sentence(4),
        'decorations'           => $faker->sentence(4),
        'search_words'          => $faker->sentence(4),
        'sewing_methods'        => '["testjson","testjson2"]',
        'classification'        => '["testjson","testjson2"]',
        'cut'                   => '["testjson","testjson2"]',
        'fastenings'             => '["testjson","testjson2"]',
        'stiffening'            => '["testjson","testjson2"]',
        'condition'             => '["testjson","testjson2"]',
        'measurements'          => '["testjson","testjson2"]',
        'alterations'           => $faker->sentence(4),
        'provenance'            => $faker->sentence(4),
        'consent'               => $faker->word(1),
        'owner_id' => factory(App\User::class)
    ];
});
