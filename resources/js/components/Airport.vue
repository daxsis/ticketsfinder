<template>
    <div class="airport">
        <b-row>
            <b-col><h1>Find an airport</h1></b-col>
        </b-row>
            <b-form inline @submit="onSubmit" @reset="onReset" class="w-100">
                        <b-col cols="xs-12" class="mr-2">
                            <label for="inline-form-input-city">City</label>
                            <b-input
                                id="inline-form-input-city"
                                v-model="form.city"
                                class="mb-1 mr-sm-1 mb-sm-0"
                                placeholder="Monteal"
                            ></b-input>
                        </b-col>
                        <b-col cols="xs-12" class="mr-2">
                            <label for="inline-form-input-icao">ICAO</label>
                            <b-input
                                id="inline-form-input-icao"
                                v-model="form.icao"
                                class="mb-2 mr-sm-2 mb-sm-0"
                                placeholder="CYUL"
                            ></b-input>
                        </b-col>

                        <b-col cols="xs-12" class="mr-2">
                            <label for="inline-form-input-name">Name</label>
                            <b-input
                                id="inline-form-input-name"
                                v-model="form.name"
                                class="mb-2 mr-sm-2 mb-sm-0"
                                placeholder="Pierre Elliott Trudeau"
                            ></b-input>
                        </b-col>

                        <b-col cols="xs-12" class="mr-2">
                            <label for="inline-form-input-region">Region</label>
                            <b-input
                                id="inline-form-input-region"
                                v-model="form.region"
                                class="mb-2 mr-sm-2 mb-sm-0"
                                placeholder="Quebec"
                            ></b-input>
                        </b-col>
                        <b-col cols="xs-12" class="mr-2 mt-2">
                            <Spinner v-if="loading"></Spinner>
                            <div v-else>
                                <b-button type="submit" variant="primary" class="h-auto">Search</b-button>
                                <b-button type="reset" variant="danger" class="h-auto">Reset</b-button>
                            </div>
                        </b-col>
            </b-form>
        <b-row>
            <AirportTable class="mt-2" v-bind:airports="airports" v-if="showTable"></AirportTable>
            <pagination v-show="showTable" :data="airports" :limit="10" @pagination-change-page="getResults">
                <span slot="prev-nav">&lt; Previous</span>
                <span slot="next-nav">Next &gt;</span>
            </pagination>
        </b-row>
    </div>
</template>

<script>
    import AirportTable from "./modules/AirportTable";
    import Spinner from "./modules/Spinner";

    export default {
        components: {
            AirportTable, Spinner
        },
        data() {
            return {
                form: {
                    city: '',
                    icao: '',
                    name: '',
                    region: '',
                },
                airports: {},
                fields: [
                    'icao',
                    'name',
                    'city',
                    'region'
                ],
                showTable: false,
                loading: false
            }
        },
        methods: {
            // Reqeust for pagination data url
            getResults(page = 1) {
                this.loading = true
                axios.get('/api/airports?page=' + page)
                    .then(response => {
                        this.airports = response.data;
                        this.loading = false
                    });
            },
            // Initial submit request to the api with request query
            onSubmit(evt) {
                this.loading = true
                evt.preventDefault()
                console.log(JSON.stringify(this.form))
                let url = 'api/airports' + this.prepareUrl(this.form)
                axios.get(url)
                    .then(res => {
                        this.airports = res.data
                        console.log(this.airports)
                        this.loading = false
                        this.showTable = true
                    })
                    .catch(error => console.log(error))
            },
            // Reset and hide the table
            onReset(evt) {
                evt.preventDefault()
                // Reset our form values
                this.form.city = ''
                this.form.icao = ''
                this.form.name = ''
                this.form.region = ''
                // Trick to reset/clear native browser form validation state
                this.showTable = false
            },
            // Prepare url with the search query
            prepareUrl(parameters) {
                let url = '?'
                if(this.form.city) {
                    url+= `city=${this.form.city}&`
                }
                if(this.form.icao) {
                    url+= `icao=${this.form.icao}&`
                }
                if(this.form.name) {
                    url+= `name=${this.form.name}&`
                }
                if(this.form.region) {
                    url+= `region=${this.form.region}&`
                }
                return url
            }
        }
    }
</script>

<style scoped>
    .airport {
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
