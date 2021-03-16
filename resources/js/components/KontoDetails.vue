<template>
    <div class="col-6">
        <table v-if="item" class="table table-sm">
            <tr>
                <th>ID</th>
                <td>{{ item.id }}</td>
            </tr>
            <tr>
                <th>Buchungstag</th>
                <td>{{ item.buchungstag }}</td>
            </tr>
            <tr>
                <th>Buchungstext</th>
                <td>{{ item.buchungstext }}</td>
            </tr>
            <tr>
                <th>Verwendungszweck</th>
                <td>{{ item.verwendungszweck }}</td>
            </tr>
            <tr>
                <th v-if="item.betrag > 0">Von wem</th>
                <th v-else>Für wen</th>
                <td>{{ item.wer }}</td>
            </tr>
            <tr>
                <th>Kontonummer</th>
                <td>{{ item.kontonummer }}</td>
            </tr>
            <tr>
                <th>BLZ</th>
                <td>{{ item.blz }}</td>
            </tr>
            <tr>
                <th>Betrag</th>
                <td>{{ item.betrag }}</td>
            </tr>
            <tr>
                <th>Währung</th>
                <td>{{ item.waehrung }}</td>
            </tr>
            <tr>
                <th>Info</th>
                <td>{{ item.info }}</td>
            </tr>
        </table>
    </div>
</template>

<script>
import { mapGetters } from "vuex"
export default {
    name: "KontoDetails",
    computed: mapGetters({item: 'one'}),
}
</script>

<style scoped>

</style>
