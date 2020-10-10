<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

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
    $hasher = app()->make('hash');
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'gender' => $faker->randomElement(["male", "female", "other"]),
        'password' => $hasher->make("secret")
    ];
});
$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(4),
        'description' => $faker->paragraph(4),
        'datetime' => $faker->datetime(),
        'status' => $faker->randomElement(["completed", "snoozed", "overdue"]),
        'category_id' => mt_rand(1, 10),
        'user_id' => mt_rand(1, 10)
    ];
});
$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word(4),
        'user_id' => mt_rand(1, 10)
    ];
});
