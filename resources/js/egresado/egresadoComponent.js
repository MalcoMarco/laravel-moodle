import '../bootstrap'
import Vue from 'vue'
import egresadoComponent from "./egresado.vue";
import { ToastPlugin} from 'bootstrap-vue'
import Multiselect from 'vue-multiselect'
Vue.component('multiselect', Multiselect)
//Vue.use(ModalPlugin)
Vue.use(ToastPlugin)

new Vue({
    el: '#egresadoComponent',
    components: {
        egresadoComponent
    },
});