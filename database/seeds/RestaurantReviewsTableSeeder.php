<?php

use Illuminate\Database\Seeder;
use App\Models\RestaurantReview;


class RestaurantReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 500;
        factory(RestaurantReview::class, $count)->create();
    }
}
