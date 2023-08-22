import '../bootstrap'
import Vue from 'vue'
import requisitosComponent from "./requisitos.vue";
//import { BootstrapVue } from 'bootstrap-vue'
//Vue.use(BootstrapVue)
import { ModalPlugin } from 'bootstrap-vue'
Vue.use(ModalPlugin)
new Vue({
    el: '#requisitos-component',
    template: '<requisitos-component/>',
    components: {
        requisitosComponent
    },
});