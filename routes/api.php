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


// // 検索フォーム実行　非同期処理
Route::post('/goods/select','SalesController@showSelect')->name('select');


// 非同期処理による一覧表示
Route::get('/rehome','SalesController@showRehome')->name('rehome');