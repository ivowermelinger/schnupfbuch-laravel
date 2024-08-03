@props([
    'user',
])

<header
    x-data="header"
    class="bg-dark fixed left-0 top-0 z-30 w-full py-2 shadow-md md:py-4"
>
    <div class="container">
        @auth
            <button class="header__user">
                <span class="sr-only">Sidebar öffnen</span>
                <button @click="open">
                    <x-app.profile-picture class="w-12 md:w-16" :$user />
                </button>
            </button>
        @else
            <div class="header__login">
                <x-button
                    x-data
                    @click="$dispatch('open-login')"
                    class="text-light inline-flex items-center gap-2 py-2"
                >
                    <x-icon.login class="w-8" />
                    <span class="text-light">Login</span>
                </x-button>
            </div>
        @endauth
    </div>

    <x-app.sidebar :$user />
</header>
