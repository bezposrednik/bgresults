<template>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <div id="nav">
        <router-link to="/">Home</router-link> |
        <router-link to="/teams">Teams</router-link> |
        <router-link to="/results">Results</router-link>
    </div>

    <router-view />

</template>

<script>
    // import HomeHeader from './components/Header'

    export default {
        name: 'Teams',
        // components: {
        //     HomeHeader,
        //     HomeSide
        // },

        mounted() {
            // this.fetchTodos()
        },

        data() {
            return {

                teams: [
                    { name: "cska", url: "ProjectDetail" },
                    { name: "levski", url: "ProjectDetail" },
                ]


            }
        },
        methods: {
            test() {
                console.log('works!');
                this.axios({
                    method: 'GET',
                    url: `api/teams/1`,
                    headers: {
                        'Access-Control-Allow-Origin': '*',
                        'Content-type': 'application/json',
                    }
                }).then(function (response) {
                    console.log(response)
                }).catch(function (error) {
                    console.log(error);
                });
            }
        }


    }
</script>

<style>

</style>