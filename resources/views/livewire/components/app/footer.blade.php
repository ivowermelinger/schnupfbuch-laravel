<footer
    class="flex h-full flex-col items-end justify-end"
    @auth
        @click="$dispatch('open-line')"
    @else
        @click="$dispatch('open-login')"
    @endauth
>
    <x-button class="bg-primary text-light">
        <span>Spruch erfassen</span>
    </x-button>

    @auth
        <x-app.dialog
            id="line"
            title="Spruch erfassen"
            @open-line.window="open"
        >
            <div class="text-dark my-8">
                <form wire:submit.prevent="store" novalidate>
                    <div class="mt-6">
                        <x-form.textarea
                            name="line"
                            rows="4"
                            id="line"
                            class="bg-light border-dark"
                            wire:model="line"
                        />
                    </div>

                    <div class="mt-8">
                        <x-button type="submit" class="bg-primary text-light">
                            <span>{{ __("Spruch erfassen") }}</span>
                        </x-button>
                    </div>
                </form>
            </div>
        </x-app.dialog>
    @endauth
</footer>
