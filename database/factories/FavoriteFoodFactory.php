<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\FavoriteFood;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(FavoriteFood::class, function (Faker $faker) {
    return [
        'customer_id' => $faker->numberBetween(1, App\Models\Customer::count()),
        'food_id' => $faker->numberBetween(1, App\Models\Food::count()),
        'created_at' => $faker->date(),
        'updated_at' => $faker->date(),
    ];
});
