<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    @include('layouts.frontend.style')

    @stack('css')

</head>
<body>

@include('layouts.frontend.header')

@yield('content')

@include('layouts.frontend.footer')

@include('layouts.frontend.scrypt')

@stack('js')

</body>
</html>
