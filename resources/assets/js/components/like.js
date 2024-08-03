document.addEventListener('alpine:init', () => {
    window.Alpine.data('userFeedback', () => ({
        confetti: null,
        init: async function () {
            const { default: confetti } = await import('canvas-confetti');
            this.confetti = confetti;
        },
        fire: function () {
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
