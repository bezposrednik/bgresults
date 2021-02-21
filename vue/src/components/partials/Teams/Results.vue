<template>
    <section>
        <h2>Резултати</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Дата</th>
                    <th>Домакин</th>
                    <th>Голове домакин</th>
                    <th>Голове домакин</th>
                    <th>Голове гост</th>
                    <th>Стадион</th>
                    <th>Турнир</th>
                    <th>Публика</th>
                    <th>Описание</th>

                </tr>
            </thead>
            <tbody>
                <tr v-for="item of this.results.items" :key="item.id">
                    <td>{{ item.date }}</td>
                    <td>{{ item.team1_id }}</td>
                    <td>{{ item.team1_goals }}</td>
                    <td>{{ item.team2_goals }}</td>
                    <td>{{ item.team2_id }}</td>
                    <td>{{ item.stadium }}</td>
                    <td>{{ item.tournament }}</td>
                    <td>{{ item.attendance }}</td>
                    <td>{{ item.description }}</td>
                </tr>
            </tbody>
        </table>

        <Pagination :url="`${this.url}/${this.type}`" :pagination="this.results.pagination"></Pagination>


    </section>

</template>

<script>
    import Pagination from '../../partials/Pagination.vue';

    export default {
        props: ['url'],
        name: 'Partials\Teams\Details',
        components: {
            Pagination,
        },
        data() {
            return {
                results: [],
                type: 'all',
                page: 1,

            }
        },
        methods: {
            load(page = 1) {
                let api = `/api/teams/results/${this.url}/${this.type}/page/${page}`;
                this.axios.get(api)
                    .then((response) => {
                        this.results = response.data.data;
                        // this.$store.commit('load');
                        console.log(this.results);
                    })
                    // .then(() => (this.loading = false))
                    .catch((error) => (console.log(error)));
            }
        },
        mounted() {
            // console.log(this.url);
            this.load();
        }
    }
</script>

<style>


</style>