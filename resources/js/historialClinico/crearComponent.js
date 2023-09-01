import '../bootstrap'
import Vue from 'vue'
import crearComponent from "./crearComponent.vue";
import { ToastPlugin} from 'bootstrap-vue'
import Multiselect from 'vue-multiselect'
Vue.component('multiselect', Multiselect)
//Vue.use(ModalPlugin)
Vue.use(ToastPlugin)

new Vue({
    el: '#crearHistorialClinico',
    //template: '<crear-component/>',
    components: {
        crearComponent
    },
});