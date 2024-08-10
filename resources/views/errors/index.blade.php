<x-layout>
    <x-app.simple-header />

    <div class="container">
        <div class="text-lead text-light">
            @switch($statusCode)
                @case(404)
                    <x-page-heading class="text-center">
                        {{ __('Diese Seite wurde nicht gefunden.') }}
                    </x-page-heading>
                    <img
                        src="{{ Vite::asset('resources/assets/images/404.gif') }}"
                        alt="404"
                        class="mx-auto mt-6 w-1/2"
                    />

                    @break
                @case(429)
                    <x-page-heading class="text-center">
                        {{ __('Error') }} {{ $statusCode }}
                    </x-page-heading>

                    <p class="mt-6 text-center">
                        {{ __('Zu viele Requests innerhalb kurzer Zeit. Bitte versuche es später erneut.') }}
                    </p>

                    <img
                        src="{{ Vite::asset('resources/assets/images/429.gif') }}"
                        alt="404"
                        class="mx-auto mt-6 w-1/2"
                    />

                    @break
                @default
                    <x-page-heading class="text-center">
                        {{ __('Error') }} {{ $statusCode }}
                    </x-page-heading>
                    <p class="mt-6 text-center">
                        {{ $message }}
                    </p>

                    <img
                        src="{{ Vite::asset('resources/assets/images/404.gif') }}"
                        alt="404"
                        class="mx-auto mt-6 w-1/2"
                    />
            @endswitch ($statusCode)

            <a href="{{ route('home') }}">
                <x-button class="mt-12">
                    <span>{{ __('Hier gehts zurück') }}</span>
                </x-button>
            </a>
        </div>
    </div>
</x-layout>
