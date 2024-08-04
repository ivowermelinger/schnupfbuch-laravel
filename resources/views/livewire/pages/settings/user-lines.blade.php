<div>
    <x-app.header :$user />
    <x-page-heading>{{ __('Deine Sprüche') }}</x-page-heading>

    <div class="container">
        <div class="mt-10 text-center">
            <img
                class="mx-auto"
                src="{{ Vite::asset('resources/assets/images/work-in-progress.gif') }}"
            />
        </div>
    </div>
</div>
