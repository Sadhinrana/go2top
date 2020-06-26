<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api.auth'], 'namespace' => 'Api', 'prefix' => 'v1'], function () {
    Route::get('services', 'ApiController@services');
    Route::post('orders', 'ApiController@storeOrder');
    Route::get('orders/status', 'ApiController@orderStatus');
    Route::get('bulk-orders/status', 'ApiController@ordersStatus');
    Route::get('users/balance', 'ApiController@userBalance');
});
