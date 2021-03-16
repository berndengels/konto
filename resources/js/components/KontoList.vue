<template>
    <div class="col-6">
        <table v-if="items && items.length > 0" class="table table-sm table-striped">
            <tr>
                <th>Buchung</th>
                <th>Wer</th>
                <th>Buchungstext</th>
                <th>Betrag</th>
            </tr>
            <tr v-for="item in items" :key="item.id" @click="setItem(item)">
                <td>{{ item.buchungstag }}</td>
                <td>{{ item.wer }}</td>
                <td>{{ item.buchungstext }}</td>
                <td>{{ item.betrag }} €</td>
            </tr>
        </table>
        <h3 v-else>Keine Daten vorhanden</h3>
    </div>
</template>

<script>

export default {
    name: "KontoList",
    props: ['items'],
    methods: {
        setItem(item) {
            this.$store.state.one = item
        }
    }
}
</script>

<style scoped>
tr {
    cursor: pointer;
}
</style>
