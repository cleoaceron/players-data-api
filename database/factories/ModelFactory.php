<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\Player::class, function (Faker\Generator $faker) {
    return [
    	'uuid' => $faker->uuid,
    	'player_id' => $faker->playerId,
        'first_name' => $faker->firstName,
        'second_name' => $faker->secondName,
        'form' => $faker->form,
        'total_points' => $faker->totalPoints,
        'influence' => $faker->influence,
        'creativity' => $faker->creativity,
        'threat' => $faker->date,
        'ict_index' => $faker->date
    ];
});
