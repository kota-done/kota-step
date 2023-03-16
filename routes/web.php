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
    // ログイン画面のページに飛べる。
    Route::get('/', 'Auth\MainController@showLogin')->name('showLogin');

    // ログイン処理
    Route::post('login', 'Auth\MainController@login')->name('login');
});

// ユーザーログイン後しかアクセスできない。
Route::group(['middleware' => ['auth']], function () {

    // ログイン後の商品ページに飛ぶ
    Route::get('home','SubController@home')->name('home');
    // ログアウト機能
    Route::post('logout', 'Auth\MainController@logout')->name('logout');
});
// ユーザー新規登録画面にジャンプ
Route::get('login/user_set', 'Auth\MainController@inputLogin')->name('inputLogin');
// ユーザー新規登録
Route::post('login/store', 'Auth\MainController@exeStore')->name('store');





// 商品一覧

// 商品新規登録の表示
Route::get('/goods','SubController@create')->name('create');
// 商品の新規登録
Route::post('/goods','SubController@subStore')->name('sub.store');