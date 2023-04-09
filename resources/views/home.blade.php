<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css' )}}">
    <link rel="stylesheet" href="{{ asset('css/home.css' )}}">
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
            @if(session('del_msg'))
            <p class="text-danger">{{ session('del_msg') }} </p>
            @endif
            <div>
                <form action="{{ route('select') }}" method="GET" class="goods_select">
                    @csrf
                    <input type="search" placeholder="商品名を入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
                    <label for="">メーカー名選択
                        <select name="select" value="@if (isset($select)) {{ $select }} @endif">
                            <option value="">未選択</option>
                            @foreach($categories as $id =>$goods_maker)
                            <option value="{{$id}}">
                                {{ $goods_maker}}
                            </option>
                            @endforeach
                        </select>
                    </label>
                    <div>
                        <button type="submit">検索</button>
                        <button>
                            <a href="{{ route('select')}}" class="text-white">クリア</a>
                        </button>
                    </div>
                </form>
                <!-- すでに一覧でIDでソートしているため、追加でソート機能を入れるとバグ発生 -->
            <!-- <form action="{{route('sort')}}" method="GET">
                @csrf
                <button type="submit" name="sort" value="@if (!isset($sort) || $sort !== '1') 1 @elseif ($sort === '1') 2 @endif">作成日順</button>
                <button type="submit" name="sort" value="">あいうえお順</button>
            </form> -->
            </div>
            <a class="goods_set" href="{{ route('create') }}">新規登録</a>
        </div>
        <h2>登録済み商品一覧</h2>
        <table class=goods-list>
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
            
             @foreach($goods as $good)
            <tr>
                <td>{{ $good->id}}</td>
                <td>{{ $good->goods_name }}</td>
                <td>{{ $good->goods_price}}</td>
                <td>{{ $good->goods_maker }}</td>
                <td>{{ $good->goods_count }}</td>
                <td>{{$good->created_at}}</td>
                <form action="{{ route('delete',['id' => $good->id ] )}}" method="POST" enctype="multipart/form-data" onsubmit="return checkDelete()">
                    @csrf
                    <td><button type="submit" class="btn-primary" onclick="">削除</button></td>
                </form>
                 <td><a href="/kota-fail/public/goods/{{ $good->id }}">詳細</a></td>
            </tr>
            @endforeach
        </table>
        <script>
            function checkDelete(){
            if(window.confirm('削除しますか？')){
                return true;
                } 
                else{
                    return false;
            }
            }
        
        </script>
    </div>
</body>

</html>