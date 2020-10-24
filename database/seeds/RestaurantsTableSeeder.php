<?php

use Illuminate\Database\Seeder;
use App\Models\Restaurant;


class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 100;
        factory(Restaurant::class, $count)->create();
    }
}
