<main
    class="main--app bg-dark text-light container grid grid-cols-none grid-rows-12 pb-4 pt-20"
    x-data="app"
>
    <button class="row-span-8 text-center">
        <span class="text-content text-light" data-id="{$activeLine.id}">
            activeLine
        </span>
        <span class="text-content text-light mt-4">nickname</span>
    </button>

    <div class="row-span-2">
        <livewire:components.app.user-interaction />
    </div>

    <div class="row-span-2">
        <livewire:components.app.footer />
    </div>
</main>
