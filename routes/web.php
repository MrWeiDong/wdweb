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

require 'home.php';


//后台登录
Route::get('admin/login','Admin\LoginController@index');

Route::group(['namespace'=>'Admin','prefix'=>'admin'],function(){
	
	Route::get('/','IndexController@index');
	
	Route::get('meun','MeunController@index');
	
	Route::match(['get','post'],'meun/add','MeunController@edit');
});