<template>
    <section>
        <h2>Резултати</h2>
        {{ item }}

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Име</th>
                    <th>Дата</th>
                    <th>Домакин</th>
                    <!-- <th>Голове домакин</th>
                    <th>Голове гост</th>
                    <th>Стадион</th>
                    <th>Турнир</th>
                    <th>Публика</th>
                    <th>Описание</th> -->
                    
                </tr>
            </thead>
            <tbody>
                <tr v-for="item of items" :key="item.id">
                    <td>{{ item.date }}</td>
                    <td>{{ item.team1_id }}</td>
                    <td>{{ item.team1_goals }}</td>
                    <!-- <td>{{ item.team2_goals }}</td>
                    <td>{{ item.team2_id }}</td>
                    <td>{{ item.stadium_id }}</td>
                    <td>{{ item.tournament_id }}</td>
                    <td>{{ item.attendance }}</td>
                    <td>{{ item.description }}</td>                     -->
                </tr>
            </tbody>
        </table>
        <!-- <Pagination :url="this.url" :pagination="this.items.data.pagination"></Pagination> -->


    </section>

</template>

<script>
    export default {
        props: ['url'],
        name: 'Partials\Teams\Details',
        data() {
            return {
                items: null
            }
        },
        methods: {
            load() {
                let api = `/api/teams/results/${this.url}`;
                this.axios.get(api)
                    .then((response) => {
                        this.items = response.data;
                        // this.$store.commit('load');
                        // console.log(response.data);
                    })
                    // .then(() => (this.loading = false))
                    .catch((error) => (console.log(error)));
            }
        },
        mounted() {
            this.load();
        }
    }
</script>

<style>


</style>