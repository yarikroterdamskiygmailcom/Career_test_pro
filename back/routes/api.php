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
    Route::get('scoretext', 'ReportController@scoreText');
    Route::get('testcode-use', 'TestcodesController@use');
    Route::get('site-blocks', 'SiteController@siteBlocks');


    Route::post('post/{id}', 'PdfController@pdfCr')->middleware('resultkey');
    Route::get('pdf/{id}', 'PdfController@pdf')->middleware('resultkey');
    Route::get('diagrams/{id_unicum}', 'PdfController@diagrams')->middleware('resultkey');
    Route::get('posts-categories', 'PostsCategoriesController@index');
    Route::get('posts', 'PostsController@index');
    Route::get('posts/{id}', 'PostsController@getPost');
    Route::post('posts-filter', 'PostsController@searching');
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

    Route::post('questions/{id}', 'QuestionsController@update');
    Route::post('scoretext/{id}', 'ReportController@scoreTextUpdate');

    Route::get('report-blocks', 'ReportController@reportBlocks');
    Route::get('letter-block', 'ReportController@letterBlock');
    Route::post('report-blocks/{id}', 'ReportController@reportBlocksUpdate');

    Route::get('testcode', 'TestcodesController@index');

    Route::post('testcode-generate', 'TestcodesController@store');
    Route::post('add-language', 'LanguagesController@store');


    Route::post('site-blocks/{id}', 'SiteController@siteBlocksUpdate');
    Route::get('export-csv/{id}', 'LanguagesController@exportCSV');
    Route::post('import-csv/{id}', 'LanguagesController@importCSV');
    Route::get('invoices', 'InvoicesController@getInvoices');
    Route::post('posts', 'PostsController@store');
    Route::put('posts/{id}', 'PostsController@update');
    Route::delete('posts/{id}', 'PostsController@destroy');


    //Route::put('posts-categories/{id}', 'PostsCategoriesController@update');
    //Route::post('posts-categories', 'LanguagesController@store');
   // Route::delete('posts-categories/{id}', 'PostsCategoriesController@destroy');

    Route::resources([
        'settings' => 'SettingsController',
        'categories' => 'CategoriesController',
        'careers' => 'CareersController',

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

