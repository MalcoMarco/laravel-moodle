import "./bootstrap";
//import { createApp } from "vue";
//import { createApp } from 'vue/dist/vue.runtime.esm-bundler';
import { createApp } from 'vue/dist/vue.esm-bundler';
import exampleComponent from "./components/example.vue";

const app = createApp();
app.component("exampleComponent", exampleComponent);
app.mount("#example");
