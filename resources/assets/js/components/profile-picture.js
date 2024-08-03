document.addEventListener('alpine:init', () => {
    window.Alpine.data('profilePicture', () => ({
        init: async function () {
            const creator = await import('@dicebear/core');
            const styles = await import('@dicebear/collection');
        },
    }));
});
