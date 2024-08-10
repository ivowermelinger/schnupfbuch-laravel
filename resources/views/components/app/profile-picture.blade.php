@php
    $user = auth()->user();
@endphp

@if ($user)
    <span x-data="profilePicture('{{ $user->profile_seed }}')">
        <img
            {{ $attributes->merge(['class' => 'h-auto']) }}
            x-bind:src="avatar"
            alt="{{ __('Profilbild') }} {{ $user->nickname }}"
        />
    </span>
@endif
