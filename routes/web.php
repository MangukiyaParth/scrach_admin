<?php

use App\Http\Controllers\AdController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
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

// Route::get('testing', function(){return response()->json('working fine new route');});
// dashboard route  
Route::get('/dashboard','AdminController@index')->name('dashboard');

Route::get('/','HomeController@home');

Route::get('/page/{slug}','HomeController@pages');

Route::get('/delete-account', function(){ return view('pages.delete-account'); });
Route::post('submit-delete-account-request', 'CustomerController@submit_delete_account_request');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('/verify/auth/{token}/{enc}', 'Api\UserController@verifyEmail');

Route::get('/test', 'SocialController@test');
Route::group(['middleware' => 'auth'], function(){
	// logout route
	Route::get('/logout', 'Auth\LoginController@logout');
	Route::get('/clear-cache', 'HomeController@clearCache');
	Route::get('/call', 'HomeController@call');
	Route::get('/users', 'CustomerController@index');
	Route::get('/users/delete/{id}', 'CustomerController@destroy');
	Route::get('/users/banned', 'CustomerController@bannedindex');
	Route::post('/users/status', 'CustomerController@status');
	Route::get('/user/get-list/{status}', 'CustomerController@getUserList');
	Route::get('/user-transaction', 'TransactionController@index');
	Route::get('/user/track/{id}', 'TransactionController@usertrack');
	Route::get('/users/invited-users/{refid}','CustomerController@viewInvitedUser');
	Route::get('/users/invited/{refid}', 'CustomerController@getInvitedUser');
	Route::post('/users/update', 'CustomerController@update');
	
	Route::get('/setting/general','SettingController@index');
	Route::get('/setting/landing-page','SettingController@landing_page');
	Route::post('/setting/update', 'SettingController@update');
	Route::get('/setting/ads', 'SettingController@ads');
	Route::get('/setting/spin', 'SettingController@spin');
	Route::get('/setting/app', 'SettingController@app');
	Route::post('/setting/app-setting', 'SettingController@appupdate');
	Route::post('/setting/spinupdate', 'SettingController@spinupdate');
	Route::view('/notification', 'notification');
	Route::post('/notification/send', 'NotificationController@new');
	Route::get('/admin-profile', 'AdminController@admin');
	Route::post('/admin/update', 'AdminController@update');
	Route::post('/verify', 'AdminController@verify');

	//pages
	Route::get('/setting/pages', 'PagesController@index');
	Route::get('/setting/pages/list', 'PagesController@List');
	Route::post('/setting/pages/create', 'PagesController@store');
	Route::post('/setting/pages/action', 'PagesController@action');
	Route::get('/setting/pages/edit/{id}', 'PagesController@edit');
	Route::post('/setting/pages/update', 'PagesController@update');
	Route::get('/setting/pages/delete/{id}', 'PagesController@destroy');
		
	//apps
	Route::get('/apps', 'AppsController@index');
	Route::get('/apps/list', 'AppsController@List');
	Route::get('/apps/create-app', function () { return view('app.create-app'); });
	Route::post('/apps/create', 'AppsController@store');
	Route::get('/apps/edit/{id}', 'AppsController@edit');
	Route::post('/apps/update', 'AppsController@update');
	Route::get('/apps/delete/{id}', 'AppsController@destroy');
	
	//manage admins
	Route::get('/admins', 'AdminController@indexAdmin');
	Route::get('/admins/list', 'AdminController@List');
	Route::post('/admins/create', 'AdminController@store');
	Route::post('/admins/action', 'AdminController@action');
	Route::get('/admins/edit/{id}', 'AdminController@edit');
	Route::post('/admins/update', 'AdminController@updateAdmin');
	Route::get('/admins/delete/{id}', 'AdminController@destroy');
	
});



