@extends('layouts.base')

@section('body')
    <div
        class="bg-dark text-light flex min-h-screen flex-col justify-center py-12 sm:px-6 lg:px-8"
    >
        <x-simple-header />
        @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset
    </div>
@endsection
