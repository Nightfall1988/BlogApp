import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import autoprefixer from 'autoprefixer';
import tailwindcss from 'tailwindcss';

export default defineConfig({
    plugins: [
        laravel({
            input: {
                app: 'resources/js/app.js'
            },
        }),
    ],
    css: {
        postcss: {
            plugins: [
                tailwindcss,
                autoprefixer,
            ],
        },
    },
    build: {
        outDir: 'public/build',
        assetsInlineLimit: 0,
        manifest: true,
        rollupOptions: {
            output: {
                entryFileNames: 'assets/[name].js',
                chunkFileNames: 'assets/[name]-[hash].js',
                assetFileNames: ({ name }) => (name.endsWith('.css') ? 'assets/[name].css' : 'assets/[name]-[hash][extname]'),
            },
        },
        cssCodeSplit: {
            filename: 'assets/app.css',
        },
    },
});
