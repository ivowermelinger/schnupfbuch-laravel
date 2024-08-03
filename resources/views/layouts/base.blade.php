<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>{{ $title ?? config('app.name') }}</title>

        <x-favicons />

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=REM:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet"
        />

        @vite(['resources/assets/scss/main.scss', 'resources/assets/js/main.js'])

        @livewireStyles
        @livewireScripts

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>

    <body class="bg-dark text-light min-h-screen">
        @yield('body')
    </body>
</html>
