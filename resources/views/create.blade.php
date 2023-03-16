<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品新規登録画面</title>
</head>
<body>


<div style="width:50%; margin: 0 auto; text-align:center;">
    <form action="{{ route('sub.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            商品名：
            <input type="text" name="goods_name" placeholder="名前の入力欄"/>
        </div>
        <div>
            価格：
            <input type="text" name="goods_price" placeholder="価格/個"/>
        </div>
        <div>
            メーカー：  
            <select name="goods_maker" id="goods_maker">
                <option value="サイテック商社">サイテック商社</option>
                <option value="DMM商社">DMM商社</option>
                <option value="テックアカデミー商社">テックアカデミー商社</option>
                <option value="侍エンジニア商社">侍エンジニア商社</option>
            </select>
        </div>
        <div>
            在庫数：
            <input type="text" name="goods_count" placeholder="在庫数の入力"/>
        </div>
        <div>
            コメント：
            <textarea name="goods_comment" placeholder="内容の入力"></textarea>
        </div>
        <div>
            <label for="goods_image">商品画像をアップロードしてください</label>
            <input type="file" name="goods_image">
        </div>
        <button>登録</button>
    </form>
    <form action="{{ route('home')}}" method="GET">
        @csrf
        <button>戻る</button>
    </form>
</div>

</body>
</html>