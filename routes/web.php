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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login','UserController@showLoginForm')->name('login');
Route::post('/login','UserController@login')->name('login.submit');

Route::get('/register','UserController@register')->name('register');
Route::post('/register','UserController@registerPost')->name('register.post');

Route::post('/upload','UserController@upload')->name('upload');

Route::put('/edit','Auth\HomeController@edit')->name('edit');

Route::delete('/delete'.'Auth\HomeController@edit')->name('delete');
