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
// ユーザーログイン前のみ
Route::group(['middleware' => ['guest']], function () {
    // showLoginで下のページに飛べる。
    Route::get('/','Auth\MainController@showLogin')->name('showLogin');

    // ログイン処理
    Route::post('login','Auth\MainController@login')->name('login');
   
});
// ユーザー新規登録画面にジャンプ
Route::get('/','Auth\MainController@inputLogin')->name('inputLogin');


// ユーザーログイン後しかアクセスできない。
Route::group(['middleware' => ['auth']], function () {

// ログイン後の商品ページに飛ぶ
    Route::get('home',function(){
        return view('home');
    })->name('home');
});