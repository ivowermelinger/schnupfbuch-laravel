import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { VitePWA } from "vite-plugin-pwa";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/assets/scss/main.scss",
                "resources/assets/ts/app.ts",
            ],
            refresh: true,
        }),
        VitePWA({
            registerType: "auto",
            injectRegister: null,
            outDir: "public",
            manifest: false,
            strategies: "generateSW",
            devOptions: {
                enabled: true,
            },
            workbox: {
                globPatterns: ["**/*.{js,css,ico,png,svg}"],
                navigateFallback: "/offline",
            },
        }),
    ],
});
