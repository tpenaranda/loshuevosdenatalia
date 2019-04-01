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

Route::apiResource('skus', 'API\SkuController', ['only' => 'index']);

Route::middleware('throttle:10,1')->group(function () {
    Route::apiResource('orders', 'API\OrderController', ['only' => 'store']);
});
