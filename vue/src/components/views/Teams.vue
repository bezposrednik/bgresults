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
                        <td>{{ item.name }}</td>
                        <td>{{ item.description }}</td>
                        <td>{{ item.founded }}</td>
                        <td>{{ item.location }}</td>
                        <td>{{ item.logo }}</td>
                    </tr>
                </tbody>

            </table>

            <Pagination :data="teams.data.pagination"></Pagination>

            <button @click="fetchTeams()">Click</button>
        </div>

    </section>

</template>

<script>
    import Pagination from '../partials/Pagination.vue';
    
    export default {
        name: 'Teams',
        data() {
            return {
                loading: true,
                teams: []
            }
        },
        components: {
            Pagination,
        },

        // props: {
        //     loading: {
        //         type: Boolean,
        //         required: true
        //     }
        // },

        // setup(props) {
        //     console.log(props.loading)
        // },

        methods: {
            fetchTeams(type) {

                console.log(type);

                let url = `/api/teams`;

                // switch (type) {
                //     case 'prev':
                //         url = `/api/teams/page/${page}`;
                //         break;
                //     case 'next':
                //         // code block
                //         break;
                //     default:
                //     break;
                // }

                // console.log(this.$route.params.id);
                // let page = this.$route.params.id;



                this.axios.get(url)
                    .then((response) => (this.teams = response.data))
                    .then(() => (this.loading = false))
                    .catch((error) => (console.log(error)));
            },

            // pagination(page) {
            //     const url = `/api/teams/page/${page}`;

            //     this.axios.get(url)
            //         .then((response) => (this.teams = response.data))
            //         .then(() => (this.loading = false))
            //         .catch((error) => (console.log(error)));
            // }



        },
        mounted() {
            this.fetchTeams();
        },

    }
</script>

<style>

</style>