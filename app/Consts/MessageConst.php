<?php
namespace App\Consts;

class MessageConst
{
    const MESSAGE_EDIT = '1';
    const MESSAGE_EDIT_NAME='編集しました';

    const MESSAGE_CREATE = '2';
    const MESSAGE_CREATE_NAME= '作成しました';
    

    const MESSAGE_DEL = '3';
    const MESSAGE_DEL_NAME= '削除しました';
    const MESSAGE_LIST=[
        '編集しました'=>self::MESSAGE_EDIT,
        '作成しました'=>self::MESSAGE_CREATE,
        '削除しました'=>self::MESSAGE_DEL,
      
    ];

}
