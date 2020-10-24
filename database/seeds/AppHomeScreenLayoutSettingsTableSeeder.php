<?php

use Illuminate\Database\Seeder;
use App\Models\AppHomeScreenLayoutSetting;


class AppHomeScreenLayoutSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 6;
        factory(AppHomeScreenLayoutSetting::class, $count)->create();
    }
}
