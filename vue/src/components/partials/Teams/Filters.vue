<template>
    <section class="mt-3">
        <div class="card">
            <div class="card-header">Филтри</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <Multiselect @click="getTeams" @select="filter('team_id')" v-model="selected.team_id"
                            mode="tags" placeholder="-- Избери отбори --" label="name" trackBy="name" valueProp="id"
                            :searchable="true" :options="options.teams">
                            <template v-slot:option="{ option }">
                                {{ option.name }}
                            </template>
                        </Multiselect>
                    </div>
                    <div class="col-md-4">
                        <Multiselect @click="getLocations" @select="filter('location_id')"
                            v-model="selected.location_id" mode="tags" placeholder="-- Избери място --" label="name"
                            trackBy="name" valueProp="id" :searchable="true" :options="options.locations">
                            <template v-slot:option="{ option }">
                                {{ option.name }}
                            </template>
                        </Multiselect>
                    </div>
                    <div class="col-md-4">
                        <Multiselect @click="getStadiums" @select="filter('stadium_id')" v-model="selected.stadium_id"
                            mode="tags" placeholder="-- Избери стадион --" label="name" trackBy="name" valueProp="id"
                            :searchable="true" :options="options.stadiums">
                            <template v-slot:option="{ option }">
                                {{ option.name }}
                            </template>
                        </Multiselect>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Multiselect from '@vueform/multiselect'

    export default {
        props: ['url'],
        name: 'Filters',
        components: {
            Multiselect
        },
        data() {
            return {
                options: {
                    teams: [],
                    locations: [],
                    stadiums: []
                },
                selected: {
                    team_id: [],
                    location_id: [],
                    stadium_id: []
                },
            }
        },
        computed: {
            teams() {
                return this.$store.state.teams.options.names;
            },
        },
        methods: {
            filter(param) {
                let api = `/api/teams?${param}=${this.selected[param].join(',')}`;
                this.axios.get(api)
                    .then((response) => this.$store.state.teams.items = response.data)
                    .catch((error) => (console.log(error)));
            },
            getTeams() {
                const api = `/api/teams/all`;
                this.axios.get(api)
                    .then((response) => this.options.teams = response.data.data)
                    .catch((error) => (console.log(error)));
            },
            getLocations() {
                const api = `/api/locations/all`;
                this.axios.get(api)
                    .then((response) => this.options.locations = response.data.data)
                    .catch((error) => (console.log(error)));
            },
            getStadiums() {
                const api = `/api/stadiums/all`;
                this.axios.get(api)
                    .then((response) => this.options.stadiums = response.data.data)
                    .catch((error) => (console.log(error)));
            }
        }
    }
</script>

<style src="@vueform/multiselect/themes/default.css"></style>