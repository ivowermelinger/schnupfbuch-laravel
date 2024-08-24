<div>
    <x-app.header />

    <main
        class="main--app container mt-20 grid grid-cols-none grid-rows-12 bg-dark pb-4 text-light"
    >
        <div
            class="relative row-span-11 grid grid-rows-11"
            x-data="app({{ $lines->toJson() }})"
            wire:ignore
        >
            <div class="row-span-9">
                <button
                    x-on:click="nextLine"
                    class="x-cloak relative flex h-full w-full flex-col items-center justify-center overflow-auto py-8"
                >
                    <span
                        x-show="activeLine"
                        class="select-none text-lead font-bold leading-none text-light"
                        x-html="activeLine?.line"
                    ></span>
                    <span
                        class="mt-4 select-none text-lead font-light text-light"
                        x-text="activeLine?.nickname"
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
                        <x-button type="submit">
                            <span>{{ __('Login') }}</span>
                        </x-button>
                    </div>

                    <div class="mt-6">
                        <x-link
                            href="{{ route('password.request') }}"
                            class="text-dark"
                        >
                            <span>{{ __('Passwort vergessen?') }}</span>
                        </x-link>
                    </div>

                    <div class="mt-4">
                        <x-link
                            href="{{ route('register') }}"
                            class="text-dark"
                        >
                            <span>{{ __('Registrieren') }}</span>
                        </x-link>
                    </div>
                </form>
            </x-app.dialog>
        @endauth
    </main>
</div>
