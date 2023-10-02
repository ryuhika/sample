<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>サッカーショップ</title>
    <link rel="stylesheet" href="{{ asset('css/sub.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased">
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/products') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">戻る</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">ログイン</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">新規登録</a>
                @endif
            @endauth
        </div>
    @endif
    <form>
      <p class="login"><a href="{{ route('login') }}" >ログインはこちら</a></p>
      <p class="register"><a href="{{ route('register') }}">新規登録はこちら</a></p>
      <p class="right"><a href="{{ url('/products') }}">今すぐ利用</a></p>
    </form>
</div>
</body>
</html>