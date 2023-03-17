<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css' )}}">
    <title>商品一覧画面</title>
</head>

<body>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-danger">ログアウト</button>
    </form>
    <div class="container">
        <div class="mt-5">
            @if(session('login_success'))
            <div class="alert alert-success">{{ session('login_success') }}
            </div>
            @endif
            <h3>プロフィール</h3>
            <ul>
                <li>名前：{{ Auth::user()->name }}</li>
                <li>メールアドレス：{{ Auth::user()->email }}</li>
            </ul>
            <div>
                <form action="{{ route('detail') }}" method="GET">
                    @csrf
                    <input type="search" placeholder="商品名を入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
                    <div>
                        <button type="submit">検索</button>
                        <button>
                            <a href="{{ route('detail')}}" class="text-white">クリア</a>
                        </button>
                    </div>
                </form>
            </div>
            <a class="goods_set" href="{{ route('create') }}">新規登録</a>
        </div>
        <h2>登録済み商品一覧</h2>
        <table class=goods-list>
            <tr>
                <th>商品名</th>
                <th>値段</th>
                <th>メーカー</th>
                <th>在庫数</th>
                <th>画像</th>
                <th>コメント</th>
            </tr>
            <tr>
            @foreach($goods as $good)
                <td>{{ $good->id}}</td>
                <td>{{ $good->goods_name }}</td>
                <td>{{ $good->goods_price }}</td>
                <td>{{ $good->goods_maker }}</td>
                <td>{{ $good->goods_count }}</td>
                <td>{{ $good->goods_image }}</td>
                <td>{{ $good->goods_comment }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</body>

</html>