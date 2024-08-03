<header class="header" id="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @auth
                    <button class="header__user">
                        <span class="visually-hidden">Sidebar öffnen</span>
                        cooles user picture
                    </button>
                @else
                    <div class="header__login">
                        <a
                            href="{{ route('login') }}"
                            class="btn btn--icon-filled btn--header"
                        >
                            <x-icon.login class="w-8" />
                            <span>Login</span>
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>

<x-sidebar />
