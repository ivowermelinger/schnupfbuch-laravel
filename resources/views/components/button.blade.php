<button
    {{ $attributes->merge(['class' => 'w-full border-0 py-3 md:py-4 text-content font-semibold rounded-lg']) }}
>
    {{ $slot }}
</button>
