<div class="flex h-full w-full justify-center gap-4">
    <button
        class="flex h-full w-full items-center justify-center"
        @auth
            x-on:click="like"
        @else
            x-on:click="$dispatch('open-login')"
        @endauth
    >
        <span class="sr-only">{{ __("Dislike hinzufügen") }}</span>
        <span
            class="transition-all"
            :class="{'text-active': activeLine?.liked}"
        >
            <x-icon.thumb class="w-10 md:w-14" x-ref="origin" />
        </span>
    </button>

    <button
        class="flex h-full w-full items-center justify-center"
        @auth
            x-on:click="dislike"
        @else
            x-on:click="$dispatch('open-login')"
        @endauth
    >
        <span class="sr-only">{{ __("Dislike hinzufügen") }}</span>
        <span
            class="transition-all"
            :class="{'text-active': activeLine?.disliked}"
        >
            <x-icon.thumb class="w-10 rotate-180 md:w-14" />
        </span>
    </button>
</div>
