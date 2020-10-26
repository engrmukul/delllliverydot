<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\FoodVariant;
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

$factory->define(FoodVariant::class, function (Faker $faker) {
    return [
        'food_id' => $faker->numberBetween(1, App\Models\Food::count()),
        'name' => $faker->name,
        'price' => $faker->randomFloat(3, 0,500),
        ];
});
