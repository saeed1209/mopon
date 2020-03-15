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


Route::post('login','AuthController@login')->name('api.login');
Route::group([
    'middleware' => 'auth:api'
], function() {
    Route::get('logout','AuthController@logout');
    Route::get('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');

    Route::resource('categories', 'CategoryAPIController');

    Route::resource('brands', 'BrandAPIController');

    Route::resource('coupons', 'CouponAPIController');

    Route::resource('unique_coupon_users', 'UniqueCouponUserAPIController');
});

