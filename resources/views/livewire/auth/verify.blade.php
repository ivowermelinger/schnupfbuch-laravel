@section('title', 'E-Mail-Adresse bestätigen')

<div class="container">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h1 class="mt-6 text-center text-heading">
            {{ __('E-Mail-Adresse bestätigen') }}
        </h1>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        @if (session('resent'))
            <div class="flex items-start">
                <x-icon.check class="w-20 text-success" />

                <div class="ml-3">
                    <p class="text-content text-light">
                        Ein neuer Bestätigungslink wurde an deine E-Mail-Adresse
                        gesendet.
                    </p>
                </div>
            </div>
        @else
            <p class="text-content">
                Deine E-Mail-Adresse wurde noch nicht bestätigt. Bitte prüfe
                deine E-Mails, um die Bestätigung abzuschließen. Sollte die
                E-Mail nicht in deinem Posteingang sein, überprüfe bitte auch
                deinen Spam-Ordner.
            </p>

            <x-button class="text-ligh mt-8 bg-primary" wire:click="resend">
                <span>{{ __('Neuen Link anfordern') }}</span>
            </x-button>
        @endif
    </div>
</div>
