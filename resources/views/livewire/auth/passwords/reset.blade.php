@section('title', 'Passwort zurücksetzen')

<div>
    <x-page-heading class="mb-6 text-center">
        {{ __('Passwort zurücksetzen') }}
    </x-page-heading>

    <form wire:submit.prevent="resetPassword" novalidate>
        <input wire:model="token" type="hidden" />
        <div class="mt-6">
            <x-form.input
                label="E-Mail"
                wire:model.lazy="email"
                id="email"
                type="email"
                name="email"
                required
                autofocus
                class="border-light bg-dark text-light"
            />
        </div>

        <div class="mt-6">
            <x-form.input
                label="Passwort"
                wire:model.lazy="password"
                id="password"
                type="password"
                name="password"
                required
                class="border-light bg-dark text-light"
            />
        </div>

        <div class="mt-6">
            <x-form.input
                label="Passwort bestätigen"
                wire:model.lazy="passwordConfirmation"
                id="password_confirmation"
                name="passwordConfirmation"
                type="password"
                required
                class="border-light bg-dark text-light"
            />
        </div>

        <div class="mt-8">
            <span class="block w-full rounded-md shadow-sm">
                <x-button tpye="submit">
                    <span>{{ __('Passwort zurücksetzen') }}</span>
                </x-button>
            </span>
        </div>
    </form>
</div>
