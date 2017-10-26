<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>pechat</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,600" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/app.css?v=') . env('VER', '0') }}" type="text/css">
    </head>
    <body>
        <div class="page">
            @yield('content')
        </div>
        <script src="{{ asset('js/app.js?v=') . env('VER', '0') }}"></script>
    </body>
</html>
