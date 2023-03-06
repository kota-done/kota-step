<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインフォーム</title>
    <!-- script -->
    <script src="{{asset('js/app.js')}}" defer></script>
    <!-- styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css' )}}">
    <link rel="stylesheet" href="{{ asset('css/signin.css' )}}">
</head>
<body>

<form class="form-signin" method="POST" action="{{route('login')}}">
  <h1 class="h3 mb-3 font-weight-normal">ログインフォーム</h1>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail"  name="email" class="form-control" placeholder="Email address" required autofocus >
  <label for="inputPassword" class="sr-only">パスワード</label>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
 
  <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
</form>

</body>
</html>