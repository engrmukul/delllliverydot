<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CustomerProfile;
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

$factory->define(CustomerProfile::class, function (Faker $faker) {
    return [
        'customer_id' => factory('App\Models\Customer')->create()->id,
        'image' => $faker->imageUrl(),
        'dob' => $faker->date(),
        'spouse_dob' => $faker->date(),
        'father_dob' => $faker->date(),
        'mother_dob' => $faker->date(),
        'anniversary' => $faker->date(),
        'first_child_dob' => $faker->date(),
        'second_child_dob' => $faker->date(),
        'address' => $faker->address,
        'short_biography' => $faker->text
    ];
});
