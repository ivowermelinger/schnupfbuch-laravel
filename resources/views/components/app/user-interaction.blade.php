<div x-data="userFeedback" class="flex h-full w-full justify-center gap-4">
    <button
        class="flex h-full w-full items-center justify-center"
        @click="like"
    >
        <span class="sr-only">{{ __('Dislike hinzufügen') }}</span>
        <x-icon.thumb class="w-10 md:w-14" x-ref="origin" />
    </button>

    <button class="flex h-full w-full items-center justify-center">
        <span class="sr-only">{{ __('Dislike hinzufügen') }}</span>
        <x-icon.thumb class="w-10 rotate-180 md:w-14" />
    </button>
</div>
