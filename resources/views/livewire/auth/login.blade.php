@section('title', 'Sign in to your account')

<div class="container sm:mx-auto sm:w-full sm:max-w-md">
    <h2 class="text-heading mt-6 text-center">
        {{ __('Jetzt einloggen') }}
    </h2>

    @if (Route::has('register'))
        <p class="max-w mt-2 text-center text-sm leading-5 text-gray-600">
            <span>{{ __('oder') }}</span>
            <x-link href="{{ route('register') }}">
                <span>{{ __('einen neuen Account erstellen') }}</span>
            </x-link>
        </p>
    @endif

    <div class="mt-6">
        <form wire:submit.prevent="authenticate" novalidate>
            <x-form.input
                label="E-Mail"
                id="email"
                name="email"
                class="bg-dark text-light border-light"
                type="email"
            />

            <div class="mt-6">
                <x-form.input
                    label="Passwort"
                    id="password"
                    name="password"
                    type="password"
                    class="bg-dark text-light border-light"
                />
            </div>

            <div class="mt-6">
                <x-button
                    class="bg-primary text-light flex items-center justify-center rounded-md px-2 py-2"
                    type="submit"
                >
                    Sign in
                </x-button>
            </div>

            <div class="mt-6">
                <x-link href="{{ route('password.request') }}">
                    <x-icon.lock class="w-5" />
                    <span>{{ __('Passwort vergessen?') }}</span>
                </x-link>
            </div>
        </form>
    </div>
</div>
