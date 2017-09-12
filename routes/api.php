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

Route::post('tousu/add', 'TousuController@add');
Route::get('juyan/tousu', 'JuyanController@tousu');
Route::get('juyan/tousuMsg', 'JuyanController@tousuMsg');

Route::any('yuyue/add', 'YuyueController@add');

Route::get('juyan/index', 'JuyanController@index');

Route::get('juyan/intro', 'JuyanController@intro');

Route::get('juyan/dian', 'JuyanController@dian');

Route::get('juyan/service', 'JuyanController@service');

Route::get('juyan/detail/{id}', 'JuyanController@detail');

Route::get('juyan/teacher/{id}', 'JuyanController@teacher');

Route::any('juyan/getMoney', 'JuyanController@getMoney');

// 预约成功
Route::any('juyan/yuyue/{id}', 'JuyanController@yuyue');

// 获取时间接口
Route::post('juyan/getTime', 'JuyanController@getTime');

// 获取openid
Route::any('juyan/getOpenid', 'JuyanController@getOpenid');

// 支付
Route::any('juyan/getpayid', 'JuyanController@getpayid');

Route::any('juyan/getMsg', 'JuyanController@getMsg');
