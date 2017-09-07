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

Route::post('yuyue/add', 'YuyueController@add');

Route::get('juyan/index', 'JuyanController@index');

Route::get('juyan/intro', 'JuyanController@intro');

Route::get('juyan/dian', 'JuyanController@dian');

Route::get('juyan/service', 'JuyanController@service');

Route::get('juyan/detail/{id}', 'JuyanController@detail');

Route::get('juyan/teacher/{id}', 'JuyanController@teacher');
