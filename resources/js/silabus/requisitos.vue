<template>
    <div class="card">
        <div class="card-body">
            <h5 class="card-tile mb-3">Establecer requisitos del sílabo</h5>
            <div class="w-100 text-end">
                <button @click="openModal()" class="btn btn-primary btn-sm">
                    Agregar
                </button>
            </div>

            <div class="table-responsive">
                <b-table responsive striped hover :items="pagination.data" :fields="fields">
                    <template #cell(#)="data">
                        {{ data.index + 1 }}
                    </template>
                    <template #cell(Opciones)="data">
                        <button @click="editItem(data.item)" class="btn btn-success btn-sm me-3">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button @click="deleteItem(data.item.id)" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </template>
                </b-table>
            </div>
            <!-- Modal -->
            <b-modal v-model="modal" id="modal-1" @hidden="closeModal"
                :title="silabuReq.id ? 'Editar item' : 'Agregar nuevo item'" hide-footer>
                <form ref="form" @submit.prevent="saveData">
                    <div class="mb-3">
                        <label class="label-required">Nombre item</label>
                        <input v-model="silabuReq.name" type="text" class="form-control form-control-sm" required />
                    </div>
                    <b-progress v-if="modalBussy" :value="100" variant="info" striped :animated="true"
                        class="mt-1"></b-progress>
                    <div class="modal-footer mt-1">
                        <button @click="closeModal()" type="button" class="btn btn-secondary">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Guardar
                        </button>
                    </div>
                </form>
            </b-modal>
        </div>
    </div>
</template>
<script>
import { BModal, VBModal, BTable, BProgress } from "bootstrap-vue";

export default {
    components: { BModal, "b-table": BTable, "b-progress": BProgress },
    directives: { "b-modal": VBModal },
    data() {
        return {
            pagination: { data: [] },
            silabuReq: { name: "", orden: null, id: null },
            modal: false,
            modalBussy: false,
            fields: [
                "#",
                {
                    key: "name",
                    sortable: true
                },
                "Opciones"
            ]
        };
    },
    created() {
        this.getData();
    },
    methods: {
        getData() {
            axios.get("/get-silabus-reqs").then(res => {
                this.pagination = res.data;
            });
        },
        saveData() {
            if (!this.$refs.form.checkValidity()) {
                return;
            }

            let url = "/silabus-reqs";
            if (this.silabuReq.id) {
                url += "/" + this.silabuReq.id;
            }
            this.modalBussy = true;
            axios.post(url, this.silabuReq).then(res => {
                this.getData();
                this.closeModal();
            });
        },

        editItem(item) {
            this.silabuReq.name = item.name;
            this.silabuReq.id = item.id;
            this.openModal();
        },
        deleteItem(id) {
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
                    axios.delete("/silabus-reqs/" + id).then(res => {
                        this.getData();
                        this.closeModal();
                    });
                })
                .catch(err => {
                    // An error occurred
                });
        },
        openModal() {
            this.modal = true;
        },
        closeModal() {
            this.silabuReq.name = "";
            this.silabuReq.id = null;
            this.modalBussy = false;
            this.modal = false;
        }
    }
};
</script>
<style lang="scss" scoped>
//@import 'bootstrap/scss/bootstrap.scss';
//@import 'bootstrap-vue/src/index.scss';
</style>
