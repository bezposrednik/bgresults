<template>
    <section class="mt-3">

        <div class="card">
            <div class="card-header">
                Филтри
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <!-- По място: -->
                        <!-- <v-select :options="['Canada', 'United States']"></v-select> -->
                        <select class="form-select" aria-label="Default select example">
                            <option selected>-- Изберете име --</option>
                            <option value="1">Домакин</option>
                            <option value="2">Гост</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>-- Изберете място --</option>
                            <option value="1">Домакин</option>
                            <option value="2">Гост</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>-- Изберете стадион --</option>
                            <option value="1">Домакин</option>
                            <option value="2">Гост</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>




    </section>

</template>

<script>
    // import Pagination from '../../partials/Pagination.vue';
    // import Vue from 'vue';
    // import vSelect from 'vue-select';
    // import 'vue-select/dist/vue-select.css';
    // import Multiselect from '@vueform/multiselect'
    // import Multiselect from 'vue-multiselect'


    export default {
        props: ['url'],
        name: 'Partials\Teams\Details',
        components: {
            // Pagination,
            // vSelect
            // Multiselect
        },
        data() {
            return {
                // results: [],
                // type: 'all',
                // page: 1,
                // value: null,
                // options: ['list', 'of', 'options']

            }
        },
        methods: {
            // load(page = 1) {
            //     let api = `/api/teams/results/${this.url}/${this.type}/page/${page}`;
            //     this.axios.get(api)
            //         .then((response) => {
            //             this.results = response.data.data;
            //             // this.$store.commit('load');
            //             console.log(this.results);
            //         })
            //         // .then(() => (this.loading = false))
            //         .catch((error) => (console.log(error)));
            // }
        },
        mounted() {
            // console.log(this.url);
            // this.load();
        }
    }
</script>


<style>


</style>