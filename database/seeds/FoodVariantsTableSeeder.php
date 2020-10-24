<?php

use Illuminate\Database\Seeder;
use App\Models\FoodVariant;


class FoodVariantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 100;
        factory(FoodVariant::class, $count)->create();
    }
}
