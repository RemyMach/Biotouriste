<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//list users
Route::get('user/users','API\UserController@index');

Route::post('user/show','API\UserController@show');

Route::post('user/store','API\RegisterController@store');

Route::post('user/login','API\LoginController@login');

Route::get('user/delete','API\UserController@destroy');

Route::post('user/email','API\ForgotPasswordController@sendResetLinkEmail');

Route::post('user/showResetForm','API\ResetPasswordController@showResetForm');

Route::post('user/reset','API\ResetPasswordController@reset');

//comment
Route::post('comment/store','API\CommentController@store');

Route::post('comment/seller','API\CommentController@CommentsOfASeller');

Route::post('comment/destroy','API\CommentController@destroy');

Route::post('comment/showYourPostedComments','API\CommentController@showYourPostedComments');

//Check

Route::post('check/store','API\CheckController@store');

Route::post('check/UpdateStatusVerification','API\CheckController@UpdateStatusVerification');

Route::post('check/controllerSendACompleteCheck','API\CheckController@controllerSendACompleteCheck');

Route::post('check/showChecksOfAController','API\CheckController@showChecksOfAController');

Route::post('check/destroy','API\CheckController@destroy');

//Contact

Route::post('contact/store','API\ContactController@store');

Route::post('contact/ContactsWithAssociedUsers','API\ContactController@ContactsWithAssociedUsers');

Route::post('contact/destroy','API\ContactController@destroy');

Route::post('contact/ContactsOfAUser','API\ContactController@ContactsOfAUser');

//Discount_code

Route::post('discount_code/store','API\Discount_CodeController@store');

Route::post('discount_code/isUseFalseToTrue','API\Discount_CodeController@isUseFalseToTrue');

Route::post('discount_code/checkDiscountCodeIsValid','API\Discount_CodeController@checkDiscountCodeIsValid');

Route::post('discount_code/showDiscountCodeOfAUser','API\Discount_CodeController@showDiscountCodeOfAUser');



/*Route::get('/users', function () {
    return UserResource::collection(User::paginate(2));
});*/

// list single User
