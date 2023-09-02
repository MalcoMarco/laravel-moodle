import { defineConfig } from "vite";
import laravel, { refreshPaths } from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue2";
//import Components from "unplugin-vue-components/vite";
//import { BootstrapVueNextResolver } from "unplugin-vue-components/resolvers";
export default defineConfig({
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        laravel({
            input: [
                "resources/css/app.css",
                "resources/scss/dashboard.scss",
                "resources/js/app.js",
               // "resources/js/example-component.js",
                "resources/js/silabus/requisitosComponent.js",
                "resources/js/silabus/listComponent.js",
                "resources/js/historialClinico/crearComponent.js",
                "resources/js/historialClinico/buscarComponent.js",
                "resources/js/egresado/egresadoComponent.js",
            ],
            refresh: [...refreshPaths, "app/Http/Livewire/**"],
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm.js',
        },
    },
});
