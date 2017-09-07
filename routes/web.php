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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/welcome', function(){
    return view('welcome');
});

// 管理员
//Route::get('user/index', 'UserController@index');
//Route::any('user/add', 'UserController@add');
//Route::gany('user/edit/{id}', 'UserController@edit');
//Route::get('user/delete/{id}', 'UserController@delete');


Route::get('banner/index', 'BannerController@index');
Route::any('banner/add', 'BannerController@add');
Route::any('banner/edit/{id}', 'BannerController@edit');
Route::any('banner/delete/{id}', 'BannerController@delete');

// 图片栏目
Route::get('cate/index', 'CateController@index');
Route::any('cate/add', 'CateController@add');
Route::any('cate/edit/{id}', 'CateController@edit');
Route::any('cate/delete/{id}', 'CateController@delete');

// 技师列表
Route::get('teacher/index', 'TeacherController@index');
Route::any('teacher/add', 'TeacherController@add');
Route::any('teacher/edit/{id}', 'TeacherController@edit');
Route::get('teacher/delete/{id}', 'TeacherController@delete');

// 服务项目
Route::get('service/index', 'ServiceController@index');
Route::any('service/add', 'ServiceController@add');
Route::any('service/edit/{id}', 'ServiceController@edit');
Route::get('service/delete/{id}', 'ServiceController@delete');

// 分店展示
Route::get('dian/index', 'DianController@index');
Route::any('dian/add', 'DianController@add');
Route::any('dian/edit/{id}', 'DianController@edit');
Route::get('dian/delete/{id}', 'DianController@delete');

// 预约管理
Route::get('yuyue/index', 'YuyueController@index');
Route::get('yuyue/add', 'YuyueController@add');
Route::get('yuyue/edit', 'YuyueController@edit');
Route::get('yuyue/delete', 'YuyueController@delete');

//系统设置
Route::any('system/index', 'SystemController@index');
Route::any('system/xiangmu','SystemController@xiangmu');

Route::get('tousu/index', 'TousuController@index');
Route::any('tousu/edit', 'TousuController@edit');
Route::get('tousu/delete/{id}', 'TousuController@delete');

