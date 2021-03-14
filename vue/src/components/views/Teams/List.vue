<template>
    <section>
        <div v-if="loading">
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <div v-else>
            <!-- <h1>Отбори</h1> -->
            <Filters></Filters>
            <hr>
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Име</th>
                        <th>Място</th>
                        <th>Описание</th>
                        <th>Основан</th>

                        <th>Лого</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item of items.data.items" :key="item.id">
                        <td>
                            <router-link :to="{ name: 'TeamView', params: { url: `${item.url}` }}" class="nav-link">
                                {{ item.name }}
                            </router-link>
                        </td>
                        <td>{{ item.location }}</td>
                        <td>{{ item.description }}</td>
                        <td>{{ item.founded }}</td>
                        <td>{{ item.logo }}</td>
                    </tr>
                </tbody>
            </table>
            <Pagination module="teams" :url="this.url" :data="this.items.data.pagination"></Pagination>
        </div>
    </section>
</template>

<script>
    import Pagination from '../../partials/General/Pagination.vue';
    import Filters from '../../partials/Teams/Filters.vue';
    export default {
        name: 'Teams\List',
        data() {
            return {
                // items: [],
                filters: [],
                url: `/api/teams`,
                loading: true
            }
        },
        components: {
            Pagination,
            Filters
        },
        methods: {
            load() {
                this.axios.get(this.url)
                    .then((response) => this.$store.state.teams.items = response.data)
                    .then(() => (this.loading = false))
                    .catch((error) => (console.log(error)));
            },
        },
        mounted() {
            this.load();
        },
        computed: {
            items() {
                return this.$store.state.teams.items;
            }
        }
    }
</script>

<style>

</style>