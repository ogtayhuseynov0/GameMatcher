<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;
    $gender = $faker->randomElements(['male', 'female']);
    return [
        'name' => $faker->name,
        'gender' => "male",
        'email' => $faker->unique()->safeEmail,
        'birthDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
