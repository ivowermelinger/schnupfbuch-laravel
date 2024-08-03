document.addEventListener('alpine:init', () => {
    window.Alpine.data('app', (initialLines) => ({
        lines: initialLines,
        activeLine: initialLines.length > 0 ? initialLines[0] : null,
        count: 0,
        loading: false,
        init: function () {
            // Listen for Livewire event to update lines
            this.$wire.on('linesUpdated', (data) => {
                this.lines = data[0];
                this.activeLine = this.lines[0];
                this.count = 0;
                this.loading = false;
                console.log('Lines updated');
            });
        },
        nextLine: function () {
            this.count++;

            if (this.count >= this.lines.length) {
                this.loading = true;
                this.$wire.refreshLines();
                return;
            }

            const index = this.lines.indexOf(this.activeLine);
            this.activeLine = this.lines[index + 1] || this.lines[0];
        },
    }));
});
