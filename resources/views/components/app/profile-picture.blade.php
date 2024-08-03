@props([
    'user',
])
@if ($user)
    <span x-data="profilePicture('{{ $user->nickname }}')">
        <img
            {{ $attributes->merge(['class' => 'h-auto']) }}
            x-bind:src="avatar"
            alt="{{ __('Profilbild') }} {{ $user->nickname }}"
        />
    </span>
@endif
