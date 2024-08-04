<div
    x-data="dialog"
    x-show="show"
    x-cloak
    {{ $attributes->merge(['class' => 'fixed items-end inset-0 h-full w-full flex z-50 backdrop-blur-sm ']) }}
>
    <div
        x-show="show"
        x-transition:enter="translate-y-full transition duration-300 ease-out"
        x-transition:enter-start="translate-y-full"
        x-transition:enter-end="translate-y-0 "
        x-transition:leave="translate-y-full transition duration-300 ease-out"
        @click.outside="close"
        class="container w-full translate-y-0 rounded-t-lg bg-light py-8 text-dark"
    >
        <div class="mb-8 flex items-center justify-between">
            <h3 class="text-heading font-bold">
                {{ $attributes->get('title') ?? '' }}
            </h3>
            <button @click="close" clsas="z-10">
                <span class="sr-only">{{ __('Dialog schliessen') }}</span>
                <x-icon.close class="w-8" />
            </button>
        </div>

        <div class="w-full text-content">
            {{ $slot }}
        </div>
    </div>
</div>
