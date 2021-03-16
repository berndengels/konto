<template>
    <tr v-for="item in items" :key="item.id">
        <td>{{ item.buchungstag }}</td>
        <td>{{ item.wer }}</td>
        <td>{{ item.buchungstext }}</td>
        <td>{{ item.betrag }} €</td>
    </tr>
</template>

<script>
export default {
    name: "KontoItems",
    props: ['items'],
}
</script>

<style scoped>

</style>
