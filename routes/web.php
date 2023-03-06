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
// showLoginで下のページに飛べる。
Route::get('/','Auth\MainController@showLogin')->name('showLogin');

// ログイン
Route::post('login','Auth\MainController@showLogin')->name('login');

