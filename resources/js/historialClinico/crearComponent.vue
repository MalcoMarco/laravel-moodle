<template>
    <div class="card-body">
        <h5 class="card-tile mb-3">Crear Historial Clínico</h5>
        <div class="row">
            <div class="col-lg-6">
                <h6>Datos Generales</h6>
                <label for="multiselecUser" class="label-required"
                    >Usuario</label
                >
                <multiselect
                    v-model="selectedusers"
                    id="multiselecUser"
                    label="firstname"
                    track-by="firstname"
                    placeholder="Buscar usuario..."
                    :options="users"
                    :searchable="true"
                    :loading="isLoading"
                    :internal-search="false"
                    :clear-on-select="false"
                    @search-change="asyncFind"
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
                </multiselect>
                <div
                    class="w-100 d-flex justify-content-center mt-4 mb-2"
                    style="height: 100px;"
                >
                    <img :src="selectedusers.picture_url" />
                </div>
                <table class="table" v-show="selectedusers.id">
                    <tr>
                        <th>Apellidos y Nombres</th>
                        <td>
                            {{ selectedusers.firstname }}
                            {{ selectedusers.lastname }}
                        </td>
                    </tr>
                    <!-- <tr>
                        <th>Fecha de Nacimiento</th>
                        <td></td>
                    </tr> -->
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
            <div class="col-lg-6 border p-4">
                <div class="row">
                    <div class="col-lg-2 mb-3">
                        <label for="talla" class="">Talla</label>
                        <input
                            type="text"
                            maxlength="20"
                            class="form-control"
                            id="talla"
                            v-model="historial.talla"
                        />
                    </div>
                    <div class="col-lg-2 mb-3">
                        <label for="peso" class="">Peso</label>
                        <input
                            type="text"
                            maxlength="20"
                            class="form-control"
                            id="peso"
                            v-model="historial.peso"
                        />
                    </div>
                    <div class="col-lg-2 mb-3">
                        <label for="imc" class="">IMC</label>
                        <input
                            type="text"
                            maxlength="20"
                            class="form-control"
                            id="imc"
                            v-model="historial.imc"
                        />
                    </div>
                    <div class="col-lg-5 mb-3">
                        <label class="">Grupo Sanguineo</label>
                        <input
                            type="text"
                            maxlength="20"
                            class="form-control"
                            v-model="historial.grupo_sanguineo"
                        />
                    </div>
                    <h6>Alergia a algún medicamento</h6>
                    <div class="ps-4">
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="alergia"
                                id="rsi"
                                value="1"
                                v-model="historial.alergia"
                            />
                            <label class="form-check-label" for="rsi">
                                Si
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="alergia"
                                id="rno"
                                checked
                                value="0"
                                v-model="historial.alergia"
                            />
                            <label class="form-check-label" for="rno">
                                No
                            </label>
                        </div>
                        <label for="">Especifique</label>
                        <input
                            type="text"
                            maxlength="100"
                            class="form-control mb-3"
                            v-model="historial.alergia_especifique"
                        />
                    </div>

                    <h6>Sufre de alguna enfermedad</h6>
                    <div class="ps-4">
                        <div
                            class="form-check"
                            v-for="(item, i) in enfermedades"
                            :key="'enf' + i"
                        >
                            <input
                                class="form-check-input"
                                type="checkbox"
                                :value="item"
                                :id="'e' + i"
                                v-model="historial.enfermedad"
                            />
                            <label class="form-check-label" :for="'e' + i">
                                {{ item }}
                            </label>
                        </div>
                        <label for="" class="mt-3">Especifique</label>
                        <input
                            type="text"
                            maxlength="200"
                            class="form-control mb-3"
                            v-model="historial.enfermedad_especifique"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 border p-4">
            <h5><i class="fas fa-comment-medical"></i> Consulta</h5>
            <div class="row">
                <div class="col-auto mb-3">
                    <label for="fecha_consulta" class="label-required">
                        Fecha
                    </label>

                    <input
                        type="date"
                        class="form-control"
                        id="fecha_consulta"
                        v-model="historial.fecha_consulta"
                    />
                </div>
                <div class="col-auto mb-3">
                    <label for="hora" class="label-required">Hora</label>
                    <input
                        type="time"
                        class="form-control"
                        id="hora"
                        v-model="historial.hora_consulta"
                    />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="w-100">
                        <label for="">Motivo de consulta</label>
                        <textarea
                            name="motivo"
                            id="motivo"
                            rows="2"
                            class="form-control mb-3"
                            v-model="historial.motivo"
                        ></textarea>

                        <label for="">Examen Físico</label>
                        <textarea
                            name="fisico"
                            rows="2"
                            class="form-control mb-3"
                            v-model="historial.examen_fisico"
                        ></textarea>

                        <label for="">Diagnostico</label>
                        <input
                            type="text"
                            maxlength="200"
                            class="form-control mb-3"
                            v-model="historial.diagnostico"
                        />

                        <label for="">Tratamiento</label>
                        <textarea
                            class="form-control mb-3"
                            v-model="historial.tratamiento"
                        ></textarea>

                        <label for="">Observación</label>
                        <input
                            type="text"
                            maxlength="200"
                            class="form-control mb-3"
                            v-model="historial.observacion"
                        />

                        <label for="">Personal que atendio la consulta</label>
                        <input
                            type="text"
                            maxlength="200"
                            class="form-control mb-3"
                            v-model="historial.personal_a_cargo"
                        />
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">PA</label>
                            <input
                                type="text"
                                maxlength="20"
                                class="form-control mb-3"
                                v-model="historial.pa"
                            />
                        </div>
                        <div class="col-lg-6">
                            <label for="">FC</label>
                            <input
                                type="text"
                                maxlength="20"
                                class="form-control mb-3"
                                v-model="historial.fc"
                            />
                        </div>
                        <div class="col-lg-6">
                            <label for="">FR</label>
                            <input
                                type="text"
                                maxlength="20"
                                class="form-control mb-3"
                                v-model="historial.fr"
                            />
                        </div>
                        <div class="col-lg-6">
                            <label for="">T°C</label>
                            <input
                                type="text"
                                maxlength="20"
                                class="form-control mb-3"
                                v-model="historial.tc"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100 text-end mt-3">
            <button @click="saveHistorial()" class="btn btn-success">
                Guardar
            </button>
        </div>
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
            value: null,
            options: ["list", "of", "options"],
            enfermedades: ["Diabetes", "VIH", "TBC", "Sobre peso", "ETS"],
            selectedusers: [],
            users: [],
            isLoading: false,
            historial: {
                mdl_user_id: null,
                talla: "",
                peso: "",
                imc: "",
                grupo_sanguineo: "",
                alergia: "0",
                alergia_especifique: "",
                enfermedad: [],
                enfermedad_especifique: "",
                fecha_consulta: null,
                hora_consulta: null,
                motivo: "",
                examen_fisico: "",
                diagnostico: "",
                tratamiento: "",
                observacion: "",
                personal_a_cargo: "",
                pa: "",
                fc: "",
                fr: "",
                tc: ""
            }
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
        saveHistorial() {
            if (!this.selectedusers.id) {
                this.warningAlert("Usuario es requerido");
                return;
            }
            if (
                !this.historial.fecha_consulta ||
                !this.historial.hora_consulta
            ) {
                this.warningAlert("Fecha y hora de consulta es requerido");
                return;
            }
            this.historial.mdl_user_id = this.selectedusers.id;
            axios
                .post("/historial-clinico-store", this.historial)
                .then(response => {
                    this.$bvToast.toast("se ha guardado los datos", {
                        title: "Guardado",
                        variant: "success",
                        solid: true,
                        autoHideDelay: 5000
                    });
                    setTimeout(function() {
                        window.location.href = '/historial-clinico';
                    }, 1500); // 2000 milisegundos = 2 segundos

                })
                .catch(err => {});
        },
        warningAlert(title = "") {
            this.$bvToast.toast("Complete el formulario", {
                title: title,
                variant: "warning",
                solid: true,
                autoHideDelay: 5000
            });
        }
    }
};
</script>

<style lang="scss" scoped></style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
