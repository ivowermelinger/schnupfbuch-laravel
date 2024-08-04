@section('title', 'Passwort zurücksetzen')

<div class="container">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h1 class="mt-6 text-center text-heading">
            {{ __('Passwort zurücksetzen') }}
        </h1>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <form wire:submit.prevent="resetPassword" novalidate>
            <input wire:model="token" type="hidden" />

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
                    <x-button tpye="submit" class="bg-primary text-light">
                        <span>{{ __('Passwort zurücksetzen') }}</span>
                    </x-button>
                </span>
            </div>
        </form>
    </div>
</div>
