<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test_user extends Model
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
}
