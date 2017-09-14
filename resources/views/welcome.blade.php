<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>pechat</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,600" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css" media="all">
    </head>
    <body>
        <div class="page">
          <div class="container">
            <div class="my-2 card">
              <h1>Hello, world!</h1>
              <h2>{{ $foo }} &middot; {{ $fii }}</h2>
            </div>
          </div>
        </div>
    </body>
</html>
