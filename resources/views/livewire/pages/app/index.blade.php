<main
    class="main--app bg-dark text-light container grid grid-cols-none grid-rows-12 pb-4 pt-20"
    x-data="app({{ $lines->toJson() }})"
    wire:ignore
>
    <div class="relative row-span-10 grid grid-rows-10">
        <div class="row-span-8">
            <button
                @click="nextLine"
                class="x-cloak relative flex h-full w-full flex-col items-center justify-center"
            >
                <span
                    class="text-lead text-light font-bold"
                    x-text="activeLine.line"
                ></span>
                <span
                    class="text-lead text-light mt-4 font-light"
                    x-text="activeLine.nickname"
                ></span>
            </button>
        </div>

        <div class="row-span-2">
            <x-app.user-interaction />
        </div>

        <div
            x-show="loading"
            x-transition
            class="bg-dark absolute inset-0 flex items-center justify-center"
        >
            <div class="spinner text-primary">
                <div></div>
                <div></div>
            </div>
        </div>
    </div>

    <div class="row-span-2">
        <livewire:components.app.footer />
    </div>
</main>
