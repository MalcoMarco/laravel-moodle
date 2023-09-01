<template>
    <div>
        <h5 class="text-center">Buscar Historial Clínico</h5>
        <label for="buscarusuario">selecione usuario</label>
        <multiselect
            v-model="selectedusers"
            id="buscarusuario"
            label="firstname"
            track-by="firstname"
            placeholder="Buscar usuario..."
            :options="users"
            :searchable="true"
            :loading="isLoading"
            :internal-search="false"
            :clear-on-select="false"
            @search-change="asyncFind"
            @select="selectedEvent"
        >
            <template slot="singleLabel" slot-scope="props">
                <div class="d-flex gap-3 align-items-center">
                    <img
                        class="option__image"
                        :src="props.option.picture_url"
                        style="width: 40px; height: 40px;"
                    />
                    <div class="option__desc">
                        <span class="option__title">
                            {{
                                props.option.firstname +
                                    " " +
                                    props.option.lastname
                            }}
                        </span>
                    </div>
                </div>
            </template>
            <template slot="option" slot-scope="props">
                <div class="d-flex gap-3 align-items-center">
                    <img
                        class="option__image"
                        :src="props.option.picture_url"
                        style="width: 40px; height: 40px;"
                    />
                    <div class="option__desc">
                        <span class="option__title">
                            {{
                                props.option.firstname +
                                    " " +
                                    props.option.lastname
                            }}
                        </span>
                    </div>
                </div>
            </template>
            <template slot="noOptions">
                <span></span>
            </template>
            <template slot="noResult">
                <span></span>
            </template>
        </multiselect>
        <div class="text-">
            <button @click="getHistorial()" class="btn btn-primary mt-4">Buscar</button>
        </div>
        <p v-if="busy">cargando datos...</p>
        <template v-if="!busy">
            <div class="w-100 mt-4">
                <div v-if="selectedusers.id">
                    <div
                        class="w-100 d-flex justify-content-center mt-4 mb-2"
                        style="height: 100px;"
                    >
                        <img :src="selectedusers.picture_url" />
                    </div>
                    <table class="table mb-3" v-show="selectedusers.id">
                        <tr>
                            <th>Apellidos y Nombres</th>
                            <td>
                                {{ selectedusers.firstname }}
                                {{ selectedusers.lastname }}
                            </td>
                        </tr>
                        <tr>
                            <th>Movil 1</th>
                            <td>{{ selectedusers.phone1 }}</td>
                        </tr>
                        <tr>
                            <th>Movil 2</th>
                            <td>{{ selectedusers.phone2 }}</td>
                        </tr>
                        <tr>
                            <th>Dirección</th>
                            <td>{{ selectedusers.address }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ selectedusers.email }}</td>
                        </tr>
                    </table>
                </div>
                
                <hr>
                <h6 v-if="historial.data.length" class="text-center">Historial Clínico</h6>
                <div v-for="(item,i) in historial.data" :key="'h'+i"  class="border p-4 mb-1">
                    <h6><b>Fecha Consulta: </b>{{ item.fecha_consulta }} - {{ item.hora_consulta }} </h6>
                    <table class="table">
                        <tr>
                            <th>Talla</th>
                            <th>Peso</th>
                            <th>MC</th>
                            <th>Grupo Sanguineo</th>
                            <th>Alergia</th>
                            <th>Enfermedades</th>
                        </tr>
                        <tr>
                            <td>{{ item.talla }}</td>
                            <td>{{item.peso}}</td>
                            <td>{{item.mc}}</td>
                            <td>{{item.grupo_sanguineo}}</td>
                            <td>{{item.alergia?'Si':'No'}}, {{ item.alergia_especifique }}</td>
                            <td>{{item.enfermedad}} {{ item.enfermedad_especifique }}</td>
                        </tr>
                    </table>
                    <table class="table">
                        <tr>
                            <th>Motivo</th>
                            <th>Examen físico</th>
                            <th>Diagnostico</th>
                            <th>Tratamiento</th>
                            <th>Observación</th>
                        </tr>
                        <tr>
                            <td>{{ item.motivo }}</td>
                            <td>{{item.examen_fisico}}</td>
                            <td>{{item.diagnostico}}</td>
                            <td>{{item.tratamiento}}</td>
                            <td>{{item.observacion}}</td>
                        </tr>
                    </table>
                    <table class="table">
                        <tr>
                            <th>PA</th>
                            <th>FC</th>
                            <th>FR</th>
                            <th>T°C</th>
                        </tr>
                        <tr>
                            <td>{{ item.pa }}</td>
                            <td>{{ item.fc }}</td>
                            <td>{{ item.fr }}</td>
                            <td>{{ item.tc }}</td>
                        </tr>
                    </table>
                    <p><b>Personal que atendio la consulta:</b> {{ item.personal_a_cargo }}</p>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
const debounce = callback => {
    let timerId;
    return (...args) => {
        clearTimeout(timerId);
        timerId = setTimeout(() => {
            callback(...args);
        }, 1500);
    };
};
export default {
    data() {
        return {
            selectedusers: [],
            users: [],
            isLoading: false,
            historial:{data:[]},
            busy:false
        };
    },
    created() {
        this.asyncFind = debounce(query => {
            if (query.length == 0) {
                return;
            }
            this.isLoading = true;
            axios.get("/search_user?q=" + query).then(response => {
                this.users = response.data.data;
                this.isLoading = false;
            });
        });
    },
    methods: {
        getHistorial() {
            if (!this.selectedusers?.id) {
                return
            }
            this.busy=true
            axios.get('/historial-clinico-historial/'+this.selectedusers.id).then(res=>{
                this.historial= res.data.historialClinico
                this.busy=false
            })
        },
        selectedEvent(ev){
            this.historial.data=[]
        }
    },
};
</script>

<style lang="scss" scoped></style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
