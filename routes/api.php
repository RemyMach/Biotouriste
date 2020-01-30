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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

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

//Favoris

Route::post('favori/showFavorisOfAUser','API\FavoriController@showFavorisOfAUser');

Route::post('favori/store','API\FavoriController@store');

Route::post('favori/destroy','API\FavoriController@destroy');

//Messages

Route::post('message/store','API\MessageController@store');

Route::post('message/showMessagesOfATouristController','API\MessageController@showMessagesOfATouristController');

Route::post('message/showMessagesOfASeller','API\MessageController@showMessagesOfASeller');

//Report

Route::post('report/store','API\ReportController@store');

Route::post('report/show/showAllMyReports','API\ReportController@showAllMyReports');

Route::post('report/show/admin','API\ReportController@showAllReportsForAdmin');


//User_Status_CorrespondenceController

Route::post('user_status/change','API\User_Status_CorrespondenceController@ChangeDefaultUserStatus');

Route::post('user_status/addStatus','API\User_Status_CorrespondenceController@addUserStatusTouristOrSeller');

Route::post('user_status/addStatusAdminController','API\User_Status_CorrespondenceController@addUserStatusAdminOrController');

//Seller

Route::post('seller/updateBio','API\SellerController@updateReverseBioStatus');

Route::post('seller/updateDescription','API\SellerController@updateSellerDescription');

Route::post('seller/testSelect','API\SellerController@SelectSellersByCommentsNotes');


// Announce

Route::post('filterByCategorie','API\AnnounceController@selectByCategorie');

Route::post('filterByCity','API\AnnounceController@selectByCity');

Route::post('announce/store','API\AnnounceController@store');

<<<<<<< HEAD
//Payment and stripe
=======
Route::post('announce/delete','API\AnnounceController@delete');

Route::post('announce/update','API\AnnounceController@update');

Route::post('announce/historySeller','API\AnnounceController@selectHistorySeller');

>>>>>>> views/homepage

Route::post('payment/stripe','API\PaymentController@getidforcard');

Route::post('payment/showUserPayment','API\PaymentController@showUserPayment');

/*Route::get('/users', function () {
    return UserResource::collection(User::paginate(2));
});*/

// list single User
