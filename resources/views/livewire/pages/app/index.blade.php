<main class="main">
    <div class="full-height container">
        <div class="row full-height">
            <div class="col-12">
                <div class="touch__area">
                    <button class="btn btn--loading touch__trigger">
                        <span class="touch__line" data-id="{$activeLine.id}">
                            {$activeLine.line}
                        </span>
                        <span class="touch__author">
                            {$activeLine.nickname}
                        </span>
                    </button>
                    <div class="row">
                        <div class="col-6">
                            <livewire:components.app.like-button />
                        </div>
                        <div class="col-6">
                            <livewire:components.app.dislike-button />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
