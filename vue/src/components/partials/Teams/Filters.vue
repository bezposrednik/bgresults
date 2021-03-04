<template>
    <section class="mt-3">

        <div class="card">
            <div class="card-header">
                Филтри
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <Multiselect @select="filter('team_id')" v-model="selected.team_id" mode="tags" placeholder="-- Избери отбори --"
                            label="name" trackBy="name" valueProp="id" :searchable="true" :options="options.teams">
                            <template v-slot:option="{ option }">
                                {{ option.name }}
                            </template>
                        </Multiselect>
                    </div>

                    <div class="col-md-4">

                        <Multiselect v-model="selected.location_id" :options="locations" mode="tags"
                            placeholder="-- Изберете място --" :filterResults="true" :minChars="1" :searchable="true"
                            :createTag="true" />
                        <!-- 
                        <select name="location_id" class="form-select" aria-label="Default select example">
                            <option selected>-- Изберете място --</option>
                            <option value="1">Домакин</option>
                            <option value="2">Гост</option>
                        </select> -->
                    </div>

                    <div class="col-md-4">
                        <select name="stadium_id" class="form-select" aria-label="Default select example">
                            <option selected>-- Изберете стадион --</option>
                            <option value="1">Васил Левски</option>
                            <option value="2">Българска армия</option>
                        </select>
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
            // locations() {
            //     return this.$store.state.locations.items;
            // }
        },
        methods: {
            filter(param) {
                // console.log(this.selected.team_id.join(','));
                let api = `/api/teams?${param}=${this.selected.team_id.join(',')}`;
                this.axios.get(api)
                    .then((response) => {
                        this.$store.state.teams.items = response.data;
                        // console.log(response.data);
                    })
                    // .then(() => (this.loading = false))
                    .catch((error) => (console.log(error)));
            },
            getTeams() {
                let api = `/api/teams/all`;
                this.axios.get(api)
                    .then((response) => {
                        // this.$store.state.teams.options.names = response.data.data;
                        this.options.teams = response.data.data;
                    })
                    // .then(() => (this.loading = false))
                    .catch((error) => (console.log(error)));
            },
            getLocations() {
                let api = `/api/locations/filters`;
                this.axios.get(api)
                    .then((response) => {
                        this.$store.state.teams.filters.name = response.data;
                    })
                    // .then(() => (this.loading = false))
                    .catch((error) => (console.log(error)));
            },
            loadStadiums() {

            }
        },
        mounted() {
            this.getTeams();

            // console.log(this.teams);
            // this.getLocations();
        }
    }
</script>


<style src="@vueform/multiselect/themes/default.css"></style>