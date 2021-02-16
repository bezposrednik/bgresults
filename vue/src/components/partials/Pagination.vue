<template>
    <div>
        <button @click="loadContent('prev')" type="button" class="btn btn-success">Previous</button>
        |
        <button @click="loadContent('next')" type="button" class="btn btn-success">Next</button>
    </div>
</template>

<script>
    export default {
        name: "Child",
        props: {
            url: String,
            pagination: Object
        },
        methods: {
            loadContent(type) {
                let api = `${this.url}/page/`;

                switch (type) {
                    case 'prev':
                        api += this.pagination.prev;
                        break;
                    case 'next':
                        api += this.pagination.next;
                        break;
                    default:
                        break;
                }

                this.axios.get(api)
                    .then((response) => {
                        this.$store.state.content = response.data;
                        // this.$store.commit('load');
                    }) //Update parent teams
                    // .then(() => (this.loading = false)) //Update parent loading
                    .catch((error) => (console.log(error)));

            }
        }
    }
</script>

<style>

</style>