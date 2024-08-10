<div>
    <x-app.header :$user />

    <div
        class="container mt-32 grid grid-cols-12 gap-4 text-light md:mt-40 md:gap-16"
    >
        <div class="col-span-12 md:col-span-6">
            <h2 class="text-lead">{{ __('Passwort ändern') }}</h2>

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

        <div class="col-span-12 my-12 md:col-span-6 md:my-0">
            <h2 class="mb-6 text-lead">{{ __('Profilbild ändern') }}</h2>
            <x-link href="{{ route('settings.seed') }}" class="w-auto">
                <x-button>
                    <span>{{ __('Neues Profilbild generieren') }}</span>
                </x-button>
            </x-link>
        </div>
    </div>
</div>
