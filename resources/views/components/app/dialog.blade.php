<div
    x-data="dialog"
    x-show="show"
    x-cloak
    {{ $attributes->merge(['class' => 'fixed flex-col justify-evenly items-end inset-0 h-full w-full flex z-50 backdrop-blur-sm ']) }}
>
    <button class="h-full w-full" x-on:click="close">
        <span class="sr-only">{{ __('Dialog schliessen') }}</span>
    </button>
    <div
        x-show="show"
        x-transition:enter="translate-y-full transition duration-300 ease-out"
        x-transition:enter-start="translate-y-full"
        x-transition:enter-end="translate-y-0 "
        x-transition:leave="translate-y-full transition duration-300 ease-out"
        class="bg-light text-dark container w-full translate-y-0 rounded-t-lg py-4"
    >
        <div class="mb-4 flex items-center justify-between">
            <h3 class="text-heading font-bold">
                {{ $attributes->get('title') ?? '' }}
            </h3>
            <button x-on:click="close">
                <span class="sr-only">{{ __('Dialog schliessen') }}</span>
                <x-icon.close class="w-8" />
            </button>
        </div>

        <div class="text-content w-full">
            {{ $slot }}
        </div>
    </div>
</div>
