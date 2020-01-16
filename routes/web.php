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

Route::post('password/reset','Auth\ResetPasswordController@reset')->name('password.update');

Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

//autre

Route::get('user/{token}','UserController@show');

Route::get('user/update/{user}','UserController@updateProfile');

Route::get('admin/user/{user}','UserController@destroy');

//comment

Route::get('comment','CommentController@create');

Route::post('comment/store','CommentController@store');

Route::get('comment/announce/{announce}','CommentController@CommentsOfASeller');

Route::get('comment/destroy/{comment}','CommentController@destroy');

Route::get('comment/show','CommentController@showYourPostedComments');

//checks

Route::get('check','CheckController@create');

Route::post('check/store','CheckController@store');

Route::get('myMap','AnnounceController@printMap');

Route::post('password/email','Auth\ResetPasswordController@reset')->name('password.email');


/********************************************** Route pour front test **********************************************/

Route::get('announces','AnnounceController@index');

Route::get('messages','MessageController@index');

Route::get('aide',function(){
    return view('');
});

Route::get('contact','ContactController@index');




/********************************************** Route pour front test **********************************************/


/********************************************** Route Anthony pour test stripe **********************************************/
Route::post('addmoney/stripe', array('as' => 'addmoney.stripe','uses' => 'StripeController@tokenPaymentStripe'));
Route::get('pay', function (){
    return view('Payment');
});
Route::post('payment/store','PaymentController@store');
Route::get('allpay',function (){
   return view('test');
});