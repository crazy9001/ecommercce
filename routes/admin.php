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

// Route sản phẩm
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

// Route tin tức
Route::group(['prefix' => 'post'], function () {

    Route::get('datatable', 'PostController@dataTable')->name('post.datatable');

    Route::get('move/{id}', 'PostController@move')->name('post.move');

    Route::post('update_field/{id}', 'PostController@updateField')->name('post.update_field');

    Route::group(['prefix' => 'category'], function () {
        Route::match(['get', 'post'], 'sort', 'PostCategoryController@sort')->name('post.category.sort');
    });

    Route::resource('category', 'PostCategoryController', ['as' => 'post']);

    Route::get('video/datatable', 'PostVideoController@dataTable')->name('post.video.datatable');
    Route::resource('video', 'PostVideoController', ['as' => 'post']);

});
Route::resource('post', 'PostController');


// Route page
Route::get('page/datatable', 'PageController@dataTable')->name('page.datatable');
Route::resource('page', 'PageController');


// Route setting
Route::prefix('setting')->namespace('Setting')->group(function () {

    Route::resource('general', 'SettingController', ['as' => 'setting']);

    Route::resource('seo', 'SEOController', ['as' => 'setting', 'only' => ['index']]);

    Route::get('sitemap/generate', 'SitemapController@generate')->name('setting.sitemap.generate');

    Route::resource('sitemap', 'SitemapController', ['as' => 'setting']);

});

// Route menu
Route::post('menu/sort', 'MenuController@sort')->name('menu.sort');
Route::resource('menu', 'MenuController');

// Route order cart
Route::group(['prefix' => 'order'], function () {

    Route::get('datatable', 'OrderController@dataTable')->name('order.datatable');

});
Route::resource('order', 'OrderController');


// Route contact
Route::get('contact/datatable', 'ContactController@dataTable')->name('contact.datatable');

Route::resource('contact', 'ContactController');

//Route user
Route::get('user/datatable', 'UserController@dataTable')->name('user.datatable');
Route::resource('user', 'UserController');