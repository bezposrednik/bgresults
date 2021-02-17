<template>
    <section>

        <div v-if="loading" style="background: red;">Loading...</div>

        <div v-else>
           Team / Info
           Team / Results
           Team / Statistics
        </div>

    </section>

</template>

<script>
    

    export default {
        name: 'Teams',
        data() {
            return {
                page: 1,
                loading: true,
                url: `/api/teams`
            }
        },
        components: {
            
        },
        methods: {
            fetchTeams(page = 1) {
                this.axios.get(`${this.url}/page/${page}`)
                    .then((response) => {
                        this.$store.state.content = response.data;
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