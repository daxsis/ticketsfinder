<template>
    <div class="flight">
        <b-row>
            <b-col><h1>Find a flight</h1></b-col>
        </b-row>
        <b-form inline @submit="onSubmit" @reset="onReset" class="w-100">
            <b-row>
                <b-col cols="xs-12" class="mr-2">
                    <label for="inline-form-input--depcity">Departure city</label>
                    <b-input
                        id="inline-form-input-depcity"
                        v-model="form.depcity"
                        class="mb-1 mr-sm-1 mb-sm-0"
                        placeholder="Monteal.."
                    ></b-input>
                </b-col>
                <b-col cols="xs-12" class="mr-2">
                    <label for="inline-form-input-arrcity">Arrival city</label>
                    <b-input
                        id="inline-form-input-arrcity"
                        v-model="form.arrcity"
                        class="mb-2 mr-sm-2 mb-sm-0"
                        placeholder="Toronto.."
                    ></b-input>
                </b-col>

                <b-col cols="xs-12" class="mr-2">
                    <label for="inline-form-input-airline">Airline</label>
                    <b-input
                        id="inline-form-input-airline"
                        v-model="form.airline"
                        class="mb-2 mr-sm-2 mb-sm-0"
                        placeholder="Air Canada.."
                    ></b-input>
                </b-col>

                <b-col cols="xs-12" class="mr-2">
                    <label for="inline-form-input-date">Departure Date</label>
                    <b-input
                        id="inline-form-input-date"
                        v-model="form.date"
                        class="mb-2 mr-sm-2 mb-sm-0"
                        placeholder="2019-11-10.."
                    ></b-input>
                </b-col>
                <b-col cols="xs-12" class="mr-2 mt-2">
                    <Spinner v-if="loading"></Spinner>
                    <div v-else>
                        <b-button type="submit" variant="primary" class="h-auto">Search</b-button>
                        <b-button type="reset" variant="danger" class="h-auto">Reset</b-button>
                    </div>
                </b-col>
            </b-row>
            <b-row>
                <b-col cols="xs-12" class="mr-2">
                    <label for="inline-form-input-date">Departure Airport</label>
                    <b-input
                        id="inline-form-input-date"
                        v-model="form.icao_from"
                        class="mb-2 mr-sm-2 mb-sm-0"
                        placeholder="YUL.."
                    ></b-input>
                </b-col>

                <b-col cols="xs-12" class="mr-2">
                    <label for="inline-form-input-date">Arrival Airport</label>
                    <b-input
                        id="inline-form-input-date"
                        v-model="form.icao_to"
                        class="mb-2 mr-sm-2 mb-sm-0"
                        placeholder="YZD.."
                    ></b-input>
                </b-col>
            </b-row>
        </b-form>
        <b-row>
            <transition name="fade">
                <FlightTable class="mt-2" v-bind:flights="flights" v-if="showTable"
                             @send-to-card="addToCart"></FlightTable>
            </transition>
        </b-row>
        <pagination v-show="showTable" :data="resposne" :limit="10" @pagination-change-page="getResults">
            <span slot="prev-nav">&lt; Previous</span>
            <span slot="next-nav">Next &gt;</span>
        </pagination>
    </div>
</template>

<script>
    import FlightTable from './modules/FlightTable'
    import Spinner from "./modules/Spinner";

    export default {
        components: {
            FlightTable, Spinner
        },
        data() {
            return {
                form: {
                    depcity: '',
                    arrcity: '',
                    airline: '',
                    date: '',
                    icao_from: '',
                    icao_to: ''
                },
                flights: [],
                resposne: {},
                fields: [
                    'Number',
                    'From',
                    'To',
                    'Airline',
                    'Date',
                    'Duration',
                ],
                showTable: false,
                loading: false
            }
        },
        methods: {
            // emmit to parent chosen flight
            addToCart(flight) {
                console.log(flight, 2)
                this.$emit('update-cart', flight)
            },
            // request pagination data from api
            getResults(page = 1) {
                this.loading = true
                axios.get('/api/flights?page=' + page)
                    .then(response => {
                        this.flights = response.data
                        this.flights = response.data.data.map(flight => this.prepareData(flight))

                        this.loading = false
                        this.showTable = true
                    });
            },
            // Prepare [{}..] flight data for the table
            prepareData(data) {
                let departure_code = data.departure_airport.icao === null ? '' : `(${data.departure_airport.icao})`
                let arrival_code = data.arrival_airport.icao === null ? '' : `(${data.arrival_airport.icao})`
                return ({
                    id: data.id,
                    uid: data.uid,
                    from: `${data.departure_airport.city} ${departure_code}`,
                    to: `${data.arrival_airport.city} ${arrival_code}`,
                    airline: data.airline.name,
                    date: this.prepareTime(data.departure_time),
                    duration: `${data.hours}h ${data.minutes}m`,
                    price: `C$ ${data.price}`,
                })
            },
            // Initial submission of the search query
            onSubmit(evt) {
                this.loading = true
                evt.preventDefault()
                let url = 'api/flights' + this.prepareUrl(this.form)
                axios.get(url)
                    .then(res => {
                        this.flights = res.data.data.map(flight => this.prepareData(flight))
                        this.resposne = res.data

                        this.loading = false
                        this.showTable = true
                    }).catch(error => console.log(error))
            },
            // Reset and hide the table
            onReset(evt) {
                evt.preventDefault()
                // Reset our form values
                this.form.depcity = ''
                this.form.arrcity = ''
                this.form.airline = ''
                this.form.date = ''
                this.icao_from = ''
                this.icao_to = ''
                // Trick to reset/clear native browser form validation state
                this.showTable = false
            },
            // Resolve time time from the received data
            prepareTime(departure_time) {
                let time = departure_time.split('.')[0]
                time = time.split('T')
                return `${time[0]} ${time[1]}`
            },
            // Prepare URL for search query
            prepareUrl(parameters) {
                let url = '?'
                if (this.form.depcity) {
                    url += `departure=${this.form.depcity}&`
                }
                if (this.form.arrcity) {
                    url += `arrival=${this.form.arrcity}&`
                }
                if (this.form.airline) {
                    url += `airline=${this.form.airline}&`
                }
                if (this.form.date) {
                    url += `date=${this.form.date}&`
                }
                if (this.form.icao_from) {
                    url += `icao_from=${this.form.icao_from}&`
                }
                if (this.form.icao_to) {
                    url += `icao_to=${this.form.icao_to}&`
                }

                return url
            }
        }
    }
</script>

<style scoped>
    .flight {
        margin-top: 50px;
        min-height: 200px;
    }

    h1 {
        margin: 30px;
    }

    label {
        margin-right: 5px;
    }
</style>
