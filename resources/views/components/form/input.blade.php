<div>
    <label
        for="{{ $attributes->get('id', '') }}"
        class="text-content font-medium"
    >
        {{ $attributes->get('label', '') }}
    </label>

    <div class="mt-1 rounded-md">
        <input
            {{
                $attributes->merge(['class' => 'border-2 text-content block w-full appearance-none rounded-md m-0 py-2 px-2 focus:outline-none'])->class([
                    'border-error' => $errors->has($attributes->get('name')),
                ])
            }}
        />
    </div>

    @error($attributes->get('name'))
        <p class="text-small text-error mt-2">{{ $message }}</p>
    @enderror
</div>
