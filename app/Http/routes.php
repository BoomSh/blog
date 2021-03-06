<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
// 认证路由...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// 注册路由...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::post('auth/index', 'Admin\UserController@layout');
//验证码
Route::get('auth/verify','Auth\VerifyController@createVerify');


//后台
Route::group(['middleware'=>'auth'],function(){
	Route::get('/admin/index','Admin\IndexController@index');
	Route::get('home', 'Admin\UserController@home');
    Route::get('loginout','Admin\UserController@loginout');
});
