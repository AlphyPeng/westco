import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import path from 'path'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/main.js'],
            refresh: true,
        }),
        tailwindcss(),
        vue()
    ],

    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
        }
    },

    build: {
        outDir: 'dist',
        sourcemap: false,
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['vue', 'vue-router', 'pinia'],
                    bootstrap: ['bootstrap', 'bootstrap-vue-next'],
                    charts: ['chart.js', 'vue-chartjs'],
                    icons: [
                        '@fortawesome/fontawesome-svg-core',
                        '@fortawesome/free-solid-svg-icons',
                        '@fortawesome/vue-fontawesome'
                    ]
                }
            }
        }
    },

    css: {
        preprocessorOptions: {
            scss: {
                silenceDeprecations: [
                    'legacy-js-api',
                    'import',
                    'global-builtin',
                    'mixed-decls',
                    'color-functions',
                    'slash-div'
                ]
            }
        }
    },

    optimizeDeps: {
        include: [
            'vue',
            'vue-router',
            'pinia',
            'bootstrap',
            'bootstrap-vue-next',
            'chart.js',
            'vue-chartjs',
            '@fortawesome/fontawesome-svg-core',
            '@fortawesome/free-solid-svg-icons',
            '@fortawesome/vue-fontawesome'
        ]
    },

    define: {
        __VUE_OPTIONS_API__: true,
        __VUE_PROD_DEVTOOLS__: false,
        __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: false
    }
});
