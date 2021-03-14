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
    import Results from '../../partials/Teams/Results.vue';
    export default {
        name: 'TeamView',
        components: {
            Details,
            Results
        },
        data() {
            return {
            }
        }
    }
</script>

<!-- <style src="./assets/scss/_general.scss" lang="scss"></style> -->