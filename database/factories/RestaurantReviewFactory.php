<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\RestaurantReview;
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

$factory->define(RestaurantReview::class, function (Faker $faker) {
    return [
        'review' => $faker->text,
        'rate' => $faker->numberBetween(1,5),
        'restaurant_id' => $faker->numberBetween(1, App\Models\Restaurant::count()),
        'customer_id' => $faker->numberBetween(1, App\Models\Customer::count()),
        'created_at' => $faker->date(),
        'updated_at' => $faker->date(),
    ];
});
