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
// 検索結果を返すメソッドをhomeに組み込む
    public function showDetail(Request $request){
       $goods=Test_user::paginate(20);

       $search=$request->input('search');

       $query=Test_user::query();

       if($search){
            $spaceConversion=mb_convert_kana($search,'s');

            $wordArraySearched= preg_split('/[\s,]+/',$spaceConversion,-1, PREG_SPLIT_NO_EMPTY);

            foreach($wordArraySearched as $value){
                $query->where('goods_name','like','%'.$value.'%');
            }

         $goods=$query->paginate(20);
        }
        return view('home', compact('goods','search'));
// 下記は表示はできるが、結局homeメソッドを使用するため、全ての値を再度テーブルから取得している。おそらくwithで通知的には検索結果が出る。
    //     return redirect()->route('home')->with([
    //         'goods'=>$goods,
    //         'search'=>$search,
    //    ]);
    }
        
}
