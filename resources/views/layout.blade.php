<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>shopify-tz</title>


    <link rel="stylesheet" href="{{  asset('css/app.css') }}">
    <link rel="stylesheet" href="{{  asset('css/style.css') }}">

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/workshopHandlers.js') }}"></script>

</head>
<body>
<div class="flex-center position-ref full-height" >
    <div id="content"   class="container content">
       @yield('content')
    </div>
</div>
</body>




</html>
