<template>
    <b-list-group>
        <b-list-group-item v-for="(flight, index) in trip" :key="flight.number">
            <b-card :title="flight.number" :sub-title="flight.date">
                <b-card-text>
                    <b-row>
                        <b-col><strong>From: </strong><em>{{ flight.from }}</em></b-col>
                        <b-col><strong>To: </strong><em>{{ flight.to }}</em></b-col>
                    </b-row>
                    <b-row>
                        <b-col><strong>Duration: </strong><em>{{ flight.duration }}</em></b-col>
                        <b-col><strong>Price: </strong><em>{{ flight.price }}</em></b-col>
                    </b-row>
                </b-card-text>

                <button type="button" class="btn btn-link" @click="deleteFlight(flight.uid)">Remove</button>
            </b-card>
        </b-list-group-item>
    </b-list-group>
</template>

<script>
    export default {
        name: 'TripDescription',
        props: [
            'trip',
        ],
        methods: {
            deleteFlight(uid) {
                this.$emit('delete-from-current', uid);
            }
        },
    }
</script>

<style scoped>

</style>
