<div>
    <x-app.header :$user />

    <div class="container max-w-2xl text-light">
        <x-page-heading>{{ __('Passwort ändern') }}</x-page-heading>

        <form wire:submit.prevent="changePassword" novalidate>
            <div class="mt-6">
                <x-form.input
                    wire:model.lazy="old_password"
                    type="password"
                    name="old_password"
                    required
                    class="bg-dark text-light"
                    label="{{ __('Altes Passwort') }}"
                />
            </div>

            <div class="mt-6">
                <x-form.input
                    wire:model.lazy="new_password"
                    type="password"
                    required
                    name="new_password"
                    class="bg-dark text-light"
                    label="{{ __('Neues Passwort') }}"
                />
            </div>

            <div class="mt-6">
                <x-form.input
                    wire:model.lazy="password_confirm"
                    type="password"
                    name="password_confirm"
                    required
                    class="bg-dark text-light"
                    label="{{ __('Neues Passwort bestätigen') }}"
                />
            </div>

            <div class="mt-12">
                <x-button>
                    <span>{{ __('Speichern') }}</span>
                </x-button>
            </div>
        </form>
    </div>
</div>
