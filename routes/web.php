<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', 'PageController@catalog')->name('catalog.index');
Route::get('/products', 'CatalogController@index')->name('products.index');
