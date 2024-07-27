<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>{{ $title ?? env('APP_NAME') }}</title>

        @section('styles')
        @vite(['resources/assets/scss/main.scss'])
        @show
    </head>
    <body class="app">
        <main class="main">{{ $slot }}</main>
    </body>
</html>
