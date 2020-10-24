<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\RestaurantProfile;
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

$factory->define(RestaurantProfile::class, function (Faker $faker) {
    return [
        'restaurant_id' => factory('App\Models\Restaurant')->create()->id,
        'name' => $faker->name,
        'delivery_type' => 'home',
        'delivery_fee' => 0,
        'delivery_time' => '30 min',
        'discount' => 0.00,
        'delivery_range' => 5,
        'mobile' => $faker->randomNumber(),
        'address' => $faker->address,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'closed_restaurant' => 1,
        'available_for_delivery' => 1,
        'feature_section' => $faker->unique(true)->numberBetween(1, 6),
        'sn' => $faker->numberBetween(1,100),
        'image' => $faker->imageUrl(),
        'description' => $faker->text,
        'information' => $faker->text,
        'options' => $faker->text,
    ];
});
