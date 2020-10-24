<?php

use Illuminate\Database\Seeder;
use App\Models\ExtraGroup;


class ExtraGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 10;
        factory(ExtraGroup::class, $count)->create();
    }
}
