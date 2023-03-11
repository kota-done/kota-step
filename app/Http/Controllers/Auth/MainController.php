<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// Authの実装
// ログイン後のページの作成
// ミドルウェアの設定

class MainController extends Controller
{
/**
 * ログイン画面を表示
 * @return view
 */
    public function showLogin(){
        return view('login.page');
    }
/** 
 * ログイン画面を表示
 * @return view
 */
    public function inputLogin(){
        return view('login.user_set');
    }
    /**
     * @param App\Http\Requests\LoginFormRequest $repuest
     */
   public function login(LoginFormRequest $request){
    $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // 認証に成功したので、セッションIDを再生成した。
            $request->session()->regenerate();
            // 通ったのでhomeルートでリダイレクトする。合わせて、表示する。 ここのホームは商品画面一覧のメソッド貼らないとだめ。
            return redirect('home')->with('login_success','ログイン成功しました');
        }
        // ダメならエラー表示をつけて、画面戻る。＊出ないと、ログイン後のブレードでエラーのままになるため
        return back()->withErrors([
            'login_error'=>'メールアドレスかパスワードが間違っています',
        ]);
   }
}
