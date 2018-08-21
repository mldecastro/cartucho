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

Route::get('/', ['as' => 'site', 'uses' => 'SiteController@index']);
Route::post('', ['as' => 'contact.send', 'uses' => 'SiteController@postContact']);

Route::get('/admin', 'Admin\AdminController@index')->name('dashboard');
Route::get('/admin/help', 'Admin\AdminController@help')->name('help');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('services/deleted', ['as' => 'services.deleted', 'uses' => 'Admin\ServiceController@deleted']);
    Route::put('services/{service}/recovery', ['as' => 'services.recovery', 'uses' => 'Admin\ServiceController@recovery']);
    Route::resource('services', 'Admin\ServiceController');

    Route::get('categories/{category}/products', ['as' => 'categories.products', 'uses' => 'Admin\CategoryController@showProducts']);
    Route::get('categories/deleted', ['as' => 'categories.deleted', 'uses' => 'Admin\CategoryController@deleted']);
    Route::put('categories/{category}/recovery', ['as' => 'categories.recovery', 'uses' => 'Admin\CategoryController@recovery']);
    Route::resource('categories', 'Admin\CategoryController');

    Route::get('products/deleted', ['as' => 'products.deleted', 'uses' => 'Admin\ProductController@deleted']);
    Route::put('products/{product}/recovery', ['as' => 'products.recovery', 'uses' => 'Admin\ProductController@recovery']);
    Route::resource('products', 'Admin\ProductController');

    Route::get('partners/deleted', ['as' => 'partners.deleted', 'uses' => 'Admin\PartnerController@deleted']);
    Route::put('partners/{partner}/recovery', ['as' => 'partners.recovery', 'uses' => 'Admin\PartnerController@recovery']);
    Route::resource('partners', 'Admin\PartnerController');
});

Route::post('/send', 'EmailController@send')->name('send');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
