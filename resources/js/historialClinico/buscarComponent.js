import '../bootstrap'
import Vue from 'vue'
import buscarComponent from "./buscarComponent.vue";
import { ToastPlugin} from 'bootstrap-vue'
import Multiselect from 'vue-multiselect'
Vue.component('multiselect', Multiselect)
//Vue.use(ModalPlugin)
Vue.use(ToastPlugin)

new Vue({
    el: '#buscarComponent',
    //template: '<crear-component/>',
    components: {
        buscarComponent
    },
});