<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Shop;
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

$factory->define(Shop::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'delivery_type' => 'home',
        'delivery_fee' => 0,
        'delivery_time' => '30 min',
        'discount' => 0.00,
        'delivery_range' => 5,
        'mobile' => $faker->phoneNumber,
        'address' => $faker->address,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'closed_shop' => 1,
        'available_for_delivery' => 1,
        'image' => $faker->imageUrl(),
        'description' => $faker->text,
        'information' => $faker->text,
        'options' => $faker->text,
    ];
});
