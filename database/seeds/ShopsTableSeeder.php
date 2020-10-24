<?php

use Illuminate\Database\Seeder;
use App\Models\Shop;


class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 100;
        factory(Shop::class, $count)->create();
    }
}
