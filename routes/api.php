<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    
   Route::post('datas', 'Api\Func@initCr');
   Route::post('update-profile-pass', 'Api\UserController@update_profile_pass');
   Route::post('update-profile', 'Api\UserController@update_profile');    
});
        
Route::get('abouts', 'Api\Func@abouts');
Route::get('config', 'Api\Func@config');
Route::get('configv2', 'Api\Func@configv2');
Route::get('get_lang_data/{lang}', 'Api\Func@get_lang_data');
Route::get('get_lang', 'Api\Func@get_lang');

Route::post('reset-password', 'Api\UserController@reset');
Route::post('verify-otp', 'Api\UserController@verify');
Route::post('update_password', 'Api\UserController@update_password');
Route::post('user', 'Api\UserController@index');
Route::get('send_Verfiyotp/{email}', 'Api\UserController@send_Verfiyotp');

    
    
    