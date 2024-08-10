<a
    {{ $attributes->merge(['class' => 'text-content inline-flex m-0 cursor-pointer items-center gap-2 bg-transparent text-center transition-colors hover:text-primary']) }}
>
    {{ $slot }}
</a>
