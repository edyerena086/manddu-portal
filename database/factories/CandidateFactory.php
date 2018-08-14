<?php

use Faker\Generator as Faker;

$factory->define(ReclutaTI\Candidate::class, function (Faker $faker) {
    return [
        'user_id' => factory(\ReclutaTI\User::class)->create(['user_role_id' => \ReclutaTI\UserRole::CANDIDATE])->id,
        'last_name' => $faker->lastName
    ];
});
