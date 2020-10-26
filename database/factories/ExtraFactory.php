<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Extra;
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

$factory->define(Extra::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'description' => $faker->text,
        'image' => $faker->imageUrl(),
        'price' => $faker->randomFloat(2,0,3),
        'food_id' => $faker->numberBetween(1, App\Models\Food::count()),
        'extra_group_id' => $faker->numberBetween(1, App\Models\ExtraGroup::count()),
        'status' => 1,
        'created_by' => 1,
        'created_at' => $faker->date(),
    ];
});
