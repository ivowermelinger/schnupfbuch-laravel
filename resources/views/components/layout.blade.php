<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    @section('styles')
        @vite(['resources/assets/scss/app.scss', 'resources/assets/ts/app.ts'])
    @show

    @include('partials._favicons')
</head>

<body>
<main class="main">
    @include('partials._header')

    {{ $slot }}


    @include('partials._footer')
 
</main>

</body>

</html>
