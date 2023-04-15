<template>
    <div class="row">
        <div class="col-12 filter">
            <vue-input label="Suche" class="col-2 d-inline-block" v-model="search" />
            <vue-button @click="handleSearch" class="d-inline-block">Search</vue-button>
        </div>
        <KontoList v-if="all && all.length > 0" :items="all" />
        <KontoDetails />
    </div>
</template>

<script>
import 'vfc/dist/vfc.css'
import { Input, Button, Select  } from 'vfc'
import { mapGetters } from "vuex"
import KontoList from "./KontoList";
import KontoDetails from "./KontoDetails";

export default {
    name: "Konto",
    props: ['items'],
    components: {
        KontoDetails,
        KontoList,
        [Input.name]: Input,
        [Button.name]: Button,
        [Select.name]: Select,
    },
    data() {
        return {
            search: null,
        }
    },
    methods: {
        handleSearch() {
            this.$store.commit('search', this.search)
        }
    },
    computed: mapGetters({
        all: 'all',
        one: 'one',
        uniq: 'uniq'
    }),
    mounted() {
        console.info(this.uniq)
    },
    beforeMount() {
        this.$store.state.all = this.items
    },
}
</script>

<style scoped>

</style>
