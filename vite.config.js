import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path'

function renameHtmlToPhpPlugin() {
    return {
        name: 'rename-html-to-php',
        enforce: 'post',
        apply: 'build',
        generateBundle(options, bundle) {
            const htmlFile = bundle['index.html'];
            if (htmlFile) {
                // Создаем файл index.php с тем же содержимым
                bundle['index.php'] = {
                    ...htmlFile,
                    fileName: 'index.php',
                    source: htmlFile.source,
                };

                // Удаляем оригинальный index.html
                delete bundle['index.html'];
            }
        },
    };
}


export default defineConfig({
    plugins: [
        laravel({
            input: [
              'resources/js/app.js',
              'resources/css/index.css'
            ],
            ssr: 'resources/js/ssr.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        renameHtmlToPhpPlugin(),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources'),
        },
    },
    envPrefix: 'RECAPTCHA_',
});

