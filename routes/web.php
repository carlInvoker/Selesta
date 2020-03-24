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

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

Route::get('/contacts', 'PagesController@contacts');

Route::get('/products', 'ProductsController@index');

Route::get('/catalog', 'ProductsController@showCatalog');

Route::get('/details/{id}', 'ProductsController@showDetails');

Route::get('/searchCategory', 'ProductsController@searchCategory');

Route::get('/searchMain', 'ProductsController@searchMain');

Auth::routes();

Route::prefix('admin')->group(function () {

    Route::get('/', 'AdminController@index')->name('home');

    Route::get('/products', 'ProductsController@getProducts');   // виводить таблицю з усіма продуктами
    Route::post('/addProduct', 'ProductsController@addProduct');  // добавляє продукт
    Route::get('/addProduct', 'ProductsController@addProductForm');  // виводить форму введення продуктів
    Route::get('/addProduct/{id}', 'ProductsController@editProductForm');  // виводить форму едагування продуктів
    Route::post('/changeStatus/{id}', 'ProductsController@changeStatus');  // статус продукта стає 0, тобто продукт неактивний

    Route::get('/sliders', 'SliderController@getSlides');
    Route::post('/addSlide', 'SliderController@addSlide');
    Route::get('/addSlide', 'SliderController@addSlideForm');
    Route::get('/addSlide/{id}', 'SliderController@editSlideForm');
    Route::post('/changeSlidersStatus/{id}', 'SliderController@changeStatus');

});
