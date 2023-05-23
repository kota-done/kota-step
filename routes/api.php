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

// 商品の値段の上限・下限での絞り込み
Route::post('/sale_price','SalesController@showPrice')->name('sale_price');

// 商品の在庫数での絞り込み
Route::post('/sale_stock','SalesController@showStock')->name('sale_stock');

// 削除機能の実装
Route::post('/goods/delete','SalesController@exeDelete')->name('delete');