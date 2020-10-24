<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderDetail;
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

$factory->define(OrderDetail::class, function (Faker $faker) {
    return [
        'order_id' => $faker->numberBetween(1, App\Models\Order::count()),
        'food_id' => $faker->numberBetween(1, App\Models\Food::count()),
        'food_variant_id' => $faker->numberBetween(1, App\Models\FoodVariant::count()),
        'food_quantity' => 1,
        'extra_id' => $faker->numberBetween(1, App\Models\Extra::count()),
        'extra_price'=> $faker->randomFloat(4,2),
        'sub_total'=> $faker->randomFloat(4,2),
    ];
});
