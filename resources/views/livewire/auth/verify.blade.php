@section('title', 'E-Mail-Adresse bestätigen')

<div>
    <x-page-heading class="mb-12">
        {{ __('E-Mail-Adresse bestätigen') }}
    </x-page-heading>

    @if (session('resent'))
        <div class="flex items-start">
            <x-icon.check class="w-20 text-success" />

            <div class="ml-3">
                <p class="text-content text-light">
                    {{ __(' Ein neuer Bestätigungslink wurde an deine E-Mail-Adresse gesendet.') }}
                </p>
            </div>
        </div>
    @else
        <p class="text-content">
            {{ __('Deine E-Mail-Adresse wurde noch nicht bestätigt. Bitte prüfe deine  E-Mails, um die Bestätigung abzuschließen. Sollte die E-Mail nicht in deinem Posteingang sein, überprüfe bitte auch deinen Spam-Ordner.') }}
        </p>

        <div class="mt-8">
            <x-button wire:click="resend">
                <span>{{ __('Neuen Link anfordern') }}</span>
            </x-button>
        </div>
    @endif
</div>
