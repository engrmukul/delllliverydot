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
    'shippers' => API\V1\ShipperController::class,
]);

Route::post('/otp-verify', 'API\V1\CustomerController@otpVerify')->name('otp-verify');
Route::post('/my-orders', 'API\V1\OrderController@index')->name('my-orders');




Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'], 404);
});
