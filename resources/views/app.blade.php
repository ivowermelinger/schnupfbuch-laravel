<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">



    @section('styles')
        @vite(['resources/assets/scss/main.scss', 'resources/assets/ts/app.ts'])
    @show

    @inertiaHead
    <title>{{  $page['props']['heading'] }}</title>
    @include('partials.favicons')

</head>

<body>
    @inertia
</body>

</html>
