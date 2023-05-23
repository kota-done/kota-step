<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Test_user;
use Illuminate\Support\Facades\Storage;

class SalesController extends Controller
{
   public function showSelect(Request $request)
   {

      $search = $request->get('search');


      $query = Sale::query();


      if ($search) {
         $spaceConversion = mb_convert_kana($search, 's');

         $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

         foreach ($wordArraySearched as $value) {
            $query->where('goods_name', 'like', '%' . $value . '%');
         }
      }
      $search = $query->paginate(20);
      foreach ($search as $data) {
         $data->detailurl = route('detail', ['id' => $data->id]);
      }
      return response()->json($search);
   }


   // 一覧表示のメソッド
   public function showRehome(){
      $dates = new Sale();
      $goods_home = $dates->getData();

      foreach ($goods_home as $data) {
         $data->detailurl = route('detail', ['id' => $data->id]);
      }

      return response()->json($goods_home); 
   }


   // 商品価格の絞り込み（上限・下限）メソッド
   public function showPrice(Request $request){

      $price= Sale::query();
      $upperPrice = $request->get('upper_price');
      $lowerPrice = $request->get('lower_price');

      //  上限・下限両方とも毎回処理する。
      if(!is_null($upperPrice)){
         $price->where('goods_price','<=',$upperPrice)->get();
         
      }
      if(!is_null($lowerPrice)){
         $price->where('goods_price','>=',$lowerPrice)->get();

      }
      $data=$price->paginate(20);

      foreach ($data as $url) {
         $url->detailurl = route('detail', ['id' => $url->id]);
      }

      return response()->json($data); 
   }


   // 在庫数による上限・下限値の絞り込みメソッド
    public function showStock(Request $request){

      $stock= Sale::query();
      $upperStock = $request->get('upper_stock');
      $lowerStock = $request->get('lower_stock');

      //  上限・下限両方とも毎回処理する。
      if(!is_null($upperStock)){
         $stock->where('goods_count','<=',$upperStock)->get();
         
      }
      if(!is_null($lowerStock)){
         $stock->where('goods_count','>=',$lowerStock)->get();

      }
      $data=$stock->paginate(20);

      foreach ($data as $url) {
         $url->detailurl = route('detail', ['id' => $url->id]);
      }

      return response()->json($data); 
   }

   public function exeDelete(Request $request,Sale $sale){
      
      $sale =Sale::find($request->id);
      $sale->delete();
      return response()->json($sale);
   }










   /**
     * 削除
     * @param int $id
      * @return view
     */
   //  public function exeDelete($id)
   //  {
   //      if (empty($id)) {
   //          \Session::flash('err_msg', '詳細データがありません');
   //          redirect()->route('home');
   //      }
   //      try {
   //          Test_user::destroy($id);
   //      } catch (\Throwable $e) {
   //          abort(500);
   //      }
   //      \Session::flash('del_msg', '削除しました');


   //      return redirect(route('home'));
   //  }


}






