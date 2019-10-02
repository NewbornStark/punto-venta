<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'name'        => $faker->realText(35),
        'description' => $faker->text(255),
        'sku'         => $faker->isbn10,
        'price'       => $faker->randomFloat(2, 499, 10000)
    ];
});
