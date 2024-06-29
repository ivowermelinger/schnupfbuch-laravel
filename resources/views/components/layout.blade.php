<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    @section('styles')
        @vite(['resources/assets/scss/main.scss', 'resources/assets/ts/app.ts'])
    @show

    @include('partials.favicons')
</head>

<body class="app">

    @include('partials.header')

    <main class="main">
        {{ $slot }}
    </main>

    @include('partials.footer')

</body>

</html>
