<template>
    <h1>Teams!!!!!</h1>

    <ul>
        <li v-for="item of teams" :key="item.name">
            {{ item.name }}
        </li>
    </ul>

    <button @click="test()">CLick</button>

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