<?php 
//后台登录
Route::get('admin/login','Admin\LoginController@index');

Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>'adminLogin'],function(){
	
	Route::get('/','IndexController@index');
});