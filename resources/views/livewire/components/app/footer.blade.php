@php
    $clickAction = auth()->check() ? '$dispatch(\'open-line\')' : '$dispatch(\'open-login\')';
@endphp

<footer class="flex h-full flex-col items-center justify-center">
    <x-button class="bg-primary text-light" x-on:click="{{$clickAction}}">
        <span>Spruch erfassen</span>
    </x-button>

    @auth
        <x-app.dialog
            id="line"
            title="Spruch erfassen"
            @open-line.window="open"
        >
            <form class="text-dark" wire:submit.prevent="store" novalidate>
                <div class="mt-6">
                    <x-form.textarea
                        name="line"
                        rows="4"
                        id="line"
                        class="border-dark bg-light"
                        wire:model="line"
                    />
                </div>

                <div class="mt-8">
                    <x-button type="submit">
                        <span>{{ __('Spruch erfassen') }}</span>
                    </x-button>
                </div>
            </form>
        </x-app.dialog>
    @endauth
</footer>
