<template>
    <table class="table">
        <thead>
        <tr>
            <th>ICAO</th>
            <th>IATA</th>
            <th>Name</th>
            <th>City</th>
            <th>Region</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="airport in airports.data" :key="airport.icao">
            <td>
                <span>{{ airport.icao }}</span>
            </td>
            <td>
                <span v-show="airport.code">{{ airport.code }}</span>
            </td>
            <td>{{ airport.name }}</td>
            <td>{{ airport.city }}</td>
            <td>{{ airport.region }}</td>
        </tr>
        <tr v-if="! airports.data.length">
            <td colspan="5" class="text-center">
                <i>Sorry, we couldn't find any airports for this search.</i>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: [
            'airports'
        ]
    }
</script>

<style scoped>

</style>
