<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <button @click="loadContent('prev')" class="btn btn-success me-md-2" type="button">Назад</button>
                    <button @click="loadContent('next')" class="btn btn-success" type="button">Напред</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Pagination',
        props: {
            module: String,
            url: String,
            data: Object
        },
        methods: {
            loadContent(type) {
                let api = `${this.url}`;

                switch (type) {
                    case 'prev':
                        api += `?page=${this.data.prev}`;
                        break;
                    case 'next':
                        api += `?page=${this.data.next}`;
                        break;
                    default:
                        break;
                }
                this.axios.get(api)
                    .then((response) => {
                        this.$store.state[this.module].items = response.data;
                    }) 
                    // .then(() => (this.loading = false)) //Update parent loading
                    .catch((error) => (console.log(error)));

            }
        }
    }
</script>

<style>

</style>