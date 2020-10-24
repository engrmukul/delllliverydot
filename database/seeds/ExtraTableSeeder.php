<?php

use Illuminate\Database\Seeder;
use App\Models\Extra;


class ExtrasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 50;
        factory(Extra::class, $count)->create();
    }
}
