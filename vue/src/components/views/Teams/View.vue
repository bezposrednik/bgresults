<template>
    <section>

        <!-- <div v-if="loading" style="background: red;">Loading...</div> -->
        <!-- <div v-else> -->
        <Details :url="this.$route.params.url"></Details>

        <Results :url="this.$route.params.url"></Results>
        <!-- </div> -->

    </section>

</template>

<script>

    import Details from '../../partials/Teams/Details.vue';
    import Filters from '../../partials/Teams/Filters.vue';
    import Results from '../../partials/Teams/Results.vue';

    export default {
        name: 'TeamView',
        components: {
            Details,
            Results,
            Filters
        },
        data() {
            return {
                // id: 0,
                // loading: true,
                // url: `/api/teams/${this.$route.params.id}`
            }
        },
        // methods: {
        //     fetchTeam() {
        //         this.axios.get(this.url)
        //             .then((response) => {
        //                 this.$store.state.content = response.data.data;
        //                 // this.$store.commit('load');
        //                 console.log(response.data);
        //             })
        //             .then(() => (this.loading = false))
        //             .catch((error) => (console.log(error)));
        //     },
        // },
        mounted() {
            // this.fetchTeam();
            // console.log(`${this.$route.params.id}`);
        },
        // computed: {
        //     item() {
        //         return this.$store.state.content;
        //     }
        // }
    }
</script>

<!-- <style src="./assets/scss/_general.scss" lang="scss"></style> -->