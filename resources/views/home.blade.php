<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>商品一覧画面</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-danger">ログアウト</button>
    </form>
    <div class="container">
        <div class="mt-5">
            @if (session('login_success'))
                <div class="alert alert-success">{{ session('login_success') }}
                </div>
            @endif
            <h3>プロフィール</h3>
            <ul>
                <li>名前：{{ Auth::user()->name }}</li>
                <li>メールアドレス：{{ Auth::user()->email }}</li>
            </ul>
            @if (session('del_msg'))
                <p class="text-danger">{{ session('del_msg') }} </p>
            @endif
            <div class="sale">
                <!-- jqueryでjsでボタン押した時の処理を追加しているため不要 -->
                <!-- <form action="{{ route('select') }}" method="GET" class="goods_select"> -->
                @csrf
                <input type="search" placeholder="商品名を入力" id="search" name="search" class="search" value="">
                <button type="submit" class="goods_select_btn">検索</button>
                <button type="submit" class="goods_home_btn">一覧表示</button>

            </div>

            <div>

            </div>
            <a class="goods_set" href="{{ route('create') }}">新規登録</a>
        </div>
        <h2>登録済み商品一覧</h2>
        <table class=goods-list>
            <thead>
                <tr>
                    <th></th>
                    <th>商品名</th>
                    <th>値段</th>
                    <th>メーカー</th>
                    <th>在庫数</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($goods as $good)
                    <tr>
                        <td>{{ $good->id }}</td>
                        <td>{{ $good->goods_name }}</td>
                        <td>{{ $good->goods_price }}</td>
                        <td>{{ $good->goods_maker }}</td>
                        <td>{{ $good->goods_count }}</td>
                        <td>{{ $good->created_at }}</td>
                        <form action="{{ route('delete', ['id' => $good->id]) }}" method="POST"
                            enctype="multipart/form-data" onsubmit="return checkDelete()">
                            @csrf
                            <td><button type="submit" class="btn-primary" onclick="">削除</button></td>
                        </form>
                        <td><a href="/kota-fail/public/goods/{{ $good->id }}">詳細</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table class="sale-list">
            <tr></tr>
        </table>
        <script>
            function checkDelete() {
                if (window.confirm('削除しますか？')) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")
            },
        })
        // 検索ボタンを押したら、検索欄とメーカー一覧の欄の情報
        $(function() {
            // ボタンを押したら、処理を行いjsonで引数にして返す予定
            $(".goods_select_btn").on("click", function() {


                $('.goods-list tbody').empty(); //もともとある要素を空にする
                $('.search-null').remove(); //検索結果が0のときのテキストを消す
                var searchSale = $('.search').val(); //検索ワードを取得
                var selectSale = $('.select').val(); //選択メーカーの情報を取得



                $.ajax({
                        type: 'POST',
                        url: "{{ route('select') }}",
                        data: {
                            'search': searchSale,

                        },
                        dataType: 'json', //json形式で受け取る
                    })
                    //    出力の仕方を質問　Chromeでおそらくデータは出せている。Ajax通信もできている。
                    .done(function(data) { //ajaxが成功したときの処理  jsonデータ　data=$search
                        console.log(data);

                        $.each(data.data, function(index, val) {
                            // console.log(index);
                            // console.log(val);
                            var html = ` 
                            <tr>
                            <td>${val.id}</td>
                            <td>${val.goods_name}</td>
                            <td> <a href="${val.detailurl}">詳細</a></td>
                            </tr> `;
                            $('.goods-list').append(html);
                        });

                        alert('通信は成功してるぜ');

                    }).fail(function() {
                        //ajax通信がエラーのときの処理
                        console.log('どんまい！');
                    })
            })
        });


        // 一覧表示による非同期での再取得
        $(function() {
            // ボタンを押したら、処理を行いjsonで引数にして返す予定
            $(".goods_home_btn").on("click", function() {
                $('.goods-list tbody').empty();



                $.ajax({
                        type: 'GET',
                        url: "{{ route('rehome') }}",

                        dataType: 'json', //json形式で受け取る

                    })
                    .done(function(data) { //ajaxが成功したときの処理  jsonデータ　data=$search
                        console.log(data);


                        $.each(data, function(index, val) {
                            // console.log(index);
                            // console.log(val);
                            var html = ` 
                            <tr>
                            <td>${val.id}</td>
                            <td>${val.goods_name}</td>
                            <td>${val.goods_price}</td>
                            <td>${val.goods_maker}</td>
                            <td>${val.goods_count}</td>
                            <td>${val.created_at}</td>
                            <td> <a href="${val.detailurl}">詳細</a></td>
                            </tr>
                            `;
                            $('.goods-list').append(html);
                        });
                        alert('通信は成功してるぜ');
                    })
                    .fail(function() {
                        //ajax通信がエラーのときの処理
                        console.log('どんまい！');
                    })
            });
        });
    </script>
</body>

</html>
