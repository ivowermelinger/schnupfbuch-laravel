@section('title', 'Registieren')

<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h1 class="text-heading mt-6 text-center">
            {{ __('Neuen Account erstellen') }}
        </h1>

        <p class="mt-4 flex items-center justify-center text-center">
            <span class="text-content mr-4">{{ __('oder') }}</span>
            <x-link href="{{ route('login') }}">
                <x-icon.login class="w-7" />
                <span>{{ __('zum Login') }}</span>
            </x-link>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white px-4 py-8 shadow sm:rounded-lg sm:px-10">
            <form novalidate wire:submit.prevent="register">
                <x-form.input
                    label="Nickname"
                    id="nickname"
                    type="text"
                    name="nickname"
                    required
                    class="bg-dark border-light"
                />
                <div class="mt-6">
                    <x-form.input
                        label="Vorname"
                        hint="Wird nicht veröffentlicht"
                        id="first_name"
                        type="text"
                        name="first_name"
                        required
                        class="bg-dark border-light"
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
                        class="bg-dark border-light"
                    />
                </div>

                <div class="mt-6">
                    <x-form.input
                        label="E-Mail"
                        id="email"
                        type="email"
                        name="email"
                        required
                        class="bg-dark border-light"
                    />
                </div>

                <div class="mt-6">
                    <x-form.input
                        label="Passwort"
                        id="password"
                        type="password"
                        name="password"
                        required
                        class="bg-dark border-light"
                    />
                </div>
                <div class="mt-6">
                    <x-form.input
                        label="Passwort bestätigen"
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        class="bg-dark border-light"
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
