<template>
    <table class="table">
        <thead>
        <tr>
            <th>Number</th>
            <th>Airline</th>
            <th>Date</th>
            <th>From</th>
            <th>To</th>
            <th>Duration</th>
            <th>Price</th>
            <th>Choose</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="flight in flights" :key="flight.number">
            <td>{{ flight.uid }}</td>
            <td>{{ flight.airline }}</td>
            <td>{{ flight.date }}</td>
            <td>{{ flight.from }}</td>
            <td>{{ flight.to }}</td>
            <td>{{ flight.duration }}</td>
            <td>{{ flight.price }}</td>
            <td>
                <button type="button" class="btn btn-link" @click="addFlight(flight)">Add To Cart</button>
            </td>
        </tr>
        <tr v-if="! flights.length">
            <td colspan="5" class="text-center">
                <i>Sorry, we couldn't find any flights for this search.</i>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: [
            'flights'
        ],
        watch: {
            flights: function () {
                console.log(this.flights)
            }
        },
        methods: {
            addFlight(flight) {
                console.log(flight, 1)
                this.$emit('send-to-card', flight)
            }
        }
    }
</script>
