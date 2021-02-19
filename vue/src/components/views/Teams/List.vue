<template>
    <section>

        <div v-if="loading" style="background: red;">Loading...</div>

        <div v-else>
            <h1>Teams</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Име</th>
                        <th>Описание</th>
                        <th>Основан</th>
                        <th>Място</th>
                        <th>Лого</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item of teams.data.items" :key="item.id">
                        <td>
                            <!-- :to="`/teams/${item.url}`" -->
                            <router-link :to="{ name: 'TeamView', params: { url: `${item.url}` }}"  class="nav-link">{{ item.name }}</router-link>
                        </td>
                        <!-- <router-link :to="{ name: 'TeamsView', params: { url: this.url }}" class="nav-link">{{ item.name }}</router-link> -->
                        <td>{{ item.description }}</td>
                        <td>{{ item.founded }}</td>
                        <td>{{ item.location }}</td>
                        <td>{{ item.logo }}</td>
                    </tr>
                </tbody>
            </table>
            <Pagination :url="this.url" :pagination="this.teams.data.pagination"></Pagination>
        </div>

    </section>

</template>

<script>
    import Pagination from '../../partials/Pagination.vue';

    export default {
        name: 'Teams\List',
        data() {
            return {
                page: 1,
                loading: true,
                url: `/api/teams`
            }
        },
        components: {
            Pagination,
        },
        methods: {
            fetchTeams(page = 1) {
                this.axios.get(`${this.url}/page/${page}`)
                    .then((response) => {
                        this.$store.state.content = response.data;
                        console.log(response.data);
                        // this.$store.commit('load');
                    })
                    .then(() => (this.loading = false))
                    .catch((error) => (console.log(error)));
            },
        },
        mounted() {
            this.fetchTeams();
        },
        computed: {
            teams() {
                return this.$store.state.content;
            }
        }
    }
</script>

<style>

</style>