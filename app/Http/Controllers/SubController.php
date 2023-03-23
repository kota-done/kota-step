<?php

namespace App\Http\Controllers;

use App\Select;
use Illuminate\Http\Request;
use App\Test_user;

class SubController extends Controller
{
    public function create(){
        return view('create');
    }

    public function subStore(Request $request){
        $path = $request->file('goods_image')->store('public/img');
        Test_user::create([
            'id'=>$request->id,
          'goods_name' => $request->goods_name,
          'goods_price'=>$request->goods_price,
           'goods_maker'=>$request->goods_maker,
           'goods_count'=>$request->goods_count,
           'goods_comment'=>$request->goods_comment,
          'goods_image' => basename($path)
        ]);
        return redirect()->route('home')->with('message', '作成しました');
        }
    

    public function home(Request $request){
        // goodsという変数にデータを入れる
        $goods=Test_user::all();
        $category = new Select();
        $categories = $category->getLists();
        
        return view('home',[
        // 'home'の中で、＄goodsのデータを配列の形で渡せる
            'goods'=>$goods,
            'categories'=>$categories
        ]);
    }
    
    /**
     * ブログ詳細を表示
     * @param int $id
     * @return view
     */
    public function showDetail($id){
        $good=Test_user::find($id);

        if(is_null($good)){
            \Session::flash('err_msg','詳細データがありません');
            redirect()->route('home');

        }
        
        return view('detail',['good'=>$good]);
    }

    /**
     * ブログ編集画面を表示
     * @param int $id
     * @return view
     */
    public function showEdit($id){
        $good=Test_user::find($id);
       

        if(is_null($good)){
            \Session::flash('err_msg','詳細データがありません');
            redirect()->route('home');

        }
        
        return view('edit',['good'=>$good]);
    }


// 検索結果を返すメソッドをhomeに組み込む
    public function showSelect(Request $request){
       $goods=Test_user::paginate(20);

       $search=$request->input('search');
       $select=$request->input('select');
       $category = new Select();
       $categories = $category->getLists();

       $query=Test_user::query();

       if($search){
            $spaceConversion=mb_convert_kana($search,'s');

            $wordArraySearched= preg_split('/[\s,]+/',$spaceConversion,-1, PREG_SPLIT_NO_EMPTY);

            foreach($wordArraySearched as $value){
                $query->where('goods_name','like','%'.$value.'%');
            }

        }
        if($select){
            $query->where('select',$select);
            
        }
        $goods=$query->paginate(20);
        return view('home', compact('goods','search','select','categories'));

    }
        
}
