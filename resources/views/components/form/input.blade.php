<div>
    <label
        for="{{ $attributes->get('id', '') }}"
        class="text-content font-semibold"
    >
        <span>{{ $attributes->get('label', '') }} @if ($attributes->has('required')) <span class="text-white">*</span> @endif</span></span>
    </label>

    @if ($attributes->has('hint'))
        <p class="text-small">{{ $attributes->get('hint') }}</p>
    @endif

    <div class="mt-2">
        <input
            {{
                $attributes->merge(['class' => 'transition-colors border-2 font-medium text-content block w-full appearance-none rounded-lg m-0 py-3 px-2 focus:border-focus focus:outline-none focus:ring-0 md:py-3'])->class([
                    'border-error' => $errors->has($attributes->get('name')),
                ])
            }}
        />
    </div>

    @error($attributes->get('name'))
        <p class="text-small text-error mt-2">{{ $message }}</p>
    @enderror
</div>
