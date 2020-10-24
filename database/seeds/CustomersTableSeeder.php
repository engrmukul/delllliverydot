<?php

use Illuminate\Database\Seeder;
use App\Models\Customer;


class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 100;
        factory(Customer::class, $count)->create();
    }
}
