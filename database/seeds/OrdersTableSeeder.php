<?php

use Illuminate\Database\Seeder;
use App\Models\Order;


class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 1000;
        factory(Order::class, $count)->create();
    }
}
