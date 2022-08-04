<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Container;
use Faker\Generator as Faker;

$factory->define(Container::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->numberBetween($min=1, $max=700),
        'state' => $faker->randomElement(['1', '0'])
    ];
});
