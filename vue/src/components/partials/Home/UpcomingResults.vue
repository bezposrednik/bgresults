<template>
    <section>

        <h2>Предстоящи резултати</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Име</th>
                    <th>Описание</th>
                    <th>Основан</th>
                    <th>Място</th>
                    <th>Лого</th>
                    <th>Стадион</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>22</td>
                    <td>222</td>
                    <td>222</td>
                    <td>33</td>
                    <td>4</td>
                    <td>5</td>
                </tr>
            </tbody>
        </table>

    </section>

</template>

<script>
    export default {
        props: ['url'],
        name: 'Partials\Home\UpcomingResults',
        data() {
            return {
                item: {}
            }
        },
        methods: {
            // load() {
            //     let api = `/api/teams/details/${this.url}`;
            //     this.axios.get(api)
            //         .then((response) => {
            //             this.item = response.data.data;
            //             // this.$store.commit('load');
            //             // console.log(response.data);
            //         })
            //         // .then(() => (this.loading = false))
            //         .catch((error) => (console.log(error)));
            // }
        },
        // mounted() {
        //     this.load();
        // }
    }
</script>

<style>


</style>