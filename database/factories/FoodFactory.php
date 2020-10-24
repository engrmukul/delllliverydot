<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Food;
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

$factory->define(Food::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'short_description' => $faker->text,
        'image' => $faker->imageUrl(),
        'price' => $faker->randomFloat(8,2),
        'discount_price' => $faker->randomFloat(8,2),
        'description' => $faker->text,
        'ingredients' => $faker->text,
        'unit' => $faker->text,
        'unit' => $faker->text,
        'package_count' => $faker->randomNumber(1,5),
        'weight' => $faker->randomNumber(50,1500),
        'featured' => 1,
        'deliverable_food' => 1,
        'restaurant_id' => $faker->numberBetween(1, App\Models\Restaurant::count()),
        'category_id' => $faker->numberBetween(1, App\Models\Category::count()),
        'options' => $faker->text,
        'status' => 'active',
        'created_by' => 1,
        'created_at' => date('Y-m-d'),
    ];
});
