<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test_user;

class SubController extends Controller
{
    public function create(){
        return view('create');
    }

    public function subStore(Request $request){
        $input=$request->all();
        Test_user::create($input);
        return redirect()->route('home');
    
    }

    public function home(){
        // goodsという変数にデータを入れる
        $goods=Test_user::all();
        
        return view('home',
        // 'home'の中で、＄goodsのデータを配列の形で渡せる
        ['goods'=>$goods]);
    }
}
