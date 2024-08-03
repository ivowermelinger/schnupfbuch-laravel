@props([
    'user',
])

<button x-data="profilePicture('{{ $user->nickname }}')">
    <img
        {{ $attributes->merge(['class' => 'h-auto w-12 md:w-16']) }}
        x-bind:src="avatar"
        alt="{{ __('Profilbild') }} {{ $user->nickname }}"
    />
</button>
