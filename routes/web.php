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

Route::group(['middleware' => []], function() {
    Route::get('/dashboard', 'AdminController@dashboard');
    Route::get('/themes', 'AdminController@themes');
    Route::get('/users', 'AdminController@users');
    Route::get('/finance', 'AdminController@finance');
    Route::get('/settings', 'AdminController@settings');

    Route::get('/user/{user_id}', 'AdminController@userDetails')->where('user_id', '[0-9]+');

    Route::get('/theme/new', 'AdminController@newTheme');
    Route::get('/theme/new/{theme_id}', 'AdminController@updateTheme')->where('theme_id', '[0-9]+');
    Route::post('/theme/new', 'AdminController@newThemeUpload');
    Route::post('/theme/new/{theme_id}', 'AdminController@upgradeThemeUpload')->where('theme_id', '[0-9]+');

    Route::get('/user_info', 'AdminController@userInfo');
});

