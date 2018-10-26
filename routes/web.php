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

Auth::routes();


Route::group(['namespace' => 'Frontend', 'middleware' => ['web']], function () {

    Route::prefix('errors')->group(function () {

        Route::get('404', 'ErrorController@error404')->name('error.404');

        Route::get('500', 'ErrorController@error500')->name('error.500');

    });

    Route::get('/', 'IndexController@index')->name('home');

});