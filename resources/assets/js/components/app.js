document.addEventListener('alpine:init', () => {
    window.Alpine.data('app', (initialLines) => ({
        lines: initialLines,
        activeLine: initialLines.length > 0 ? initialLines[0] : null,
        count: 0,
        loading: true,
        loadingFeedback: true,
        confetti: null,

        init: async function () {
            this.loading = false;
            this.loadingFeedback = false;

            const { default: confetti } = await import('canvas-confetti');
            this.confetti = confetti;

            // Listen for Livewire event to update lines
            this.$wire.on('allLinesUpdated', (data) => {
                this.lines = data[0];
                this.activeLine = this.lines[0];
                this.count = 0;
                this.loading = false;
                this.loadingFeedback = false;
            });

            // Listen for Livewire event to update one line after liking/disliking
            this.$wire.on('singleLineUpdated', (data) => {
                const line = data[0];
                this.activeLine = line;
                this.loading = false;
                this.loadingFeedback = false;
            });

            this.addView();
        },

        addView: function () {
            if (!this.activeLine) return;
            this.$wire.addView(this.activeLine.id);
        },

        nextLine: function () {
            if (this.loading || this.loadingFeedback) return;

            this.count++;

            if (this.count >= this.lines.length) {
                this.loading = true;
                this.$wire.refreshLines();
                return;
            }

            this.addView();
            this.activeLine = this.lines[this.count];
        },

        dislike: function () {
            this.loadingFeedback = true;

            const liked = false;
            const disliked = !this.activeLine.disliked;
            this.$wire.toggleLike(liked, disliked, this.activeLine.id);
        },

        like: function (){
            console.log('like');
            this.loadingFeedback = true;

            const liked = !this.activeLine.liked;

            const disliked = false;
            this.$wire.toggleLike(liked, disliked, this.activeLine.id);

            // Don't shoot confetti if disliked
            if (!liked) return;

            const random = (min, max) => Math.random() * (max - min) + min;

            if (!this.$refs.origin || !this.confetti || random(0, 100) > 50) {
                return;
            }

            const origin = this.$refs.origin.getBoundingClientRect();

            const x = (origin.left + origin.width / 2) / window.innerWidth;
            const y = (origin.top + origin.height) / window.innerHeight;

            this.confetti({
                particleCount: 25,
                startVelocity: 25,
                spread: 50,
                origin: { x, y },
            });
        },
    }));
});
