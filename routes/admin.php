<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::match(['get', 'post'], '/', 'HomeController@dashboard')->name('admin');

Route::match(['get', 'post'], 'profile', 'HomeController@profile')->name('admin.profile');

Route::group(['prefix' => 'product'], function () {

    Route::get('datatable', 'ProductController@dataTable')->name('product.datatable');

    Route::get('move/{id}', 'ProductController@move')->name('product.move');

    Route::post('update_field/{id}', 'ProductController@updateField')->name('product.update_field');

    Route::group(['prefix' => 'category'], function () {

        Route::match(['get', 'post'], 'sort', 'ProductCategoryController@sort')->name('product.category.sort');

    });

    Route::resource('category', 'ProductCategoryController', ['as' => 'product']);

});
Route::resource('product', 'ProductController');


Route::group(['prefix' => 'post'], function () {

    Route::group(['prefix' => 'category'], function () {
        Route::match(['get', 'post'], 'sort', 'PostCategoryController@sort')->name('post.category.sort');
    });

});