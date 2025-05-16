import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig(({ command }) => ({
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        outDir: 'public/build/.vite',
        manifest: true,
        manifestPath: 'public/build/.vite/manifest.json',
        sourcemap: command === 'serve' ? true : false,
        cssMinify: true,
        manifest: true
    }
}));