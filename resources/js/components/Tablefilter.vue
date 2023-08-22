<template>
    <div
        class="d-flex justify-content-center justify-content-md-between flex-wrap gap-4"
    >
        <div class="">
            <div class="d-flex gap-3">
                <label>Buscar:</label>
                <input
                    v-model="query"
                    @keyup="realizarBusqueda()"
                    type="search"
                    class="form-control form-control-sm"
                    placeholder="Buscar"
                />
            </div>
        </div>
        <div class="">
            <div class="d-flex gap-3">
                <label>mostrar</label>
                <select v-model="pageSize" class="form-select form-select-sm">
                    <option
                        v-for="item in mostar"
                        :key="'mostrar_' + item"
                        :value="item"
                        >{{ item }}</option
                    >
                </select>
            </div>
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
        }, 2500);
    };
};
export default {
    data() {
        return {
            pageSize: 15,
            mostar: [15, 25, 50, 100],
            query: ""
        };
    },
    created() {
        this.realizarBusqueda = debounce(() => {
            this.$emit("changeQuery", this.query);
        });
    },
    watch: {
        pageSize(newValue) {
            this.$emit("changePageSize", newValue);
        }
    }
};
</script>

<style lang="scss" scoped>
.form-select {
    max-width: 75px;
    height: 31px;
}
.form-control {
    max-width: 220px;
}
label {
    font-size: 14px;
    display: flex;
    align-items: center;
}
</style>
