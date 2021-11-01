<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
        'author' => $faker->sentence(),
        'code' => $faker->sentence(),
        'size' => $faker->randomFloat(2, 0, 1),
    ];
});



