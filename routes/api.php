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
Route::post('restaurant-list', 'API\V1\CustomerController@restaurantList')->name('restaurant-list');

Route::post('promotional-restaurants', 'API\V1\CustomerController@promotionalRestaurants')->name('restaurant-list');



Route::post('text-search', 'API\V1\CustomerController@searchBytext')->name('text-search');
Route::get('filter-options', 'API\V1\CustomerController@filterOptions')->name('filter-options');
Route::post('search-by-filter-option', 'API\V1\CustomerController@searchByFilterOptions')->name('search-by-filter-option');
Route::post('checkout-option', 'API\V1\CustomerController@checkoutOption')->name('checkout-option');
Route::post('review', 'API\V1\CustomerController@restaurantReview')->name('review');



Route::post('restaurant-panel', 'API\V1\CustomerController@restaurantPanel')->name('restaurant-panel');
Route::post('add-more-item', 'API\V1\CustomerController@addMoreItem')->name('add-more-item');

Route::post('food-variants', 'API\V1\CustomerController@foodVariants')->name('food-variants');

Route::post('filter', 'API\V1\CustomerController@filter')->name('filter');

Route::post('/items', 'API\V1\CustomerController@itemList')->name('items');
Route::post('/my-location-save', 'API\V1\CustomerController@myLocationSave')->name('my-location-save');
Route::post('/my-location-update', 'API\V1\CustomerController@myLocationUpdate')->name('my-location-update');
Route::post('/my-location-delete', 'API\V1\CustomerController@myLocationDelete')->name('my-location-delete');
Route::post('/my-locations', 'API\V1\CustomerController@myLocation')->name('my-locations');
Route::post('/selected-location', 'API\V1\CustomerController@customerSelectedLocation')->name('selected-location');
Route::post('/customer-profile', 'API\V1\CustomerController@myProfile')->name('customer-profile');
Route::post('/customer-profile-update', 'API\V1\CustomerController@customerProfileUpdate')->name('customer-profile-update');

Route::post('/save-favorite-food', 'API\V1\CustomerController@saveOrUpdateFavoriteFood')->name('save-favorite-food');
Route::post('/remove-favorite-food', 'API\V1\CustomerController@removeFavoriteFood')->name('remove-favorite-food');

Route::post('/save-favorite-restaurant', 'API\V1\CustomerController@saveOrUpdateFavoriteRestaurant')->name('save-favorite-restaurant');
Route::post('/remove-favorite-restaurant', 'API\V1\CustomerController@removeFavoriteRestaurant')->name('remove-favorite-restaurant');

Route::post('/remove-from-favorite-restaurant', 'API\V1\CustomerController@removeFromFavoriteRestaurant')->name('remove-from-favorite-restaurant');
Route::post('/remove-from-favorite-food', 'API\V1\CustomerController@removeFromFavoriteFood')->name('remove-from-favorite-food');
Route::post('/remove-restaurant-from-search', 'API\V1\CustomerController@removeFromSearch')->name('remove-restaurant-from-search');
Route::post('/save-restaurant-from-search', 'API\V1\CustomerController@saveFavoriteFromSearch')->name('save-restaurant-from-search');

Route::post('/my-favorite-foods', 'API\V1\CustomerController@myFavoriteFood')->name('my-favorite-foods');

Route::post('/settings', 'API\V1\CustomerController@settings')->name('settings');
Route::post('/customer-settings', 'API\V1\CustomerController@settingsUpdate')->name('customer-settings');

Route::post('/promo-code', 'API\V1\CustomerController@applyPromoCode')->name('promo-code');
Route::post('/order', 'API\V1\CustomerController@order')->name('order');
Route::post('/points', 'API\V1\CustomerController@point')->name('points');
Route::post('/my-orders', 'API\V1\CustomerController@myOrder')->name('my-orders');
Route::get('/order-status/{orderId}', 'API\V1\CustomerController@customerOrderDetails')->name('order-status');
Route::get('/customer-help-and-support', 'API\V1\CustomerController@helpAndSupport')->name('customer-help-and-support');
Route::get('/customer-terms-and-condition', 'API\V1\CustomerController@termsAndCondition')->name('customer-terms-and-condition');

Route::post('/restaurant-details', 'API\V1\CustomerController@restaurantDetails')->name('restaurant-details');


Route::post('/customer-delivery-save', 'API\V1\CustomerController@myDeliverySave')->name('customer-delivery-save');
Route::post('/customer-delivery-list', 'API\V1\CustomerController@myDeliveryList')->name('customer-delivery');



Route::post('/restaurant-order-list', 'API\V1\RestaurantController@restaurantOrderList')->name('restaurant-order-list');



