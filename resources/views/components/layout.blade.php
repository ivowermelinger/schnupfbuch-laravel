<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    @section('styles')
        @vite(['resources/assets/scss/app.scss', 'resources/assets/js/app.ts'])
    @show
</head>

<body>
<main class="main">
    @include('partials._header')

    {{ $slot }}

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="gr-24">
                    <div class="footer__inner">
                        <div></div>
                        <div class="footer__copy">Copyright &copy; {{ now()->year }}</div>
                        <div class="footer__action">
                            <a class="button button--secondary" href="/listing/create">
                                <span>Post Job</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</main>
<x-flash-message/>
</body>

</html>
