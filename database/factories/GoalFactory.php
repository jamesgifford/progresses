<?php

use App\Models\Goal;
use Faker\Generator as Faker;

$factory->define(Goal::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'name' => $faker->words(5, true),
        'description' => $faker->paragraph,
        'target' => 1,
        'operator' => '=='
    ];
});
