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

Route::get('/', 'ProductController@index')->name('products');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/profile', 'UserController@userProfile')->name('userProfile')->middleware('auth');

Route::get('/add-to-cart/{id}', 'ProductController@addToCart')->name('add_to_cart');

Route::get('/shopping-cart', 'ProductController@getShoppingCart')->name('shopping_cart');

Route::post('/checkout', 'ProductController@sendCheckout')->name('sendCheckout')->middleware('auth');

Route::get('/checkout', 'ProductController@verifyCheckout')->name('verifyCheckout')->middleware('auth');

Route::get('/reduce/{id}', 'ProductController@reduceQty')->name('reduce');

Route::get('/remove/{id}', 'ProductController@removeItem')->name('remove');

Auth::routes();
