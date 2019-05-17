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

use Illuminate\Support\Facades\Route;



Route::get('/','WorkshopController@index')->name('/');
Route::post('/','WorkshopController@store')->name('add-participate');

Route::post('/check-free-seats','WorkshopController@checkFreeSeatsToJson')->name('check_free_seats');
Route::post('/check-participate','WorkshopController@checkParticipateToJson')->name('check_participate');


Route::group(
    [
       'prefix' => 'api/shopify',
       'as' => 'api.shopify.',
       'namespace' => 'Api\Shopify',
    ],
    function () {
        Route::post('/customer/get-all', 'CustomersController@getALL')->name('customer.all');
        Route::post('/customer/find', 'CustomersController@find')->name('customer.find');

    });

