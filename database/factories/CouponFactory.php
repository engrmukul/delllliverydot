<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Coupon;
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

$factory->define(Coupon::class, function (Faker $faker) {
    return [
        'code' => 'DOT'.$faker->unique()->numberBetween(1,3),
        'discount_type' => 'percent',
        'discount' => $faker->randomFloat(2,2),
        'food_id' => $faker->numberBetween(1, App\Models\Food::count()),
        'restaurant_id' => $faker->numberBetween(1, App\Models\Restaurant::count()),
        'category_id' => $faker->numberBetween(1, App\Models\Category::count()),
        'expire_at' => $faker->dateTime(),
        'enabled' => 1,
        'status' => 1,
        'created_by' => 1,
        'created_at' => $faker->date(),
    ];
});
