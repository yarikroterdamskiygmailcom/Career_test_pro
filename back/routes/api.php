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

//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group([
    'namespace' => 'API'], function () {
    Route::post('register', 'RegisterController@register');
    Route::post('login', 'RegisterController@login');

    Route::post('sendmail', 'EmailsController@contactUsEmail');
    Route::get('pdflink', 'EmailsController@pdfLinkEmail')->name('send-pdf');


    Route::get('languages', 'LanguagesController@index');
    Route::get('questions', 'QuestionsController@index');
    Route::get('price', 'PriceController@index');
    Route::get('logo', 'LogoController@index');
    Route::get('tester', 'TestController@index');

    Route::post('post/{id}', 'PdfController@pdfCr')->middleware('resultkey');
    Route::get('pdf/{id}', 'PdfController@pdf')->middleware('resultkey');
    Route::get('diagrams/{id_unicum}', 'PdfController@diagrams')->middleware('resultkey');

});


Route::group([
    'namespace' => 'API',
    'middleware' => 'auth:api'], function () {

    Route::post('logout', 'RegisterController@logout');

    //Admin dashboard

    Route::get('users', 'UsersController@index');
    Route::post('price', 'PriceController@update');
    Route::post('logo', 'LogoController@update');

    Route::get('getuser', 'UsersController@getUser');



    Route::resources([
        'settings' => 'SettingsController',
        'categories' => 'CategoriesController'
    ]);
});

Route::group([
    'namespace' => 'API',
    'middleware' => 'api',
    'prefix' => 'password'
], function () {
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});

