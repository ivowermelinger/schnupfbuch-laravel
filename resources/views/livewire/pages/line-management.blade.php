<div class="container" wire:model="filter">
    <div class="row spacer--mt-2">
        <div class="col-12">
            <h1 class="text__title spacer--mb-2">hello there</h1>

            <button x-on:click="location.href = location.href + '?active=0'">
                nur zu prüfen
            </button>

            <x-lines.list>
                @foreach ($lines as $line)
                    <x-lines.item :key="$line->id" :$line />
                @endforeach
            </x-lines.list>
        </div>
    </div>
</div>
