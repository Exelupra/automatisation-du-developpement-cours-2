// vite.config.js
import { defineConfig } from 'vite';

export default defineConfig({
    root: 'public',
    base: '/assets/',
    server: {
        proxy: {
            '/': {
                target: 'http://localhost',  // Changez en fonction de votre serveur PHP
                ws: true,
                changeOrigin: true,
            },
        },
    },
    build: {
        outDir: 'public/assets',
        assetsDir: '', // Pour éviter la création d'un sous-dossier "assets" dans outDir
    },
});
