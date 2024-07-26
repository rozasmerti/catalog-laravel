<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/catalog', 'CatalogController@index')->name('catalog.index');
