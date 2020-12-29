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
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', 'Admin\CategoryController@index')->name('categories.index');
            Route::get('/create', 'Admin\CategoryController@create')->name('categories.create');
            Route::post('/store', 'Admin\CategoryController@store')->name('categories.store');
            Route::get('/{id}/edit', 'Admin\CategoryController@edit')->name('categories.edit');
            Route::put('/update', 'Admin\CategoryController@update')->name('categories.update');
            Route::delete('/{id}/delete', 'Admin\CategoryController@delete')->name('categories.destroy');
            Route::get('/get-data', 'Admin\CategoryController@getData')->name('categories.get-data');
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
            Route::get('/', 'Admin\ExtraController@index')->name('extras.index');
            Route::get('/create', 'Admin\ExtraController@create')->name('extras.create');
            Route::post('/store', 'Admin\ExtraController@store')->name('extras.store');
            Route::get('/{id}/edit', 'Admin\ExtraController@edit')->name('extras.edit');
            Route::put('/update', 'Admin\ExtraController@update')->name('extras.update');
            Route::delete('/{id}/delete', 'Admin\ExtraController@delete')->name('extras.destroy');
            Route::get('/get-data', 'Admin\ExtraController@getData')->name('extras.get-data');
        });

        // order route
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', 'Admin\OrderController@index')->name('orders.index');
            Route::get('/create', 'Admin\OrderController@create')->name('orders.create');
            Route::post('/store', 'Admin\OrderController@store')->name('orders.store');
            Route::get('/{id}/edit', 'Admin\OrderController@edit')->name('orders.edit');
            Route::get('/{id}/view', 'Admin\OrderController@view')->name('orders.view');
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


    });
});
