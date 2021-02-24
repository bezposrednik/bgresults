<template>
    <div>

        <div class="row">
            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <button @click="loadContent('prev')" class="btn btn-success me-md-2" type="button" disabled>Назад</button>
                    <button @click="loadContent('next')" class="btn btn-success" type="button">Напред</button>
                  </div>
            </div>
        </div>


        <!-- <button @click="loadContent('prev')" type="button" class="btn btn-success">Previous</button>
        |
        <button @click="loadContent('next')" type="button" class="btn btn-success">Next</button> -->
    </div>
</template>

<script>
    export default {
        name: 'Pagination',
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