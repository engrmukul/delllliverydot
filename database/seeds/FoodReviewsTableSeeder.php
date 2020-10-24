<?php

use Illuminate\Database\Seeder;
use App\Models\FoodReview;


class FoodReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 500;
        factory(FoodReview::class, $count)->create();
    }
}
