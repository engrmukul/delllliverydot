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

//CUSTOMER
Route::post('/otp-verify', 'API\V1\CustomerController@otpVerify')->name('otp-verify');

//Route::post('/my-orders', 'API\V1\OrderController@index')->name('my-orders');

Route::get('restaurant-list', 'API\V1\CustomerController@restaurantList')->name('restaurant-list');

Route::post('promotional-restaurants', 'API\V1\CustomerController@promotionalRestaurants')->name('restaurant-list');

Route::post('restaurant-panel', 'API\V1\CustomerController@restaurantPanel')->name('restaurant-panel');

Route::post('food-variants', 'API\V1\CustomerController@foodVariants')->name('food-variants');

Route::post('/items', 'API\V1\CustomerController@itemList')->name('items');
Route::post('/my-location-save', 'API\V1\CustomerController@myLocationSave')->name('my-location-save');
Route::post('/my-location-update', 'API\V1\CustomerController@myLocationUpdate')->name('my-location-update');
Route::post('/my-location-delete', 'API\V1\CustomerController@myLocationDelete')->name('my-location-delete');
Route::post('/my-locations', 'API\V1\CustomerController@myLocation')->name('my-locations');
Route::post('/selected-location', 'API\V1\CustomerController@customerSelectedLocation')->name('selected-location');
Route::post('/my-profile', 'API\V1\CustomerController@myProfile')->name('my-profile');
Route::post('/profile-update', 'API\V1\CustomerController@myProfileUpdate')->name('profile-update');
Route::post('/my-favorite-foods', 'API\V1\CustomerController@myFavoriteFood')->name('my-favorite-foods');
Route::post('/my-delivery-save', 'API\V1\CustomerController@myDeliverySave')->name('my-delivery-save');
Route::post('/my-delivery', 'API\V1\CustomerController@myDeliveryList')->name('my-delivery');
Route::post('/settings', 'API\V1\CustomerController@settings')->name('settings');
Route::post('/settings-update', 'API\V1\CustomerController@settingsUpdate')->name('settings-update');

Route::post('/promo-code', 'API\V1\CustomerController@applyPromoCode')->name('promo-code');
Route::post('/order', 'API\V1\CustomerController@order')->name('order');
Route::post('/points', 'API\V1\CustomerController@point')->name('points');
Route::post('/my-orders', 'API\V1\CustomerController@myOrder')->name('my-orders');
Route::get('/order-status/{orderId}', 'API\V1\CustomerController@customerOrderDetails')->name('order-status');


Route::post('/restaurant-order-list', 'API\V1\RestaurantController@restaurantOrderList')->name('restaurant-order-list');



//RIDER
Route::post('/rider-otp-verify', 'API\V1\RiderController@otpVerify')->name('rider-otp-verify');
Route::post('/rider-document', 'API\V1\RiderController@documentUpdate')->name('rider-document');
Route::post('/rider-today-order', 'API\V1\RiderController@riderTodayOrder')->name('rider-today-order');
Route::post('/rider-order-history', 'API\V1\RiderController@index')->name('rider-order-history');
Route::post('/rider-profile-update', 'API\V1\RiderController@riderProfileUpdate')->name('rider-profile-update');
Route::post('/rider-settings', 'API\V1\RiderController@settingsUpdate')->name('rider-settings');


//RESTAURANT
Route::post('/restaurant-otp-verify', 'API\V1\RestaurantController@otpVerify')->name('restaurant-otp-verify');
Route::post('/restaurant-document', 'API\V1\RestaurantController@documentUpdate')->name('restaurant-document');
Route::post('/restaurant-today-order', 'API\V1\RestaurantController@restaurantTodayOrder')->name('restaurant-today-order');
Route::post('/restaurant-order-accept', 'API\V1\RestaurantController@orderAcceptCancel')->name('restaurant-order-accept');
Route::post('/restaurant-order-history', 'API\V1\RestaurantController@index')->name('restaurant-order-history');
Route::post('/restaurant-profile-update', 'API\V1\RestaurantController@restaurantProfileUpdate')->name('restaurant-profile-update');
Route::post('/restaurant-settings', 'API\V1\RestaurantController@settingsUpdate')->name('restaurant-settings');

##
Route::post('/restaurant-new-category', 'API\V1\RestauranrController@storeCategory')->name('restaurant-new-category');
Route::post('/restaurant-update-category', 'API\V1\RestauranrController@categoryUpdate')->name('restaurant-update-category');
Route::post('/restaurant-delete-category', 'API\V1\RestauranrController@categoryDestroy')->name('restaurant-delete-category');

##
Route::post('/restaurant-new-coupon', 'API\V1\RestauranrController@storeCoupon')->name('restaurant-new-category');
Route::post('/restaurant-update-coupon', 'API\V1\RestauranrController@couponUpdate')->name('restaurant-update-category');
Route::post('/restaurant-delete-coupon', 'API\V1\RestauranrController@couponDestroy')->name('restaurant-delete-category');

##
Route::post('/restaurant-new-location', 'API\V1\RestauranrController@storeLocation')->name('restaurant-new-location');
Route::post('/restaurant-update-location', 'API\V1\RestauranrController@locationUpdate')->name('restaurant-update-location');
Route::post('/restaurant-delete-location', 'API\V1\RestauranrController@locationDestroy')->name('restaurant-delete-location');

##
Route::post('/restaurant-complain', 'API\V1\RestauranrController@storeComplain')->name('restaurant-complain');


//SHOP API ROUTE
Route::get('/shops', 'API\V1\CustomerController@shopList')->name('shops');
Route::get('/shop-items/{shopId}', 'API\V1\CustomerController@shopItemList')->name('shop-items');


Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'], 404);
});