//RIDER
Route::post('/rider-otp-verify', 'API\V1\RiderController@otpVerify')->name('rider-otp-verify');
Route::post('/rider-document', 'API\V1\RiderController@documentUpdate')->name('rider-document');
Route::post('/rider-location-save', 'API\V1\RiderController@riderLocationSave')->name('rider-location-save');
Route::post('/rider-location-update', 'API\V1\RiderController@riderLocationUpdate')->name('rider-location-update');
Route::post('/rider-location-delete', 'API\V1\RiderController@riderLocationDelete')->name('rider-location-delete');
Route::post('/rider-locations', 'API\V1\RiderController@riderLocation')->name('rider-locations');
Route::post('/rider-selected-location', 'API\V1\RiderController@riderSelectedLocation')->name('rider-selected-location');
Route::post('/rider-order-detail', 'API\V1\RiderController@orderDetail')->name('rider-order-detail');
Route::post('/rider-order-status', 'API\V1\RiderController@orderStatus')->name('rider-order-status');
Route::post('/rider-order-list', 'API\V1\RiderController@orderList')->name('rider-order-list');
Route::post('/rider-order-history', 'API\V1\RiderController@orderHistory')->name('rider-order-history');
Route::post('/rider-profile-update', 'API\V1\RiderController@riderProfileUpdate')->name('rider-profile-update');
Route::post('/rider-settings', 'API\V1\RiderController@settingsUpdate')->name('rider-settings');
Route::post('/rider-device-token', 'API\V1\RiderController@saveDeviceToken')->name('rider-device-token');
Route::get('/rider-help-and-support', 'API\V1\RiderController@helpAndSupport')->name('rider-help-and-support');
Route::get('/rider-terms-and-condition', 'API\V1\RiderController@termsAndCondition')->name('rider-terms-and-condition');


//RESTAURANT
Route::post('/restaurant-otp-verify', 'API\V1\RestaurantController@otpVerify')->name('restaurant-otp-verify');
Route::post('/restaurant-document', 'API\V1\RestaurantController@documentUpdate')->name('restaurant-document');
Route::post('/restaurant-today-order', 'API\V1\RestaurantController@restaurantTodayOrder')->name('restaurant-today-order');
Route::post('/restaurant-order-details', 'API\V1\RestaurantController@orderDetails')->name('restaurant-order-details');
Route::post('/restaurant-order-accept', 'API\V1\RestaurantController@orderAccept')->name('restaurant-order-accept');
Route::post('/restaurant-order-cancel', 'API\V1\RestaurantController@orderCancel')->name('restaurant-order-cancel');
Route::post('/restaurant-order-ready', 'API\V1\RestaurantController@orderReady')->name('restaurant-order-ready');
Route::post('/restaurant-order-history', 'API\V1\RestaurantController@index')->name('restaurant-order-history');
Route::post('/restaurant-profile-update', 'API\V1\RestaurantController@restaurantProfileUpdate')->name('restaurant-profile-update');
Route::post('/restaurant-settings', 'API\V1\RestaurantController@settingsUpdate')->name('restaurant-settings');
Route::post('/restaurant-device-token', 'API\V1\RestaurantController@saveDeviceToken')->name('restaurant-device-token');
Route::get('/restaurant-help-and-support', 'API\V1\RestaurantController@helpAndSupport')->name('restaurant-help-and-support');
Route::get('/restaurant-terms-and-condition', 'API\V1\RestaurantController@termsAndCondition')->name('restaurant-terms-and-condition');
Route::post('/restaurant-delivery-management', 'API\V1\RestaurantController@deliveryManagement')->name('restaurant-delivery-management');


##
Route::post('/restaurant-new-category', 'API\V1\RestaurantController@storeCategory')->name('restaurant-new-category');
Route::post('/restaurant-update-category', 'API\V1\RestaurantController@categoryUpdate')->name('restaurant-update-category');
Route::post('/restaurant-delete-category', 'API\V1\RestaurantController@categoryDestroy')->name('restaurant-delete-category');

##
Route::post('/restaurant-new-coupon', 'API\V1\RestaurantController@storeCoupon')->name('restaurant-new-category');
Route::post('/restaurant-update-coupon', 'API\V1\RestaurantController@couponUpdate')->name('restaurant-update-category');
Route::post('/restaurant-delete-coupon', 'API\V1\RestaurantController@couponDestroy')->name('restaurant-delete-category');

##
Route::post('/restaurant-location-save', 'API\V1\RestaurantController@restaurantLocationSave')->name('restaurant-location-save');
Route::post('/restaurant-location-update', 'API\V1\RestaurantController@restaurantLocationUpdate')->name('restaurant-location-update');
Route::post('/restaurant-location-delete', 'API\V1\RestaurantController@restaurantLocationDelete')->name('restaurant-location-delete');
Route::post('/restaurant-locations', 'API\V1\RestaurantController@restaurantLocation')->name('restaurant-locations');
Route::post('/restaurant-selected-location', 'API\V1\RestaurantController@restaurantSelectedLocation')->name('restaurant-selected-location');



##
Route::post('/restaurant-complain', 'API\V1\RestaurantController@storeComplain')->name('restaurant-complain');


//SHOP API ROUTE
Route::get('/shops', 'API\V1\CustomerController@shopList')->name('shops');
Route::post('/shop-items', 'API\V1\CustomerController@shopItemList')->name('shop-items');


Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'], 404);
});
