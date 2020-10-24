<?php

use Illuminate\Database\Seeder;
use App\Models\CustomerProfile;


class CustomerProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 100;
        factory(CustomerProfile::class, $count)->create();
    }
}
