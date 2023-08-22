<template>
    <div class="w-100 mt-3">
        <Tablefilter @changePageSize="changePageSize" @changeQuery="changeQuery"></Tablefilter>
        <b-table responsive striped hover :items="pagination.data" :fields="fields" @sort-changed="sortChanged"
            :no-local-sorting="true" :busy="isBusy">
            <template #cell(#)="data">
                {{ data.index + pagination.from }}
            </template>
             <template #cell(Opciones)="data">
                <button  @click="verItem(data.item)" class="btn btn-link btn-sm me-3">
                    Ver
                </button>
                <a v-if="canReviewSilabo && data.item.status_guard_name =='ER'"
                    @click="editItem(data.item)" class="btn btn-link btn-sm me-3"
                    :href="'/silabus-review/'+data.item.id">
                    Revisión
                </a>
                <a v-if="data.item.status_guard_name =='D'"
                    @click="editItem(data.item)" class="btn btn-warning btn-sm me-3 text-white"
                    :href="'/silabus-observacion/'+data.item.id">
                    Observado
                </a>
                <button @click="deleteItem(data.item.id)" class="btn btn-link btn-sm text-danger">
                    Eliminar
                </button>
            </template> 
        </b-table>
        <div class="d-flex justify-content-end">
            <b-pagination v-model="pagination.current_page" :total-rows="pagination.total" :per-page="pagination.per_page"
                @change="getData" aria-controls="my-table"></b-pagination>
        </div>

        <b-modal v-model="modalVerSilabo" id="modal-xl" size="xl" :title="'Silabo: '+silabo.curso_name" hide-footer lazy>
            <div class="row">
                <div class="col-lg-4">
                    <div class="table">
                        <tr v-if="silabo.firstname || silabo.lastname">
                            <th>Docente:</th>
                            <td>{{ silabo.lastname +' '+ silabo.firstname }}</td>
                        </tr>
                        <tr>
                            <th>Curso:</th>
                            <td>{{ silabo.curso_name }}</td>
                        </tr>
                        <tr>
                            <th>Escuela:</th>
                            <td>{{ silabo.escuela }}</td>
                        </tr>
                        <tr>
                            <th>Ciclo:</th>
                            <td>{{ silabo.ciclo }}</td>
                        </tr>
                        <tr>
                            <th>Creditos:</th>
                            <td>{{ silabo.creditos }}</td>
                        </tr>
                        <tr>
                            <th>Horas teóricas:</th>
                            <td>{{ silabo.horas_teoricas }}</td>
                        </tr>
                        <tr>
                            <th>Horas practicas:</th>
                            <td>{{ silabo.horas_practicas }}</td>
                        </tr>                    
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="ratio ratio-4x3">
                        <iframe class="w-100 h-100" :src="silabo.pdf_url" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
import { BTable, BProgress, BPagination,BModal, VBModal, } from "bootstrap-vue";
import  Tablefilter from "../components/Tablefilter.vue";
export default {
    props: ["urlApiData",'permissions','roles'],
    components: { BTable, BProgress, BPagination, Tablefilter,BModal },
    directives: { "b-modal": VBModal },
    data() {
        return {
            pagination: { data: [], per_page: 15, current_page: 1, from: 1 },
            perPage:15,
            q:'',
            sortBy: "",
            sortDesc: true,
            fields: [
                "#",
                {
                    key: "curso_name",
                    sortable: true
                },
                {
                    key: "escuela",
                    sortable: true
                },
                {
                    key: "ciclo",
                    sortable: true
                },
                {
                    key: "status",
                    sortable: true
                },
                {
                    key: "updated_at",
                    label:'Actualizado',
                    sortable: true,
                    formatter: value => {
                        return this.formatTimetamp(value)
                    }
                },
                "Opciones",
            ],
            isBusy:false,
            canReviewSilabo:false,
            modalVerSilabo:false,
            silabo:{curso_name:'',escuela:'',ciclo:'',creditos:'',horas_teoricas:'',horas_practicas:'',pdf_url:''}
        };
    },
    created() {
        this.getData(1);
        let rolesJson = JSON.parse(this.roles)
        let permissionsJson = JSON.parse(this.permissions)
        if (rolesJson.includes('siteadmin') || permissionsJson.includes(' 	ru_gestion-silabus')) {
            this.canReviewSilabo=true
        }
    },
    methods: {
        getData(page = 1) {
            let params = {
                page: page,
                sortBy: this.sortBy,
                sortDesc: this.sortDesc,
                perPage: this.perPage,
                q:this.q
            };
            this.isBusy = true
            axios.get(this.urlApiData, { params }).then(res => {
                this.pagination = res.data;
            }).finally(() => {
                this.isBusy = false
            }) ;
        },
        editItem(event){
            console.log(event);
        },
        verItem(event){
            console.log(event);
            this.silabo = event
            this.modalVerSilabo=true
        },
        deleteItem(id){  
            this.$bvModal
                .msgBoxConfirm("Por favor, confirme que desea eliminar.", {
                    title: "Confirmar",
                    size: "sm",
                    buttonSize: "sm",
                    okVariant: "danger",
                    okTitle: "Si, eliminar",
                    cancelTitle: "No",
                    footerClass: "p-2",
                    hideHeaderClose: false,
                    centered: true
                })
                .then(value => {
                    axios.delete(`/silabus/${id}`).then(res => {
                        this.getData();
                        this.$bvToast.toast(res.data.message, {
                            title: `Eliminado`,
                            variant: 'success',
                            solid: true,
                            autoHideDelay: 5000,
                        })
                        
                    }).catch(err => {
                        let errorMsg = err.response?.data.message || ''
                        this.$bvToast.toast(errorMsg, {
                            title: `Ocurrio un Error`,
                            variant: 'danger',
                            solid: true,
                            autoHideDelay: 5000,
                        })
                    });
                })
                .catch(err => {
                    
                });
        },
        sortChanged(event) {
            this.sortBy = event.sortBy;
            this.sortDesc = event.sortDesc;
            this.getData(1);
        },
        changePageSize(event){
            this.perPage = event
            this.getData(1);
        },
        changeQuery(event){
            this.q = event
            this.getData(1);
        },
        formatTimetamp(timestamp){
            if (!timestamp) {
                return ''
            }
            // Parsea la fecha
            const parsedDate = new Date(timestamp);
            // Obtiene los componentes de la fecha y hora
            const year = parsedDate.getFullYear();
            const month = parsedDate.getMonth() + 1; // Los meses en JavaScript son base 0
            const day = parsedDate.getDate();
            const hours = parsedDate.getHours();
            const minutes = parsedDate.getMinutes();
            const seconds = parsedDate.getSeconds();
            // Función auxiliar para agregar un cero adelante si el valor es menor a 10
            const addLeadingZero = (value) => (value < 10 ? `0${value}` : value);

            // Formatea los valores con ceros adelante si es necesario
            const formattedMonth = addLeadingZero(month);
            const formattedDay = addLeadingZero(day);
            const formattedHours = addLeadingZero(hours);
            const formattedMinutes = addLeadingZero(minutes);
            const formattedSeconds = addLeadingZero(seconds);
            // Construye una cadena legible
            const readableDate = `${formattedDay}/${formattedMonth}/${year} ${formattedHours}:${formattedMinutes}:${formattedSeconds}`;
            return readableDate
        }
    }
};
</script>

<style lang="scss" scoped></style>
