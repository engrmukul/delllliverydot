<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResources([
    'customers' => API\V1\CustomerController::class,
    'restaurants' => API\V1\RestaurantController::class,
    'riders' => API\V1\RiderController::class,
]);

Route::post('/otp-verify', 'API\V1\CustomerController@otpVerify')->name('otp-verify');


Route::post('/my-orders', 'API\V1\OrderController@index')->name('my-orders');

Route::post('/items', 'API\V1\RestaurantController@itemList')->name('items');
Route::post('/my-location-save', 'API\V1\RestaurantController@myLocationSave')->name('my-location-save');
Route::post('/my-locations', 'API\V1\RestaurantController@myLocation')->name('my-locations');
Route::post('/my-profile', 'API\V1\RestaurantController@myProfile')->name('my-profile');
Route::post('/profile-update', 'API\V1\RestaurantController@myProfileUpdate')->name('profile-update');
Route::post('/my-favorite-foods', 'API\V1\RestaurantController@myFavoriteFood')->name('my-favorite-foods');
Route::post('/my-delivery-save', 'API\V1\RestaurantController@myDeliverySave')->name('my-delivery-save');
Route::post('/my-delivery', 'API\V1\RestaurantController@myDeliveryList')->name('my-delivery');
Route::post('/settings', 'API\V1\RestaurantController@settings')->name('settings');
Route::post('/settings-update', 'API\V1\RestaurantController@settingsUpdate')->name('settings-update');
Route::post('/order', 'API\V1\RestaurantController@order')->name('order');

Route::post('/restaurant-order-list', 'API\V1\RestaurantController@restaurantOrderList')->name('restaurant-order-list');



//RIDER
Route::post('/rider-otp-verify', 'API\V1\RiderController@otpVerify')->name('rider-otp-verify');
Route::post('/rider-document', 'API\V1\RiderController@documentUpdate')->name('rider-document');
Route::post('/rider-today-order', 'API\V1\RiderController@riderTodayOrder')->name('rider-today-order');
Route::post('/rider-order-history', 'API\V1\RiderController@index')->name('rider-order-history');
Route::post('/rider-profile-update', 'API\V1\RiderController@riderProfileUpdate')->name('rider-profile-update');
Route::post('/rider-settings', 'API\V1\RiderController@settingsUpdate')->name('rider-settings');



Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'], 404);
});
