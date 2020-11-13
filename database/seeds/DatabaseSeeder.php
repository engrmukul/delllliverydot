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
        //FOOD
        $this->call(UsersTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(CustomerProfilesTableSeeder::class);
        $this->call(AppHomeScreenLayoutSettingsTableSeeder::class);
        $this->call(RestaurantsTableSeeder::class);
        $this->call(RestaurantProfilesTableSeeder::class);
        $this->call(RestaurantReviewsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(FoodsTableSeeder::class);
        $this->call(FoodVariantsTableSeeder::class);
        $this->call(FoodReviewsTableSeeder::class);
        $this->call(CouponsTableSeeder::class);
        $this->call(ExtraGroupsTableSeeder::class);
        $this->call(ExtrasTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderDetailsTableSeeder::class);
        $this->call(FavoriteFoodsTableSeeder::class);


        //SHOP
        $this->call(ShopsTableSeeder::class);
    }
}
