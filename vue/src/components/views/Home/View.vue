<template>
    <div>

        <LiveResults></LiveResults>

        <LatestResults></LatestResults>

        <UpcomingResults></UpcomingResults>

        <Standings></Standings>

    </div>
</template>

<script>
    import LiveResults from '../../partials/Home/LiveResults.vue';
    import LatestResults from '../../partials/Home/LatestResults.vue';
    import UpcomingResults from '../../partials/Home/UpcomingResults.vue';
    import Standings from '../../partials/Home/Standings.vue';

    export default {
        components: {
            LatestResults,
            LiveResults,
            UpcomingResults,
            Standings
        }

    }
</script>

<style>

</style>