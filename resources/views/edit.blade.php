<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品編集画面</title>
</head>

<body>

    <div style="width:50%; margin: 0 auto; text-align:center;">
        @foreach (App\Consts\MessageConst::MESSAGE_LIST as $key => $val)
        <label>{{ $key,old('status')}}{{$val}}</label>
        @endforeach
        <form action="{{ route('save') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{ $good->id}}">
            <div>
                商品名：
                <input type="text" name="goods_name" placeholder="名前の入力欄" value="{{ $good->goods_name }}" />
            </div>
            <div>
                価格：
                <input type="text" name="goods_price" placeholder="価格/個" value="{{ $good->goods_price }}" />
            </div>
            <div>
                メーカー：
                <select name="goods_maker" id="goods_maker">{{ $good->goods_maker }}
                    <option value="サイテック商社">サイテック商社</option>
                    <option value="DMM商社">DMM商社</option>
                    <option value="テックアカデミー商社">テックアカデミー商社</option>
                    <option value="侍エンジニア商社">侍エンジニア商社</option>
                </select>
            </div>
            <div>
                在庫数：
                <input type="text" name="goods_count" placeholder="在庫数の入力" value="{{ $good->goods_count }}" />
            </div>
            <div>
                コメント：
                <textarea name="goods_comment" placeholder="内容の入力">{{ $good->goods_comment }}</textarea>
            </div>
            <div>
                <label for="goods_image">商品画像をアップロードしてください</label>
                <input type="file" name="goods_image" accept=".png,.jpg,.jpeg,img/png,img/jpg">
                <img src="{{ asset('/storage/img/'.$good->goods_image) }}">
            </div>
            <button>更新</button>
        </form>
        <a href="{{ route('detail',['id' => $good->id ]) }}">戻る
        </a>

</body>

</html>