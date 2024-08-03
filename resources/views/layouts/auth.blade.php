@extends('layouts.base')

@section('body')
    <main>
        <x-simple-header />
        @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset
    </main>
@endsection
