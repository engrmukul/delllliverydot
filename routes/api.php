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

Route::post('register', 'restaurant\API\V1\RegisterController@register');
Route::post('login', 'restaurant\API\V1\RegisterController@login');
   
Route::middleware('auth:api')->group( function () {
    Route::resource('products', 'API\ProductController');
});



Route::fallback(function() {
    return 'Hm, why did you land here somehow?';
});
