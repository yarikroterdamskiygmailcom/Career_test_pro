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





Route::group([
    'namespace' => 'API'], function () {
    Route::get('paywithpaypal', array('as' => 'addmoney.paywithpaypal','uses' => 'PayPalController@payWithPaypal',));
    Route::get('paypal', array('as' => 'addmoney.paypal','uses' => 'PayPalController@postPaymentWithpaypal',));
    Route::get('paypal/success', array('as' => 'payment.status','uses' => 'PayPalController@getPaymentStatus',));

    Route::get('mollie', 'MollieController@preparePayment');
    Route::get('mollie/status', 'MollieController@status')->name('order.status');
    Route::get('mollie/success', 'MollieController@success')->name('order.success');

    Route::get('braintree', 'BraintreeController@index');
    Route::get('/payment/process', 'BraintreeController@process')->name('payment.process');
    Route::get('/payment/success', 'BraintreeController@success')->name('payment.success');


});
