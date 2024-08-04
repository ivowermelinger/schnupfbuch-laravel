<div>
    <x-app.header :$user />

    <main
        class="main--app container grid grid-cols-none grid-rows-12 bg-dark pb-4 pt-20 text-light"
    >
        <div
            class="relative row-span-11 grid grid-rows-11"
            x-data="app({{ $lines->toJson() }})"
            wire:ignore
        >
            <div class="row-span-9">
                <button
                    x-on:click="nextLine"
                    class="x-cloak relative flex h-full w-full flex-col items-center justify-center"
                >
                    <span
                        class="text-lead font-bold text-light"
                        x-text="activeLine.line"
                    ></span>
                    <span
                        class="mt-4 text-lead font-light text-light"
                        x-text="activeLine.nickname"
                    ></span>
                </button>

                <div
                    x-show="loading"
                    x-transition
                    class="absolute inset-0 z-10 flex items-center justify-center bg-dark"
                >
                    <div class="spinner text-primary">
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>

            <div class="row-span-2">
                <x-app.user-interaction />
            </div>
        </div>

        <div class="row-span-1">
            <livewire:components.app.footer />
        </div>

        @auth
        @else
            <x-app.dialog id="login" title="Login" @open-login.window="open">
                <form
                    class="text-dark"
                    wire:submit.prevent="authenticate"
                    novalidate
                >
                    <x-form.input
                        type="email"
                        name="email"
                        id="email"
                        label="E-Mail"
                        class="border-dark bg-light"
                        wire:model="email"
                    />

                    <div class="mt-6">
                        <x-form.input
                            type="password"
                            name="password"
                            id="password"
                            label="Passwort"
                            class="border-dark bg-light"
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
                            <span class="text-dark">
                                {{ __('Passwort vergessen?') }}
                            </span>
                        </x-link>
                    </div>

                    <div class="mt-4">
                        <x-link href="{{ route('register') }}">
                            <span class="text-dark">
                                {{ __('Registrieren') }}
                            </span>
                        </x-link>
                    </div>
                </form>
            </x-app.dialog>
        @endauth
    </main>
</div>
