<?php

use Illuminate\Database\Seeder;
use App\Models\RestaurantProfile;


class RestaurantProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 100;
        factory(RestaurantProfile::class, $count)->create();
    }
}
