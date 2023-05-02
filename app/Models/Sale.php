<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
   // テーブル名
   protected $table='test_users';
   protected $fillable=[
       'id',
       'goods_name',
       'goods_price',
       'goods_maker',
       'goods_count',
       'goods_image',
       'goods_comment',
   ];

   public function getData()
   {
       $goods_home=DB::table('test_users')->get();
       return  $goods_home;
   }


}