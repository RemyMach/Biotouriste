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

Route::get('users','UserController@index')->name('users');

Route::post('login','Auth\LoginController@login');

Route::get('login','Auth\LoginController@showLoginForm')->name('login');

Route::post('logout','Auth\LoginController@logout')->name('logout');

Route::get('register','Auth\RegisterController@showRegistrationForm')->name('register');

Route::post('register','Auth\RegisterController@register');

Route::get('password/email','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

Route::get('password/reset','Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

//autre

Route::get('user/{token}','UserController@show');

Route::get('user/update/{user}','UserController@updateProfile');

Route::get('admin/user/{user}','UserController@destroy');

//comment

Route::get('comment','CommentController@create')->name('comment');;

Route::post('comment/store','CommentController@store');

Route::get('comment/announce/{announce}','CommentController@CommentsOfASeller');

Route::get('comment/destroy/{comment}','CommentController@destroy');

Route::get('comment/show','CommentController@showYourPostedComments');

//checks

Route::get('check','CheckController@create');

Route::get('check/status/{check}/{status}','CheckController@updateStatus');

Route::post('check/storeForAnAdmin','CheckController@storeForAnAdmin');

Route::post('check/storeForAController','CheckController@storeForAController');

Route::post('check/showChecksOfAController','CheckController@showChecksOfAController');

Route::post('check/controllerSendACompleteCheck','CheckController@controllerSendACompleteCheck');

Route::post('check/destroy','CheckController@destroy');

Route::get('myMap','AnnounceController@printMap');

//Contact

Route::get('contact','ContactController@create');

Route::post('contact/storeForAnAnonymous','ContactController@storeForAnAnonymous');

Route::post('contact/storeForAnAuthentifiedUser','ContactController@storeForAnAnonymous');


/********************************************** Route pour front test **********************************************/

Route::get('announces','AnnounceController@index');

Route::get('messages','MessageController@index');

Route::get('aide',function(){
    return view('');
});


/********************************************** Route pour front test **********************************************/
