<div>
    <label
        for="{{ $attribtues['id'] ?? '' }}"
        class="block text-sm font-medium leading-5 text-gray-700"
    >
        {{ $attribtues['label'] ?? '' }}
    </label>

    <div class="mt-1 rounded-md">
        <input
            {{ $attributes }}
            autofocus
            class="@error('name') focus:ring-red @enderror block w-full appearance-none rounded-md border px-3 py-2 text-red-900 duration-150 ease-in-out focus:outline-none sm:text-sm sm:leading-5"
        />
    </div>

    @error('name')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
