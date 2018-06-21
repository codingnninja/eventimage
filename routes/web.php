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

Route::get('/', 'EventImageBuilderController@index')->name('home');
Route::get('/customize','EventImageBuilderController@customize')->name('customize');
Route::post('/processCustomize','EventImageBuilderController@processCustomize')->name('processCustomize');
Route::get('/template', 'EventImageBuilderController@template')->name('template');
Route::post('/processTemplate', 'EventImageBuilderController@processTemplate')->name('processTemplate');
Route::get('/result', 'EventImageBuilderController@result')->name('result');

Route::get('/ext-user/{website}/{ename}/{template}', 'EventImageBuilderController@externerUser')->name('ext-user');

Route::post('/create', 'EventImageBuilderController@create')->name('create');

