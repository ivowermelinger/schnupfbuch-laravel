@if (session()->has('message'))
    <div x-data="toast({{ session()->get('message')->toJson() }})" x-cloak>
        <div
            x-show="show"
            x-transition:enter="translate-x-full transition duration-300 ease-out"
            x-transition:enter-start="translate-x-full md:translate-x-full"
            x-transition:leave="top-10 translate-x-full md:right-0 md:translate-x-full transition duration-300 ease-in"
            x-transition:leave-end="translate-x-full right-0"
            class="fixed top-10 right-2/4 z-50 w-full translate-x-2/4 max-w-xs md:right-10 md:translate-x-0 rounded-md p-4 md:max-w-md"
            :class="success ? 'bg-success' : 'bg-error'"
        >
            <div class="flex items-center gap-2">
                <div x-text="text" class="text-light w-full"></div>

                <button x-on:click="close">
                    <span class="sr-only">{{ __('Information schliessen')}}</span>
                    <x-icon.close class="w-7 h-7 text-light"></x-icon>
                </button>
            </div>
        </div>
    </div>
@endif
