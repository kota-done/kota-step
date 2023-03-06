<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;


class MainController extends Controller
{
/**
 * ログイン画面を表示
 * @return view
 */
    public function showLogin(){
        return view('login.page');
    }
}

