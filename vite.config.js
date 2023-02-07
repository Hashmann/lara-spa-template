import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

import { quasar, transformAssetUrls } from '@quasar/vite-plugin'

import vueI18n from '@intlify/vite-plugin-vue-i18n'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        // vue({
        //     template: {
        //         transformAssetUrls: {
        //             base: null,
        //             includeAbsolute: false,
        //         },
        //     },
        // }),
        vue({
            template: { transformAssetUrls }
        }),
        quasar({
            sassVariables: 'resources/quasar-variables.sass'
        }),
        vueI18n({
            // if you want to use Vue I18n Legacy API, you need to set `compositionOnly: false`
            // compositionOnly: false,

            // you need to set i18n resource including paths !
            // include: resolve(dirname(fileURLToPath(import.meta.url)), './path/to/src/locales/**'),
            // include: path.resolve(__dirname, 'resources/js/i18n/')
        })
    ],
    // assetsInclude: ['**/*.png'],
    publicDir: 'public/storage',
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },

});
