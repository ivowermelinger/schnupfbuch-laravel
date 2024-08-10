<div>
    <x-app.header />
    <div class="container text-center">
        <x-page-heading>{{ __('Sprüche zu prüfen') }}</x-page-heading>
    </div>
    <div class="container">
        <div class="my-10 flex flex-col text-content text-light">
            <div class="mb-8 text-center">
                <x-link wire:click="toggleFilter">
                    {{ __($filterActive ? 'Zu prüfende Sprüche' : 'Aktive Sprüche') }}
                    {{ __('anzeigen') }}
                </x-link>
            </div>

            @if ($lines->isEmpty())
                <div class="text-center text-lead">
                    {{ __('Keine Sprüche zu prüfen.') }}
                </div>
            @endif

            @foreach ($lines as $item)
                <div
                    class="m grid grid-cols-12 items-center gap-y-2 border-t py-4 text-small last:border-b"
                >
                    <div
                        class="col-span-12 flex justify-between gap-2 font-semibold lg:col-span-2 lg:flex-col lg:justify-start"
                    >
                        <span>
                            {{ $item->user->first_name }}
                            {{ $item->user->last_name }}
                        </span>
                        <span>{{ $item->user->nickname }}</span>
                    </div>

                    <div class="col-span-12 lg:col-span-8">
                        {!! $item->line !!}
                    </div>
                    <div class="col-span-12 lg:col-span-2">
                        <x-button
                            class="mt-4 lg:mt-0"
                            wire:click="toggleLineActive('{{ $item->id }}')"
                        >
                            <span>
                                {{ __($item->active ? 'Deaktivieren' : 'Freigeben') }}
                            </span>
                        </x-button>

                        <x-button
                            class="mt-4 lg:mt-0"
                            wire:click="revert('{{ $item->id }}')"
                            wire:confirm="Bist du dir sicher?"
                        >
                            <span>
                                {{ __($item->deleted_at ? 'Wiederherstellen' : 'Löschen') }}
                            </span>
                        </x-button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
