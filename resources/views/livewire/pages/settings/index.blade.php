<div>
    <x-app.header :$user />
    <div class="container">
        <x-page-heading>{{ __('Account') }}</x-page-heading>
    </div>

    <div class="container">
        <div class="mt-10 text-center">
            <img
                class="mx-auto"
                src="{{ Vite::asset('resources/assets/images/work-in-progress.gif') }}"
            />
        </div>
    </div>
</div>
