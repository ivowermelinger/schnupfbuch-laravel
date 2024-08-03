<header class="bg-dark fixed left-0 top-0 z-50 w-full py-2 shadow-md">
    <div class="container">
        @auth
            <button class="header__user">
                <span class="visually-hidden">Sidebar öffnen</span>
                cooles user picture
            </button>
        @else
            <div class="header__login">
                <x-link href="{{ route('login') }}" class="py-2">
                    <x-icon.login class="w-6" />
                    <span>Login</span>
                </x-link>
            </div>
        @endauth
    </div>
</header>

<x-sidebar />
