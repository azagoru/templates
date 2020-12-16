<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController')->name('home');

Route::resource('items', 'ItemController')->only('index');
Route::resource('templates', 'TemplateController')->except('edit', 'show', 'create');

Route::post('/templates/items', 'TemplateController@items')->name('templates.items');
Route::post('/templates/items/update', 'TemplateController@updateItems')->name('templates.items.update');
Route::post('/templates/delete', 'TemplateController@delete')->name('templates.delete');
