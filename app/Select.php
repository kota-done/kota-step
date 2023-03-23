<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Select extends Model
{
    /**
     * カテゴリーの一覧を取得
     */
    public function getLists()
    {
        $categories = Test_user::orderBy('id', 'asc')->pluck("goods_maker","id");

        return $categories;
    }
}
