<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('pageTitle') &middot; {{ config('app.name') }}</title>
        <link rel="stylesheet" href="{{ asset('css/app.css?v=') . env('VER', '0') }}" type="text/css">
    </head>
    <body>
        <div class="page">
            @yield('content')
        </div>
    </body>
</html>
