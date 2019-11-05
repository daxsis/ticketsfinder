<template>
    <b-list-group>
        <b-list-group-item v-for="(trip, index) in trips" :key="trip.uid">
            <h6><strong>Trip reference number: </strong>{{ trip.uid }}</h6>
            <b-list-group-item v-for="flight in trip.flights" :key="flight.number">
                <b-list-group-item>
                    <b-row>
                        <b-col cols="2"><strong>Number: </strong>{{ flight.uid }}</b-col>
                        <b-col cols="3"><strong>Airline: </strong>{{ flight.airline.name }}</b-col>
                        <b-col><strong>From: </strong>{{ flight.departure_airport.city + ' ' +
                            flight.departure_airport.icao }}
                        </b-col>
                        <b-col><strong>To: </strong>{{ flight.arrival_airport.city + ' ' + flight.arrival_airport.icao
                            }}
                        </b-col>
                        <b-col><strong>Duration: </strong>{{ flight.hours + 'h ' + flight.minutes + 'm' }}</b-col>
                    </b-row>
                </b-list-group-item>
            </b-list-group-item>
            <Spinner v-if="loading"></Spinner>
            <button v-else type="button" class="btn btn-link" @click="deleteTrip(trip.uid)">Remove Trip</button>
        </b-list-group-item>
    </b-list-group>
</template>

<script>
    import Spinner from "./Spinner";

    export default {
        name: 'SavedTripDescription',
        components: {
            Spinner
        },
        props: [
            'trips', 'loading'
        ],
        methods: {
            deleteTrip(uid) {
                console.log(uid, 'delete')
                this.$emit('delete-trip', uid);
            },
        },
    }
</script>
