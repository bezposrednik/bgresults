<template>
    <h1>Резултати</h1>

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
            <tr v-for="item of this.items.items" :key="item.id">
                <td>{{ item.date }}</td>
                <td>{{ item.team1_name }}</td>
                <td>{{ item.team1_goals }}</td>
                <td>{{ item.team2_goals }}</td>
                <td>{{ item.team2_name }}</td>
                <td>{{ item.stadium }}</td>
                <td>{{ item.tournament }}</td>
                <td>{{ item.attendance }}</td>
                <td>{{ item.description }}</td>
            </tr>
        </tbody>
    </table>

    <Pagination :url="this.url" :pagination="this.items.pagination"></Pagination>

</template>

<script>
    // import HomeHeader from './components/Header'
    import Pagination from '../../partials/Pagination.vue';

    export default {
        name: 'Teams',
        // components: {
        //     HomeHeader,
        //     HomeSide
        // },
        data() {
            return {
                items: [],
                page: 1,
                loading: true,
                url: `/api/results`
            }
        },
        methods: {
            loadItems(page = 1) {
                this.axios.get(`${this.url}/page/${page}`)
                    .then((response) => {
                        this.items = response.data.data;
                        console.log(this.items);
                        // this.$store.commit('load');
                    })
                    .then(() => (this.loading = false))
                    .catch((error) => (console.log(error)));
            },
        },
        mounted() {
            this.loadItems();
        }
    }
</script>

<style>

</style>