@props([
    'user',
])

@php
    $itemClasses = 'first:border-t border-light border-b ';
    $linkClasses = 'text-lead  flex items-center gap-4 py-4 font-semibold ';
@endphp

@if ($user)
    <aside
        x-show="showSidebar"
        x-transition:enter="transition duration-300 ease-out"
        class="fixed left-0 top-0 z-40 h-full w-full backdrop-blur-sm"
        x-cloak
    >
        <div
            x-show="showSidebar"
            x-transition:enter="-translate-x-full transition duration-300 ease-out"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0 "
            x-transition:leave-start="translate-x-0"
            x-transition:leave="-translate-x-full transition duration-300 ease-out"
            @click.outside="close"
            class="bg-primary text-light flex h-full w-80 max-w-full flex-col md:w-96 xl:w-3/12"
        >
            <div class="container">
                <div class="flex flex-col items-center justify-center py-8">
                    <span class="text-heading">
                        Hi, {{ $user->nickname }}!
                    </span>
                    <div class="mt-6">
                        <x-app.profile-picture class="w-20" :$user />
                    </div>

                    <nav class="mt-12 w-full">
                        <ul class="flex w-full flex-col">
                            <li class="{{ $itemClasses }}">
                                <a
                                    href="{{ route('settings') }}"
                                    class="{{ $linkClasses }}"
                                >
                                    <x-icon.settings class="w-7" />
                                    <span>{{ __('Profil') }}</span>
                                </a>
                            </li>
                            <li class="{{ $itemClasses }}">
                                <a
                                    href="{{ route('logout') }}"
                                    class="{{ $linkClasses }}"
                                >
                                    <x-icon.logout class="w-6" />
                                    <span>{{ __('Logout') }}</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </aside>
@endif
