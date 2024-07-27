import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { VitePWA } from 'vite-plugin-pwa';
import { svelte } from '@sveltejs/vite-plugin-svelte';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/scss/main.scss',
                'resources/assets/ts/app.ts',
            ],
            refresh: true,
        }),
        svelte({}),
        VitePWA({
            registerType: 'auto',
            injectRegister: null,
            outDir: 'public',
            manifest: false,
            strategies: 'generateSW',
            devOptions: {
                enabled: true,
            },
            workbox: {
                globPatterns: ['**/*.{js,css,ico,png,svg}'],
                navigateFallback: '/offline',
            },
        }),
    ],
});
