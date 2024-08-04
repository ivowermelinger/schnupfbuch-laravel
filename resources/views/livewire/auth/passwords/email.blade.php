@section('title', 'Passwort zurücksetzen')

<div>
    <x-page-heading class="mb-6">
        {{ __('Passwort zurücksetzen') }}
    </x-page-heading>

    @if ($emailSentMessage)
        <div class="flex items-start">
            <x-icon.check class="w-20 text-success" />

            <div class="ml-3">
                <p class="text-content text-light">
                    {{ $emailSentMessage }}
                </p>
            </div>
        </div>
    @else
        <form wire:submit.prevent="sendResetPasswordLink" novalidate>
            <x-form.input
                label="E-Mail"
                name="email"
                id="email"
                type="email"
                wire:model.lazy="email"
                autofocus
                class="border-light bg-dark text-light"
            />

            <div class="mt-6">
                <span class="block w-full rounded-md shadow-sm">
                    <x-button
                        type="submit"
                        class="w-full bg-primary text-light"
                    >
                        {{ __('E-Mail senden') }}
                    </x-button>
                </span>
            </div>
        </form>
    @endif
</div>
