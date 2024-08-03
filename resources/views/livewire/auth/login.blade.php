@section('title', 'Sign in to your account')

<div class="container sm:mx-auto sm:w-full sm:max-w-md">
    <h2 class="text-heading mt-6 text-center">
        {{ __('Jetzt einloggen') }}
    </h2>

    @if (Route::has('register'))
        <p class="mt-4 text-center">
            <x-link href="{{ route('register') }}">
                <x-icon.login class="w-7" />
                <span>{{ __('Neuen Account erstellen') }}</span>
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

            <div class="mt-8">
                <x-button type="submit" class="bg-primary text-light">
                    <span>{{ __('Login') }}</span>
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
