<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes(['verify' => true]);

Route::middleware(['is_admin'])->group(function () {
    Route::get('/home', 'HomeController@index');

    Route::resource('categories', 'CategoryController');

    Route::resource('brands', 'BrandController');

    Route::resource('coupons', 'CouponController');

    Route::resource('unique_coupon_users', 'UniqueCouponUserController');
});