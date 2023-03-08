<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginFormRequest;
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
    /**
     * @param App\Http\Requests\LoginFormRequest $repuest
     */
   public function login(LoginFormRequest $request){
    dd($request->all());
   }
}
