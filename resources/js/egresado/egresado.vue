<template>
    <div class="card-body">
        <h5 class="card-tile mb-3 text-center">Seguimiento de Egresados</h5>
        <label for="buscarusuario">Selecione Alumno:</label>
        <div class="row gap-4 justify-content-center">
            <div class="col-lg-6 d-flex gap-3">
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
                    @select="egresado = null"
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
                <button
                    @click="getDataEdresado()"
                    class="btn btn-primary d-flex gap-2 align-items-center"
                >
                    <i class="fas fa-search"></i> Buscar
                </button>
            </div>
        </div>
        <div v-if="selectedusers.id">
            <table class="table mb-3 mt-4" v-show="selectedusers.id">
                <tr>
                    <td rowspan="6">
                        <img :src="selectedusers.picture_url" />
                    </td>
                </tr>
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
        <hr />
        <template v-if="egresado">
            <div class="text-end">
                <button
                    @click="inputDisable = !inputDisable"
                    class="btn btn-warning"
                >
                    <i class="fas fa-edit"></i>
                    {{ inputDisable ? "Activar" : "Descativar" }} Edicion
                </button>
            </div>
            <div class="w-100 border mt-3 p-4">
                <h6>INFORMACIÓN ACADÉMICA</h6>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label>Especialidad</label>
                            <input
                                v-model="egresado.especialidad"
                                :disabled="inputDisable"
                                maxlength="100"
                                type="text"
                                class="form-control"
                            />
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label>Programa de estudios</label>
                            <input
                                v-model="egresado.programa_estudios"
                                :disabled="inputDisable"
                                maxlength="100"
                                type="text"
                                class="form-control"
                            />
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label>Nivel del Alumno</label>
                            <input
                                v-model="egresado.nivel"
                                :disabled="inputDisable"
                                maxlength="100"
                                type="text"
                                class="form-control"
                            />
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label>Periodo Ingreso</label>
                            <input
                                v-model="egresado.ingreso"
                                :disabled="inputDisable"
                                maxlength="100"
                                type="text"
                                class="form-control"
                            />
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label>Periodo Egreso</label>
                            <input
                                v-model="egresado.egreso"
                                :disabled="inputDisable"
                                maxlength="100"
                                type="text"
                                class="form-control"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 border mt-3 p-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-body">
                            <h6 class="card-title">
                                ULTIMO TRABAJO DEL ALUMNO
                            </h6>
                            <div class="form-group mb-2 row">
                                <label class="col-sm-4 col-form-label">
                                    Empresa de Trabajo
                                </label>
                                <div class="col-sm-8">
                                    <input
                                        v-model="egresado.empresa"
                                        :disabled="inputDisable"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="col-sm-4 col-form-label">
                                    Ocupacion
                                </label>
                                <div class="col-sm-8">
                                    <input
                                        v-model="egresado.ocupacion"
                                        :disabled="inputDisable"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="col-sm-4 col-form-label">
                                    Email
                                </label>
                                <div class="col-sm-8">
                                    <input
                                        v-model="egresado.email_empresa"
                                        :disabled="inputDisable"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="col-sm-4 col-form-label">
                                    Direccion
                                </label>
                                <div class="col-sm-8">
                                    <input
                                        v-model="egresado.direccion_empresa"
                                        :disabled="inputDisable"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="col-sm-4 col-form-label">
                                    Evidencia
                                </label>
                                <div class="col-sm-8">
                                    <input
                                        :disabled="inputDisable"
                                        type="file"
                                        accept=".pdf"
                                        class="form-control form-control-sm"
                                    />
                                    <p class="text-muted mt-2">
                                        Max 2MB en formato .PDF
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card-body">
                            <h6 class="card-title">
                                DATOS DE CONTACTO
                            </h6>
                            <div class="form-group mb-2 row">
                                <label class="col-sm-4 col-form-label">
                                    Parentesco
                                </label>
                                <div class="col-sm-8">
                                    <input
                                        v-model="egresado.parentesco"
                                        :disabled="inputDisable"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="col-sm-4 col-form-label">
                                    Nombres y apellidos
                                </label>
                                <div class="col-sm-8">
                                    <input
                                        v-model="egresado.fullname"
                                        :disabled="inputDisable"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="col-sm-4 col-form-label">
                                    N. Documento
                                </label>
                                <div class="col-sm-8">
                                    <input
                                        v-model="egresado.num_documento"
                                        :disabled="inputDisable"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="col-sm-4 col-form-label">
                                    Direccion
                                </label>
                                <div class="col-sm-8">
                                    <input
                                        v-model="egresado.direccion"
                                        :disabled="inputDisable"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="col-sm-4 col-form-label">
                                    Email
                                </label>
                                <div class="col-sm-8">
                                    <input
                                        v-model="egresado.email"
                                        :disabled="inputDisable"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="col-sm-4 col-form-label">
                                    Teléfono
                                </label>
                                <div class="col-sm-8">
                                    <input
                                        v-model="egresado.phone"
                                        :disabled="inputDisable"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <button @click="saveEgresado()" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar Cambios
                </button>
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
            historial: { data: [] },
            busy: false,
            inputDisable: true,
            egresado: null
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
        getDataEdresado() {
            if (!this.selectedusers.id) {
                return;
            }
            axios.get("/egresados/" + this.selectedusers.id).then(res => {
                this.egresado = res.data.egresado;
            });
        },
        saveEgresado(){
            if (!this.selectedusers.id) {
                return;
            }
            this.egresado.mdl_user_id = this.selectedusers.id
            axios.post("/egresados/" + this.selectedusers.id,this.egresado).then(res => {
                this.egresado = res.data.egresado;
            });
        }
    }
};
</script>

<style lang="scss" scoped></style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
