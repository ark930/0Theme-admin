<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::get('/home', 'HomeController@index');
//Route::post('/home', 'HomeController@login');

Route::get('/', 'UserController@index');
Route::post('/login', 'UserController@login');
Route::get('/logout', 'UserController@logout');

Route::get('/dashboard', 'AdminController@dashboard');
Route::get('/themes', 'AdminController@themes');
Route::get('/users', 'AdminController@users');
Route::get('/finance', 'AdminController@finance');
Route::get('/settings', 'AdminController@settings');

Route::get('/user/{id}', 'AdminController@userDetails')->where('id', '[0-9]+');
Route::get('/theme/new', 'AdminController@newTheme');
Route::get('/theme/new/{id}', 'AdminController@updateTheme')->where('id', '[0-9]+');
Route::post('/theme/new', 'AdminController@newThemeUpload');
Route::patch('/theme/new/{id}', 'AdminController@upgradeThemeUpload')->where('id', '[0-9]+');

Route::get('/user_info', 'AdminController@userInfo');
