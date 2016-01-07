<?php

Route::get('/','Home\HomeController@index');
Route::get('message_info/{id}','Home\HomeController@message_info');				//帖子内容
Route::get('Profile/{id}','Home\ProfileController@index');						//个人中心
Route::get('feedback','Home\FeedBackController@index');							//用户反馈
Route::post('feed','Home\FeedBackController@feed');

//登录
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//个人中心
Route::group(['prefix' => 'user','namespace' => 'User','middleware' => 'auth'],function(){
	Route::get('message','MessageController@index');
	Route::post('create_message','MessageController@create_message');				//评论
	Route::post('comments','MessageController@comments');							//个人设置
	Route::get('settings','SettingController@index');
	Route::post('update','SettingController@update');
	Route::post('upfile','SettingController@upfile');								//头像上传
	Route::get('me','MessageController@me');										//帖子动态
});

//后台管理
Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => 'auth'],function(){
	Route::get('/','AdminController@index');										//后台
	Route::get('admin_info','AdminController@admin_info');							//管理员账号密码修改
	Route::post('update_admin','AdminController@update_admin');						//更新账户
	Route::get('feedback','AdminController@feedback');								//反馈
	Route::get('feedback_info/{id}','AdminController@feedback_info');
	Route::get('users','AdminController@users');									//用户
	Route::get('messages','AdminController@messages');								//帖子
	Route::get('del_message/{id}','AdminController@del_message');
	Route::get('category','AdminController@category');								//分类
	Route::get('category_edit/{id}','AdminController@category_edit');				//编辑
	Route::get('category_update','AdminController@category_update');				//更新
	Route::get('category_add/{name}/{color}','AdminController@category_add');		//添加
	Route::get('logout','AdminController@logout');									//退出登录
});
Route::get('/{id}','Home\HomeController@index');									//分类
