@section('title', 'Registieren')

<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h1 class="mt-6 text-center text-heading">
            {{ __('Neuen Account erstellen') }}
        </h1>

        <p class="mt-4 text-center">
            <x-link href="{{ route('login') }}">
                <x-icon.login class="w-7" />
                <span>{{ __('Login') }}</span>
            </x-link>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white px-4 py-8 shadow sm:rounded-lg sm:px-10">
            <form novalidate @submit.prevent="submit" x-data="register">
                <x-form.input
                    label="Nickname"
                    id="nickname"
                    type="text"
                    name="nickname"
                    required
                    class="border-light bg-dark"
                    x-model="nickname"
                    @keyup="checkNickname"
                    x-ref="nickname"
                    wire:model="nickname"
                    value="Max"
                />
                <p
                    x-show="showNicknameError"
                    class="mt-2 text-small text-error"
                >
                    {{ __('Verwende keine beleidigenden Wörter!') }}
                </p>

                <div class="mt-6">
                    <x-form.input
                        label="Vorname"
                        hint="Wird nicht veröffentlicht"
                        id="first_name"
                        type="text"
                        name="first_name"
                        required
                        class="border-light bg-dark"
                        wire:model="first_name"
                    />
                </div>
                <div class="mt-6">
                    <x-form.input
                        label="Nachname"
                        hint="Wird nicht veröffentlicht"
                        id="last_name"
                        type="text"
                        name="last_name"
                        required
                        class="border-light bg-dark"
                        wire:model="last_name"
                    />
                </div>

                <div class="mt-6">
                    <x-form.input
                        label="E-Mail"
                        id="email"
                        type="email"
                        name="email"
                        required
                        class="border-light bg-dark"
                        wire:model="email"
                    />
                </div>

                <div class="mt-6">
                    <x-form.input
                        label="Passwort"
                        id="password"
                        type="password"
                        name="password"
                        required
                        class="border-light bg-dark"
                        wire:model="password"
                    />
                </div>
                <div class="mt-6">
                    <x-form.input
                        label="Passwort bestätigen"
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        class="border-light bg-dark"
                        wire:model="password_confirmation"
                    />
                </div>

                <div class="mt-8">
                    <x-button type="submit" class="bg-primary text-light">
                        <span>{{ __('Registrieren') }}</span>
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
