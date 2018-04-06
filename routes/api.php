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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group([
	'middleware' => ['throttle:60,1']
], function () {
	Route::post('user', 'Api\AuthController@register')->name('api.user.register');
	Route::post('authorizations', 'Api\AuthController@login')->name('auth.user.login');
	Route::post('{type}/authorizations', 'Api\AuthController@socialLogin');
});

Route::group([
	'middleware' => ['throttle', 'auth:api'],
], function () {
	Route::put('authorizations/current', 'Api\AuthController@refreshToken')->name('api.authorizations.update');
	Route::delete('authorizations', 'Api\AuthController@logout')->name('api.authorizations.logout');
	Route::get('user', 'Api\UserController@me')->name('api.user.show');
	Route::get('users', 'Api\UserController@index')->name('api.user.list');
	Route::put('user', 'Api\UserController@update')->name('api.user.update');
	Route::delete('user', 'Api\UserController@destroy')->name('api.user.destory');
});