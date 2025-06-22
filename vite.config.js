import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
         input: [
                    'resources/css/app.css',
                    'resources/css/page_principale.css',
                    'resources/css/profil-admin.css',
                    'resources/js/app.js',
                ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
