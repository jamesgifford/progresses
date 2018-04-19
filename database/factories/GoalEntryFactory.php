<?php

use App\Models\GoalEntry;
use Faker\Generator as Faker;

$factory->define(GoalEntry::class, function (Faker $faker) {
    return [
        'goal_id' => 1,
        'amount' => $faker->numberBetween(0, 1),
        'recorded_at' => $faker->dateTimeBetween('-1 years', 'now')
    ];
});
