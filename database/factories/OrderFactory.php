<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
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

$factory->define(Order::class, function (Faker $faker) {
    return [
        'customer_id' => $faker->numberBetween(1, App\Models\Customer::count()),
        'delivery_address' => $faker->address,
        'order_date' => $faker->dateTime,
        'order_status'=> 'order_received',
        'payment_method' => 'cash_on_delivery',
        'payment_status' => 'waiting_for_customer',
        'total_price' => $faker->randomFloat(2,0,2),
        'discount' => $faker->randomFloat(2,0,2),
        'vat' => $faker->randomFloat(2,0,2),
        'delivery_fee' => 'free',
        'instructions'=> $faker->text,
        'restaurant_id' => $faker->numberBetween(1, App\Models\Restaurant::count()),
        'coupon_code' => 'DOT100',
    ];
});
