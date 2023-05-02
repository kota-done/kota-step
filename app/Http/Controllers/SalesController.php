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
}
















//     // 検索結果を返すメソッドをhomeに組み込む
//  public function showSelect(){
//    try{
//       $sale = Sale::all();
//       $result=[
//          'result'=>true,
//          'goods_name' => $sale->goods_name,
   
//       ];
//    } catch(\Exception $e){
//       $result=[
//          'result'=>false,
//          'error'=>[
//             'messages'=>[$e->getMessage()]
//          ],
//       ];
//       return $this->resConversionJson($result, $e->getCode());
//    }
//       return $this->resConversionJson($result);
//    }

//    private function resConversionJson($result,$data){
//       $data=Sale::where('goods_name','like','%' .$result. '%')->withCount('id')->orderBy('id', 'desc')->get();

//       return response()->json($data);

//    }
  
 
// }


// //  $data=Sale::where('goods_name','like','%' .$searchSale. '%')->withCount('id')->orderBy('id', 'desc')->get();
// dd($data);
// return response()->json($data);