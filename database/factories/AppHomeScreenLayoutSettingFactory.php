<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\AppHomeScreenLayoutSetting;

$factory->define(AppHomeScreenLayoutSetting::class, function (Faker $faker) {

    $arrayValues = ['trending', 'popular', 'discounted', 'favorite', 'trr' , 'trf'];

    return [
        'row' => $arrayValues[rand(0,5)],
        'status' => 'active',
        'created_by' => 1,
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d'),
    ];
});
