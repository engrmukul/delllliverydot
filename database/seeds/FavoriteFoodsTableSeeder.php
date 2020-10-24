<?php

use Illuminate\Database\Seeder;
use App\Models\FavoriteFood;


class FavoriteFoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 500;
        factory(FavoriteFood::class, $count)->create();
    }
}
