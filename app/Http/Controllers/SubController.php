<?php

namespace App\Http\Controllers;

use App\Consts\MessageConst;
use App\Select;
use Illuminate\Http\Request;
use App\Test_user;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;
use Intervention\Image\Facades\Image;

class SubController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function subStore(Request $request)
    {
        if($request->goods_image!=null){
            $path = $request->file('goods_image')->store('public/img');

        }
       
        \DB::beginTransaction();
        try {

            Test_user::create([
                'id' => $request->id,
                'goods_name' => $request->goods_name,
                'goods_price' => $request->goods_price,
                'goods_maker' => $request->goods_maker,
                'goods_count' => $request->goods_count,
                'goods_comment' => $request->goods_comment,
                'goods_image' => basename($path)
            ]);
            \DB::commit();
        } catch (\Exception $e) {
            abort(500);
            \DB::rollback();
        }


        return redirect()->route('home')->with('message', '作成しました');
    }


    public function home(Request $request)
    {
        // goodsという変数にデータを入れる
        $model = new Test_user();
        $goods = $model->getList();
        $category = new Select();
        $categories = $category->getLists();

        return view('home', [
            // 'home'の中で、＄goodsのデータを配列の形で渡せる
            'goods' => $goods,
            'categories' => $categories
        ]);
    }

    /**
     * ブログ詳細を表示
     * @param int $id
     * @return view
     */
    public function showDetail($id)
    {

        $good = Test_user::find($id);

        if (is_null($good)) {
            \Session::flash('err_msg', '詳細データがありません');
            redirect()->route('home');
        }

        return view('detail', ['good' => $good]);
    }

    /**
     * ブログ編集画面を表示
     * @param int $id
     * @return view
     */
    public function showEdit($id)
    {

        $good = Test_user::find($id);

        if (is_null($good)) {
            \Session::flash('err_msg', '詳細データがありません');
            redirect()->route('home');
        }

        return view('edit', ['good' => $good]);
    }


    // 編集による内容変更メソッド
    public function exeSave(Request $request)
    {
        $inputs = $request->all();
        $good = Test_user::find($inputs['id']);
        $goods_image = $request->file('goods_image');
        // 元の画像のパス
        $path = $good->goods_image;
        \DB::beginTransaction();

        try {
            if (isset($goods_image)) {
                // 現在の画像ファイルの削除
                \Storage::disk('public')->delete($path);
                // 選択された画像ファイルを保存してパスをセット
                $path = $goods_image->store('public/img');
            }
            $good->update([
                'id' => $request->id,
                'goods_name' => $request->goods_name,
                'goods_price' => $request->goods_price,
                'goods_maker' => $request->goods_maker,
                'goods_count' => $request->goods_count,
                'goods_comment' => $request->goods_comment,
                'goods_image' => basename($path),
            ]);
            \DB::commit();
           
        } catch (\Exception $e) {
            \DB::rollback();
        }
        return redirect()->route('edit', [
        'id' => $good->id,
        'status'=>1,

    ]);
        // ->with('message', '編集しました');
    }

    // 検索結果を返すメソッドをhomeに組み込む
    public function showSelect(Request $request)
    {
        $goods = Test_user::paginate(20);

        $search = $request->input('search');
        $select = $request->input('select');
        $category = new Select();
        $categories = $category->getLists();

        $query = Test_user::query();

        if ($search) {
            $spaceConversion = mb_convert_kana($search, 's');

            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            foreach ($wordArraySearched as $value) {
                $query->where('goods_name', 'like', '%' . $value . '%');
            }
        }
        if ($select) {
            $query->where('select', $select);
        }
        $goods = $query->paginate(20);
        return view('home', compact('goods', 'search', 'select', 'categories'));
    }

    /**
     * 削除
     * @param int $id
     * @return view
     */
    public function exeDelete($id)
    {
        if (empty($id)) {
            \Session::flash('err_msg', '詳細データがありません');
            redirect()->route('home');
        }
        try {
            Test_user::destroy($id);
        } catch (\Throwable $e) {
            abort(500);
        }
        \Session::flash('del_msg', '削除しました');


        return redirect(route('home'));
    }
}

    // ソート機能　すでにIDでソート機能をモデルでつけているため、追加で入れるとバグ発生する
//     public function showSort(Request $request){
//         $sort=$request->get('sort');  
//         if ($sort) {
//             if ($sort === '1') {
//                 $goods = Test_user::orderBy('created_at')->get();
//             }
//             } elseif ($sort === '2') {
//             $goods = Test_user::orderBy('created_at', 'DESC')->get();
//                 }
//             else {
//             $goods = Test_user::all();
//         }
//         return view('home',[ 
//             'sort'=>$sort,
//             'goods' => $goods]);
//     }

// }
