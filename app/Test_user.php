<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test_user extends Model
{
    protected $fillable=[
        'goods_name',
        'goods_price',
        'goods_maker',
        'goods_comment',
    ];
}
