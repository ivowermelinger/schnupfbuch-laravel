@props([
    'user',
])

@php
    $itemClasses = 'first:border-t border-light border-b ';
    $linkClasses =
        'text-lead  flex items-center gap-6 py-4 font-semibold transition-all hover:pl-6 ';
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
            x-on:click.outside="close"
            class="flex h-full w-80 max-w-full flex-col bg-primary text-light md:w-96 xl:w-3/12"
        >
            <div class="container py-8">
                <div class="flex justify-end">
                    <button x-on:click="close">
                        <span class="sr-only">
                            {{ __('Sidebar schliessen') }}
                        </span>
                        <x-icon.close class="w-8 text-light" />
                    </button>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <div class="mt-6">
                        <x-app.profile-picture class="w-20" :$user />
                    </div>

                    <span class="my-6 text-heading">
                        Hi, {{ $user->nickname }}!
                    </span>

                    <nav class="mt-12 w-full">
                        <ul class="flex w-full flex-col">
                            <li class="{{ $itemClasses }}">
                                <a
                                    href="{{ route('home') }}"
                                    class="{{ $linkClasses }}"
                                >
                                    <x-icon.planet class="w-7" />
                                    <span>{{ __('Start') }}</span>
                                </a>
                            </li>
                            <li class="{{ $itemClasses }}">
                                <a
                                    href="{{ route('settings.lines') }}"
                                    class="{{ $linkClasses }}"
                                >
                                    <x-icon.snuff class="h-7" />
                                    <span>{{ __('Deine Sprüche') }}</span>
                                </a>
                            </li>
                            <li class="{{ $itemClasses }}">
                                <a
                                    href="{{ route('settings.index') }}"
                                    class="{{ $linkClasses }}"
                                >
                                    <x-icon.settings class="w-7" />
                                    <span>{{ __('Account') }}</span>
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
