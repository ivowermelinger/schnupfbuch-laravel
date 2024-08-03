document.addEventListener('alpine:init', () => {
    window.Alpine.data('dialog', () => ({
        show: false,
        open: function () {
            this.show = true;
        },
        close: function () {
            this.show = false;
        },
    }));
});
