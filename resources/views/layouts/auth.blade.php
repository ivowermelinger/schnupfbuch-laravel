@extends('layouts.base')

@section('body')
    <main>
        <x-app.simple-header />
        @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset
    </main>
@endsection
