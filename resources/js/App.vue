<template>
    <b-container class="bv-row">
        <Airport></Airport>
        <Flight @update-cart="updateCart"></Flight>
        <transition name="fade">
            <ErrorMessage :message="errorMessage" v-show="errorMessage" @close-error="hideError"></ErrorMessage>
        </transition>
        <Trips
            :loading="loading"
            :current-trip="currentTrip"
            :saved-trips="savedTrips"
            @empty-current="emptyCurrent"
            @remove-from-current="removeFlight"
            @save-current="save"
            @remove-trip="deleteTrip"
        ></Trips>
    </b-container>
</template>

<script>
    import Airport from './components/Airport';
    import Flight from './components/Flight';
    import Trips from "./components/Trips";
    import ErrorMessage from "./components/modules/ErrorMessage";

    export default {
        components: {
            Airport, Flight, Trips, ErrorMessage
        },
        data() {
            return {
                currentTrip: [],
                savedTrips: [],
                currentTripUid: '',
                errorMessage: '',
                loading: false,
            }
        },
        methods: {
            updateCart(flightNew) {
                if (this.currentTrip.filter(flight => flight.uid === flightNew.uid).length !== 0) {
                    this.handleError({message: 'You already have this flight'})
                    return
                }
                this.currentTrip.push(flightNew);
                this.total = this.totalPrice(this.currentTrip);
            },
            emptyCurrent() {
                this.currentTrip = [];
            },
            getSavedtrips() {
                return axios.get('/api/trips')
                    .then(response => {
                        this.savedTrips = response.data.data
                    }).catch(e => this.handleError(e))
            },
            totalPrice(trip) {
                return trip.reduce(((accumulator, currentFlight) => {
                    return accumulator += parseFloat(currentFlight.price.split(' ')[1])
                }), 0)
            },
            removeFlight(uid) {
                this.currentTrip = this.currentTrip.filter(flight => flight.uid !== uid)
            },
            removeTrip(uid) {
                return axios.delete(`/api/trips/${uid}`)
                    .then(response => {
                    })
                    .catch(e => this.handleError(e))
            },
            saveCurrent() {
                return axios.put(
                    `/api/trips/${this.currentTripUid}`,
                    this.currentTrip,
                    {headers: {"Content-Type": "application/json"}}
                )
                    .then(response => {
                        this.currentTrip = []
                        this.getSavedtrips()
                    }).catch(e => this.handleError(e))

            },
            createNewtrip() {
                return axios.post('/api/trips')
                    .then(response => {
                        this.currentTripUid = response.data.data.uid
                    }).catch(e => this.handleError(e))
            },
            async save() {
                this.loading = true
                try {
                    if (!this.currentTripUid) {
                        let r1 = await this.createNewtrip()
                    }
                    let r2 = await this.saveCurrent();
                    this.currentTripUid = ''
                    this.loading = false
                } catch (e) {
                    this.handleError(e)
                    // throw e;      // let caller know the promise was rejected with this reason
                }
            },
            async deleteTrip(uid) {
                this.loading = true
                try {
                    let r1 = await this.removeTrip(uid)
                    let r2 = await this.getSavedtrips();
                    this.loading = false
                } catch (e) {
                    this.handleError(e)
                    // throw e;      // let caller know the promise was rejected with this reason
                }
            },
            handleError(error) {
                this.errorMessage = error.message
            },
            hideError() {
                this.errorMessage = ''
            }
        },
        beforeMount() {
            this.getSavedtrips()
        }
    }
</script>

<style lang="scss">
    .is-flex.is-centered {
        justify-content: center;
        align-items: center;
    }

    .bv-row {
        margin-bottom: 50px;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
    {
        opacity: 0;
    }
</style>
