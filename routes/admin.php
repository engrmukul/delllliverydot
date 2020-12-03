<?php

Route::group(['prefix' => 'admin'], function () {

    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {

        // restaurant route
        Route::group(['prefix' => 'restaurants'], function () {
            Route::get('/', 'Admin\RestaurantController@index')->name('restaurants.index');
            Route::get('/create', 'Admin\RestaurantController@create')->name('restaurants.create');
            Route::post('/store', 'Admin\RestaurantController@store')->name('restaurants.store');
            Route::get('/{id}/edit', 'Admin\RestaurantController@edit')->name('restaurants.edit');
            Route::put('/update', 'Admin\RestaurantController@update')->name('restaurants.update');
            Route::delete('/{id}/delete', 'Admin\RestaurantController@delete')->name('restaurants.destroy');
            Route::get('/get-data', 'Admin\RestaurantController@getData')->name('restaurants.get-data');
        });
    });
});
