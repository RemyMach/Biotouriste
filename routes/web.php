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

//Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::get('users','API\UserController@index')->name('users');

Route::post('login','Auth\LoginController@login');

Route::get('login','Auth\LoginController@showLoginForm')->name('login');

Route::post('logout','Auth\LoginController@logout')->name('logout');

Route::get('register','Auth\RegisterController@showRegistrationForm')->name('register');

Route::post('register','Auth\RegisterController@register');

Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

Route::get('password/reset/{token}','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');

Route::post('password/reset','Auth\ResetPasswordController@reset')->name('password.update');

Route::post('password/email','Auth\ResetPasswordController@reset')->name('password.email');

Route::get('myMap','AnnounceController@printMap');

