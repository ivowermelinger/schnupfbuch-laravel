<div x-data="userFeedback" class="flex w-full justify-center gap-4">
    <button class="flex w-full items-center justify-center" @click="fire">
        <span class="sr-only">{{ __('Dislike hinzufügen') }}</span>
        <x-icon.thumb class="w-10 md:w-14" x-ref="origin" />
    </button>
    <button class="flex w-full items-center justify-center">
        <span class="sr-only">{{ __('Dislike hinzufügen') }}</span>
        <x-icon.thumb class="w-10 rotate-180 md:w-14" />
    </button>
</div>
