<?php

Route::group(['prefix' => 'admin'], function () {

    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login');
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');


        // restaurant route
        Route::group(['prefix' => 'restaurants'], function () {
            Route::get('/requested', 'Admin\RestaurantController@requestedRestaurant')->name('restaurants.requested');
            Route::get('/requested-get-data', 'Admin\RestaurantController@requestedGetData')->name('restaurants.requested-get-data');
            Route::get('/', 'Admin\RestaurantController@index')->name('restaurants.index');
            Route::get('/get-data', 'Admin\RestaurantController@requestedGetData')->name('restaurants.get-data');
            Route::get('/reviews', 'Admin\RestaurantController@review')->name('restaurants.reviews');
            Route::get('/review-get-data', 'Admin\RestaurantController@reviewGetData')->name('restaurants.review-get-data');
            Route::get('/create', 'Admin\RestaurantController@create')->name('restaurants.create');
            Route::post('/store', 'Admin\RestaurantController@store')->name('restaurants.store');
            Route::get('/{id}/edit', 'Admin\RestaurantController@edit')->name('restaurants.edit');
            Route::put('/update', 'Admin\RestaurantController@update')->name('restaurants.update');
            Route::delete('/{id}/delete', 'Admin\RestaurantController@delete')->name('restaurants.destroy');
        });

        // food category route
        Route::group(['prefix' => 'food-categories'], function () {
            Route::get('/', 'Admin\FoodCategoryController@index')->name('food-categories.index');
            Route::get('/create', 'Admin\FoodCategoryController@create')->name('food-categories.create');
            Route::post('/store', 'Admin\FoodCategoryController@store')->name('food-categories.store');
            Route::get('/{id}/edit', 'Admin\FoodCategoryController@edit')->name('food-categories.edit');
            Route::put('/update', 'Admin\FoodCategoryController@update')->name('food-categories.update');
            Route::delete('/{id}/delete', 'Admin\FoodCategoryController@delete')->name('food-categories.destroy');
            Route::get('/get-data', 'Admin\FoodCategoryController@getData')->name('food-categories.get-data');
        });

        // food route
        Route::group(['prefix' => 'foods'], function () {
            Route::get('/', 'Admin\FoodController@index')->name('foods.index');
            Route::get('/create', 'Admin\FoodController@create')->name('foods.create');
            Route::post('/store', 'Admin\FoodController@store')->name('foods.store');
            Route::get('/{id}/edit', 'Admin\FoodController@edit')->name('foods.edit');
            Route::put('/update', 'Admin\FoodController@update')->name('foods.update');
            Route::delete('/{id}/delete', 'Admin\FoodController@delete')->name('foods.destroy');
            Route::get('/get-data', 'Admin\FoodController@getData')->name('foods.get-data');
        });

        // extra route
        Route::group(['prefix' => 'extras'], function () {
            Route::get('/', 'Admin\ExtraFoodController@index')->name('extras.index');
            Route::get('/create', 'Admin\ExtraFoodController@create')->name('extras.create');
            Route::post('/store', 'Admin\ExtraFoodController@store')->name('extras.store');
            Route::get('/{id}/edit', 'Admin\ExtraFoodController@edit')->name('extras.edit');
            Route::put('/update', 'Admin\ExtraFoodController@update')->name('extras.update');
            Route::delete('/{id}/delete', 'Admin\ExtraFoodController@delete')->name('extras.destroy');
            Route::get('/get-data', 'Admin\ExtraFoodController@getData')->name('extras.get-data');
        });

        // order route
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', 'Admin\OrderController@index')->name('orders.index');
            Route::get('/create', 'Admin\OrderController@create')->name('orders.create');
            Route::post('/store', 'Admin\OrderController@store')->name('orders.store');
            Route::get('/{id}/edit', 'Admin\OrderController@edit')->name('orders.edit');
            Route::put('/update', 'Admin\OrderController@update')->name('orders.update');
            Route::delete('/{id}/delete', 'Admin\OrderController@delete')->name('orders.destroy');
            Route::get('/get-data', 'Admin\OrderController@getData')->name('orders.get-data');
        });

        // coupon route
        Route::group(['prefix' => 'coupons'], function () {
            Route::get('/', 'Admin\CouponController@index')->name('coupons.index');
            Route::get('/create', 'Admin\CouponController@create')->name('coupons.create');
            Route::post('/store', 'Admin\CouponController@store')->name('coupons.store');
            Route::get('/{id}/edit', 'Admin\CouponController@edit')->name('coupons.edit');
            Route::put('/update', 'Admin\CouponController@update')->name('coupons.update');
            Route::delete('/{id}/delete', 'Admin\CouponController@delete')->name('coupons.destroy');
            Route::get('/get-data', 'Admin\CouponController@getData')->name('coupons.get-data');
        });

        // payment route
        Route::group(['prefix' => 'payments'], function () {
            Route::get('/', 'Admin\PaymentController@index')->name('payments.index');
            Route::get('/get-data', 'Admin\PaymentController@getData')->name('coupons.get-data');
        });

        // Customers route
        Route::group(['prefix' => 'customers'], function (){
            Route::get('/', 'Admin\CustomerController@index')->name('customers.index');
            Route::get('/create', 'Admin\CustomerController@create')->name('customers.create');
            Route::post('/store', 'Admin\CustomerController@store')->name('customers.store');
            Route::get('/{id}/edit', 'Admin\CustomerController@edit')->name('customers.edit');
            Route::put('/update', 'Admin\CustomerController@update')->name('customers.update');
            Route::delete('/{id}/delete', 'Admin\CustomerController@delete')->name('customers.destroy');
            Route::get('/get-data', 'Admin\CustomerController@getData')->name('customers.get-data');
        });

        // Riders route
        Route::group(['prefix' => 'riders'], function (){
            Route::get('/', 'Admin\RiderController@index')->name('riders.index');
            Route::get('/create', 'Admin\RiderController@create')->name('riders.create');
            Route::post('/store', 'Admin\RiderController@store')->name('riders.store');
            Route::get('/{id}/edit', 'Admin\RiderController@edit')->name('riders.edit');
            Route::put('/update', 'Admin\RiderController@update')->name('riders.update');
            Route::delete('/{id}/delete', 'Admin\RiderController@delete')->name('riders.destroy');
            Route::get('/get-data', 'Admin\RiderController@getData')->name('riders.get-data');
        });


    });
});
