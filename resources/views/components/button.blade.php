<button
    {{ $attributes->merge(['class' => 'px-4 w-full border-0 py-3 md:py-4 text-content font-semibold rounded-lg duration-300 bg-primary text-light transition-all hover:bg-primary-hover hover:shadow-md']) }}
>
    {{ $slot }}
</button>
