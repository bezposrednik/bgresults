<template>
    <section>
        <h1>Детайли</h1>
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
                    <td>{{ item.name }}</td>
                    <td>{{ item.description }}</td>
                    <td>{{ item.founded }}</td>
                    <td>{{ item.location }}</td>
                    <td>{{ item.logo }}</td>
                    <td>{{ item.stadium }}</td>
                </tr>
            </tbody>
        </table>
    </section>
</template>

<script>
    export default {
        props: ['url'],
        name: 'Partials\Teams\Details',
        data() {
            return {
                item: {}
            }
        },
        methods: {
            load() {
                let api = `/api/teams/details/${this.url}`;
                this.axios.get(api)
                    .then((response) => {
                        this.item = response.data.data;
                        // this.$store.commit('load');
                        console.log(response.data);
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