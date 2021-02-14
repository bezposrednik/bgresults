<template>
    
    <div>
        <h1>
            Footer
        </h1>
    </div>
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