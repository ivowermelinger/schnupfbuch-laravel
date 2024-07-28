import { createInertiaApp } from '@inertiajs/svelte';

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob('../../Pages/**/*.svelte', {
            eager: true,
        });
        console.log(pages);
        return pages[`../../Pages/${name}.svelte`];
    },
    setup({ el, App, props }) {
        new App({ target: el, props });
    },
});
