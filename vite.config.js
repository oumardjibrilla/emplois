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
                    'resources/css/page_profil_recruteur.css',
                    'resources/css/profil_candidat.css',
                    'resources/css/entete_information.css',
                    'resources/css/ajot-offre-recruteur.css',
                    'resources/css/page-entete.css',
                    'resources/js/app.js',
                    'resources/js/page-principale.js',
                    'resources/js/js-recruteur.js',
                    'resources/js/page-admin.js',
                ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
