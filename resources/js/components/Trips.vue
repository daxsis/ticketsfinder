<template>
    <div class="trips">
        <h1>Your trips</h1>
        <h2 v-show="currentTrip.length">Current trip</h2>
        <transition name="fade">
            <TripDescription :trip="currentTrip" v-show="currentTrip.length"
                             @delete-from-current="removeFlight"></TripDescription>
        </transition>
        <b-row v-show="currentTrip.length" class="m-2">
            <!--            <b-col cols="8"><strong>Total price: </strong><em>{{ currentTotal }}</em></b-col>-->
            <Spinner v-if="loading"></Spinner>
            <b-col v-else cols="2">
                <button type="button" class="btn btn-outline-primary mt-2" @click="save">Save current trip</button>
            </b-col>
            <b-col cols="2">
                <button type="button" class="btn btn-outline-danger mt-2" @click="empty">Remove all flight</button>
            </b-col>
        </b-row>
        <b-list-group v-show="savedTrips.length">
            <h2>Saved trips</h2>
            <transition name="fade">
                <SavedTripDescription :loading="loading" :trips="savedTrips" v-show="savedTrips.length"
                                      @delete-trip="removeTrip"></SavedTripDescription>
            </transition>
        </b-list-group>
        <h2 v-if="currentTrip.length === 0 && savedTrips.length === 0">You have not created any trips yet.</h2>
    </div>
</template>

<script>
    import TripDescription from "./modules/TripDescription";
    import SavedTripDescription from "./modules/SavedTripDescription";
    import Spinner from "./modules/Spinner";

    export default {
        components: {
            TripDescription, SavedTripDescription, Spinner
        },
        name: 'Trips',
        props: [
            'currentTrip',
            'savedTrips',
            'loading',
        ],
        data() {
            return {
                currentTotal: 0,
                type: [
                    'one way',
                    'round-trip',
                    'open-jaw trip',
                    'multi-city trip',
                ],
            }
        },
        methods: {
            removeTrip(uid) {
                this.$emit('remove-trip', uid)
            },
            save() {
                this.$emit('save-current')
            },
            totalPrice(trip) {
                console.log(trip)
                return trip.reduce(((accumulator, currentFlight) => {
                    return accumulator += parseFloat(currentFlight.price.split(' ')[1])
                }), 0)
            },
            removeFlight(uid) {
                this.$emit('remove-from-current', uid)
            },
            empty() {
                this.$emit('empty-current')
                this.currentTotal = 0
                console.log('called 2')
            },
            calculateTotal() {
                this.currentTotal = this.totalPrice(currentTrip)
                this.savedTotal = this.totalPrice(savedTrips)
            },
            makeTripUid() {
                this.$emit()
            }
        },
        created() {
            this.makeTripUid();
        },
    }
</script>

<style scoped>
    .trips {
        margin-top: 50px;
        min-height: 200px;
    }

    h1 {
        margin: 30px;
    }

    h2 {
        margin: 15px;
    }

    label {
        margin-right: 5px;
    }
</style>
