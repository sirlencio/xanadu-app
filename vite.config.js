import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/js/scroll-to-top.js'
            ],
            refresh: true,
        }),
    ],
    base: process.env.ASSET_URL ? new URL('/build/', process.env.ASSET_URL).toString() : '/build/',
});
