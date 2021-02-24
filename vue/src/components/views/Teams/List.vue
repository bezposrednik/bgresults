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
                            <!-- :to="`/teams/${item.url}`" -->
                            <router-link :to="{ name: 'TeamView', params: { url: `${item.url}` }}" class="nav-link">{{
                                item.name }}</router-link>
                        </td>
                        <td>{{ item.location }}</td>
                        <!-- <router-link :to="{ name: 'TeamsView', params: { url: this.url }}" class="nav-link">{{ item.name }}</router-link> -->
                        <td>{{ item.description }}</td>
                        <td>{{ item.founded }}</td>

                        <td>{{ item.logo }}</td>
                    </tr>
                </tbody>
            </table>
            <Pagination :url="this.url" :pagination="this.items.data.pagination"></Pagination>
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
                items: [],
                filters: [],
                url: `/api/teams`,
                loading: true,
            }
        },
        components: {
            Pagination,
            Filters
        },
        methods: {
            load() {
                this.axios.get(this.url)
                    .then((response) => {
                        // this.$store.state.content = response.data;
                        this.items = response.data;
                        // console.log(this.items);

                        console.log(this.$route.query);
                        // this.$store.commit('load');
                    })
                    .then(() => (this.loading = false))
                    .catch((error) => (console.log(error)));
            },
        },
        mounted() {
            this.load();
        },
        // computed: {
        //     teams() {
        //         return this.$store.state.content;
        //     }
        // }
    }
</script>

<style>

</style>