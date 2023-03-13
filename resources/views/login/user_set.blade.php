<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録画面</title>
</head>

<body>
    <h2>ユーザー登録フォーム</h2>
    <form method="POST" action="{{ route('store') }}">
    @csrf
        <div class="container">
            <p>
                <label for="name">名前</label>
                <input type="text" name="name" id="name">
            </p>
            <p>
                <label for="mail" s>メールアドレス</label>
                <input type="text" name="email" id="email" placeholder="Email address" required autofocu>
            </p>
            <p>
                <label for="password">パスワード</label>
                <input type="text" name="password" id="password" placeholder="Password" required>
            </p>
            <input type="submit" name="button" value="登録">
        </div>
       
    </form>
</body>

</html>