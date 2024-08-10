@inject('navigationService', 'App\Services\NavigationService')

@php
    $navItems = $navigationService->getNavigationItems();
    $user = auth()->user();
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
                            @foreach ($navItems as $item)
                                <li
                                    class="border-b border-light first:border-t"
                                >
                                    <a
                                        href="{{ $item->route }}"
                                        @class([
                                            'font-bold text-dark' => $item->active,
                                            'text-lead flex items-center gap-6 py-4 font-semibold transition-all hover:pl-6 ',
                                        ])
                                    >
                                        <x-dynamic-component
                                            :component="'icon.'.$item->icon"
                                            class="w-7"
                                        />
                                        <span>{{ __($item->name) }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </aside>
@endif
