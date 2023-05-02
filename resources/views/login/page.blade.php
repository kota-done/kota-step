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

  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  
</head>

<body>

  <form class="form-signin" method="POST" action="{{route('login')}}">
    @csrf
    <h1 class="h3 mb-3 font-weight-normal">ログインフォーム</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </div>
    @endif
    @if(session('login_error'))
    <div class="alert alert-danger">{{ session('login_error') }}
    </div>
    @endif

    @if(session('logout'))
    <div class="alert alert-danger">{{ session('logout') }}
    </div>
    @endif
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">パスワード</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>

    <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
    <!-- <input type="button" onclick="location.href='./user_set.blade.php'" value="新規登録" > -->
    <a class="user-set" href="{{ route('inputLogin') }}">新規登録</a>
  </form>

 </script>
</body>

</html>