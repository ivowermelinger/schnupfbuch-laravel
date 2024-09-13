@props([
    'inverted' => false,
])
@php
    $classes =
        'px-4 w-full  py-3 md:py-4 text-content font-semibold rounded-lg duration-300 text-light transition-all hover:shadow-md ';
    $classes .= $inverted
        ? 'border border-primary text-primary hover:text-primary-hover hover:border-primary-hover'
        : 'bg-primary border-0 text-light hover:bg-primary-hover';
@endphp

<button
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</button>
