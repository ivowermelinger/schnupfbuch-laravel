<div>
    <x-app.header />
    <div class="container text-center">
        <x-page-heading>{{ __('Sprüche zu prüfen') }}</x-page-heading>
    </div>
    <div class="container">
        <div class="my-10 flex flex-col text-content text-light">
            <div class="mb-8 grid gap-4 md:grid-cols-6">
                <div class="col-span-4">
                    <x-form.input
                        type="search"
                        wire:model="query"
                        label="{{ __('Suche') }}"
                        class="border-light bg-dark text-light"
                        placeholder="{{ __('User, Spruch...') }}"
                        wire:input.throttle="loadLines()"
                    />
                </div>
                <div class="col-span-2">
                    <x-form.dropdown
                        type="dropdopw"
                        wire:model="filter"
                        label="{{ __('Filter') }}"
                        class="border-light bg-dark text-light"
                        wire:change="loadLines()"
                    >
                        <option value="active">{{ __('Aktive') }}</option>
                        <option value="inactive">
                            {{ __('Deaktiviert') }}
                        </option>
                    </x-form.dropdown>
                </div>
            </div>

            @if ($lines->isEmpty())
                <div class="text-center text-lead">
                    {{ __('Keine Sprüche zu prüfen.') }}
                </div>
            @endif

            @foreach ($lines as $item)
                <div
                    :key="$item->id"
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
                        @unless ($item->trashed())
                            <x-button
                                class="mt-4 lg:mt-0"
                                wire:click="toggleLineActive('{{ $item->id }}')"
                            >
                                <span>
                                    {{ __($item->active ? 'Deaktivieren' : 'Freigeben') }}
                                </span>
                            </x-button>
                        @else
                            <x-button
                                class="bg-white mt-4"
                                :inverted="true"
                                wire:click="forceRemove('{{ $item->id }}')"
                                wire:confirm="{{ __('Bist du dir sicher, dass du diesen Spruch entgültig löschen willst?') }}"
                            >
                                <span>
                                    {{ __('Entgültig löschen') }}
                                </span>
                            </x-button>
                        @endunless

                        <x-button
                            class="mt-4"
                            wire:click="remove('{{ $item->id }}')"
                            wire:confirm="{{ __('Bist du dir sicher?') }}"
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
