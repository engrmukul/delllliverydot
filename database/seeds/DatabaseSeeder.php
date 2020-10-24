<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CustomerProfilesTableSeeder::class);
        $this->call(AppHomeScreenLayoutSettingsTableSeeder::class);
        //$this->call(RestaurantsTableSeeder::class);
        $this->call(RestaurantProfilesTableSeeder::class);
        $this->call(RestaurantReviewsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(FoodsTableSeeder::class);
        $this->call(FoodReviewsTableSeeder::class);
    }
}
