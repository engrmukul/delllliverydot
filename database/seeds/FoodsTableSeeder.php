<?php

use Illuminate\Database\Seeder;
use App\Models\Food;


class FoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 100;
        factory(Food::class, $count)->create();
    }
}
