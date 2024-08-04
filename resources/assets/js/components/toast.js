document.addEventListener('alpine:init', () => {
    window.Alpine.data('toast', (message) => ({
        text: message.text,
        success: message.success,
        duration: message.duration || 3500,
        show: false,
        init: async function () {
            setTimeout(() => {
                this.show = true;
            }, 250);

            setTimeout(() => {
                this.show = false;
            }, this.duration);
        },
        close: function () {
            this.show = false;
        },
    }));
});
