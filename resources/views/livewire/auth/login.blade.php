@section('title', 'Sign in to your account')

<div>
    <x-page-heading class="mb-6">
        {{ __('Jetzt einloggen') }}
    </x-page-heading>

    @if (Route::has('register'))
        <p class="mt-4 text-center">
            <x-link href="{{ route('register') }}">
                <x-icon.login class="w-7" />
                <span>{{ __('Neuen Account erstellen') }}</span>
            </x-link>
        </p>
    @endif

    <form wire:submit.prevent="authenticate" novalidate>
        <div class="mt-6">
            <x-form.input
                label="E-Mail"
                id="email"
                name="email"
                class="border-light bg-dark text-light"
                type="email"
                wire:model="email"
            />
        </div>

        <div class="mt-6">
            <x-form.input
                label="Passwort"
                id="password"
                name="password"
                type="password"
                class="border-light bg-dark text-light"
                wire:model="password"
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
