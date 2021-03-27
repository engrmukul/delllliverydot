<?php

Route::get('/', 'Admin\DashboardController@index');
Route::get('/home', 'Admin\DashboardController@index');

Route::group(['prefix' => 'admin'], function () {

    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login');
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');


    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', 'Admin\DashboardController@index');
        Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
        Route::post('save-token', 'Admin\DashboardController@saveToken')->name('admin.save-token');

        // restaurant route
        Route::group(['prefix' => 'restaurants'], function () {
            Route::get('/requested', 'Admin\RestaurantController@requestedRestaurant')->name('restaurants.requested');
            Route::get('/requested-get-data', 'Admin\RestaurantController@requestedGetData')->name('restaurants.requested-get-data');
            Route::get('/', 'Admin\RestaurantController@index')->name('restaurants.index');
            Route::get('/get-data', 'Admin\RestaurantController@requestedGetData')->name('restaurants.get-data');

            Route::get('/reviews', 'Admin\RestaurantController@review')->name('restaurants.reviews');
            Route::get('/reviews/edit/{id}', 'Admin\RestaurantController@reviewEdit')->name('restaurants.reviewEdit');
            Route::delete('/reviews/delete/{id}', 'Admin\RestaurantController@reviewsDelete')->name('restaurants.reviewDestroy');
            Route::get('/review-get-data', 'Admin\RestaurantController@reviewGetData')->name('restaurants.review-get-data');

            Route::get('/create', 'Admin\RestaurantController@create')->name('restaurants.create');
            Route::post('/store', 'Admin\RestaurantController@store')->name('restaurants.store');
            Route::get('/{id}/edit', 'Admin\RestaurantController@edit')->name('restaurants.edit');
            Route::put('/update', 'Admin\RestaurantController@update')->name('restaurants.update');
            Route::delete('/{id}/delete', 'Admin\RestaurantController@delete')->name('restaurants.destroy');
            Route::get('/{id}/view', 'Admin\RestaurantController@view')->name('restaurants.view');
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

        // extra group route
        Route::group(['prefix' => 'groups'], function () {
            Route::get('/', 'Admin\GroupController@index')->name('groups.index');
            Route::get('/create', 'Admin\GroupController@create')->name('groups.create');
            Route::post('/store', 'Admin\GroupController@store')->name('groups.store');
            Route::get('/{id}/edit', 'Admin\GroupController@edit')->name('groups.edit');
            Route::put('/update', 'Admin\GroupController@update')->name('groups.update');
            Route::delete('/{id}/delete', 'Admin\GroupController@delete')->name('groups.destroy');
            Route::get('/get-data', 'Admin\GroupController@getData')->name('groups.get-data');
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
//        Route::group(['prefix' => 'payments'], function () {
//            Route::get('/', 'Admin\PaymentController@index')->name('payments.index');
//            Route::get('/get-data', 'Admin\PaymentController@getData')->name('coupons.get-data');
//        });

        // Customers route
        Route::group(['prefix' => 'customers'], function (){
            Route::get('/', 'Admin\CustomerController@index')->name('customers.index');
            Route::get('/create', 'Admin\CustomerController@create')->name('customers.create');
            Route::post('/store', 'Admin\CustomerController@store')->name('customers.store');
            Route::get('/{id}/edit', 'Admin\CustomerController@edit')->name('customers.edit');
            Route::put('/update', 'Admin\CustomerController@update')->name('customers.update');
            Route::delete('/{id}/delete', 'Admin\CustomerController@delete')->name('customers.destroy');
            Route::get('/get-data', 'Admin\CustomerController@getData')->name('customers.get-data');
            Route::get('/{id}/view', 'Admin\CustomerController@view')->name('customers.view');
        });

        // Promotional Banner route
        Route::group(['prefix' => 'promotionals'], function (){
            Route::get('/', 'Admin\PromotionalController@index')->name('promotionals.index');
            Route::get('/create', 'Admin\PromotionalController@create')->name('promotionals.create');
            Route::post('/store', 'Admin\PromotionalController@store')->name('promotionals.store');
            Route::get('/{id}/edit', 'Admin\PromotionalController@edit')->name('promotionals.edit');
            Route::put('/update', 'Admin\PromotionalController@update')->name('promotionals.update');
            Route::delete('/{id}/delete', 'Admin\PromotionalController@delete')->name('promotionals.destroy');
            Route::get('/get-data', 'Admin\PromotionalController@getData')->name('promotionals.get-data');
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
            Route::get('/{id}/view', 'Admin\RiderController@view')->name('riders.view');
        });

        // help and support route
        Route::group(['prefix' => 'helpandsupports'], function (){
            Route::get('/', 'Admin\HelpAndSupportController@index')->name('helpandsupports.index');
            Route::get('/create', 'Admin\HelpAndSupportController@create')->name('helpandsupports.create');
            Route::post('/store', 'Admin\HelpAndSupportController@store')->name('helpandsupports.store');
            Route::get('/{id}/edit', 'Admin\HelpAndSupportController@edit')->name('helpandsupports.edit');
            Route::put('/update', 'Admin\HelpAndSupportController@update')->name('helpandsupports.update');
            Route::delete('/{id}/delete', 'Admin\HelpAndSupportController@delete')->name('helpandsupports.destroy');
            Route::get('/get-data', 'Admin\HelpAndSupportController@getData')->name('helpandsupports.get-data');
        });

        // terms and conditions
        Route::group(['prefix' => 'termsandconditions'], function (){
            Route::get('/', 'Admin\TermsAndConditionController@index')->name('termsandconditions.index');
            Route::get('/get-data', 'Admin\TermsAndConditionController@getData')->name('termsandconditions.get-data');
            Route::get('/{id}/edit', 'Admin\TermsAndConditionController@edit')->name('termsandconditions.edit');
            Route::put('/update', 'Admin\TermsAndConditionController@update')->name('termsandconditions.update');
        });

        //SETTINGS
        Route::get('/edit', 'Admin\SettingsController@edit')->name('settings.edit');
        Route::put('/update', 'Admin\SettingsController@update')->name('settings.update');

    });
});
