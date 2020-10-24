<?php

use Illuminate\Database\Seeder;
use App\Models\Coupon;


class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 10;
        factory(Coupon::class, $count)->create();
    }
}
