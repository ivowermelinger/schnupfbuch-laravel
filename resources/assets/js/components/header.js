document.addEventListener('alpine:init', () => {
    window.Alpine.data('header', () => ({
        showSidebar: true,
        init: async function () {},

        open: function () {
            this.showSidebar = true;
        },

        close: function () {
            this.showSidebar = false;
        },
    }));
});
