import '../bootstrap'
import Vue from 'vue'
import listComponent from "./list.vue";
import { ModalPlugin , ToastPlugin} from 'bootstrap-vue'
Vue.use(ModalPlugin)
Vue.use(ToastPlugin)

new Vue({
    el: '#list-component',
    //template: '<list-component/>',
    components: {
        listComponent
    },
});