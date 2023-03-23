<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品詳細画面</title>
</head>

<body>
    <h2>商品詳細</h2>
    @if(session('err_msg'))
    <p class="text-danger">{{ session('err_msg') }}

    </p>
    @endif
    <table class=goods-list>
        <tr>
            <th>商品名</th>
            <th>値段</th>
            <th>メーカー</th>
            <th>在庫数</th>
            <th>画像</th>
            <th>コメント</th>
            <th> </th>
        </tr>
        <tr>
            <td>{{ $good->id}}</td>
            <td>{{ $good->goods_name }}</td>
            <td>{{ $good->goods_price }}</td>
            <td>{{ $good->goods_maker }}</td>
            <td>{{ $good->goods_count }}</td>
            <td>{{ $good->goods_comment }}</td>
            <td><img src="{{ asset('/storage/img/'.$good->goods_image) }}"></td>

            <td>
            <a href="/kota-fail/public/goods/edit/{ $good->id }">編集</a>
            </td>
        </tr>
    </table>

</body>

</html>