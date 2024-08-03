document.addEventListener('alpine:init', () => {
    window.Alpine.data('header', (nickname) => ({
        init: async function () {},
    }));
});
