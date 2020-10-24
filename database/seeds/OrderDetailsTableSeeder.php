<?php

use Illuminate\Database\Seeder;
use App\Models\OrderDetail;


class OrderDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 3000;
        factory(OrderDetail::class, $count)->create();
    }
}
