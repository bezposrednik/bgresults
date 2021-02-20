<template>
    <section>
        <h2>Резултати</h2>

        <div class="row">
            <div class="col-md-3">
                По тип:
                <select class="form-select" aria-label="Default select example">
                    <option >Всички</option>
                    <option value="1" selected>Домакин</option>
                    <option value="2">Гост</option>
                </select>
            </div>
            <div class="col-md-3">
                По сезон:
                <select class="form-select" aria-label="Default select example">

                    <!-- <option selected>Всички</option> -->
                    <option value="1" selected>2020/2021</option>
                    <option value="2">2019/2020</option>
                </select>
            </div>
            <div class="col-md-3">
                По стадион:
                <select class="form-select" aria-label="Default select example">

                    <!-- <option selected>Всички</option> -->
                    <option value="1" selected>Васил Левски</option>
                    <option value="2">Българска армия</option>
                    <option value="3">Георги Аспарухов</option>
                </select>
            </div>

            <div class="col-md-3">
                По турнир:
                <select class="form-select" aria-label="Default select example">

                    <!-- <option selected>Всички</option> -->
                    <option value="1" selected>Шампионат</option>
                    <option value="2">Купа на България</option>
                    <option value="3">Супер купа на България</option>
                </select>
            </div>

            <div class="col-md-3">
                По дата:
                <input type="text" class="form-control"> до 
                <input type="text" class="form-control">
            </div>

            <div class="col-md-3">
                По голове:
                <input type="text" class="form-control"> до 
                <input type="text" class="form-control">
            </div>
        </div>


        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Дата</th>
                    <th>Домакин</th>
                    <th>Голове домакин</th>
                    <th>Голове домакин</th>
                    <th>Голове гост</th>
                    <th>Стадион</th>
                    <th>Турнир</th>
                    <th>Публика</th>
                    <th>Описание</th>

                </tr>
            </thead>
            <tbody>
                <tr v-for="item of this.results.items" :key="item.id">
                    <td>{{ item.date }}</td>
                    <td>{{ item.team1_id }}</td>
                    <td>{{ item.team1_goals }}</td>
                    <td>{{ item.team2_goals }}</td>
                    <td>{{ item.team2_id }}</td>
                    <td>{{ item.stadium }}</td>
                    <td>{{ item.tournament }}</td>
                    <td>{{ item.attendance }}</td>
                    <td>{{ item.description }}</td>
                </tr>
            </tbody>
        </table>

        <Pagination :url="`${this.url}/${this.type}`" :pagination="this.results.pagination"></Pagination>


    </section>

</template>

<script>
    import Pagination from '../../partials/Pagination.vue';

    export default {
        props: ['url'],
        name: 'Partials\Teams\Details',
        components: {
            Pagination,
        },
        data() {
            return {
                results: [],
                type: 'all',
                page: 1,

            }
        },
        methods: {
            load(page = 1) {
                let api = `/api/teams/results/${this.url}/${this.type}/page/${page}`;
                this.axios.get(api)
                    .then((response) => {
                        this.results = response.data.data;
                        // this.$store.commit('load');
                        console.log(this.results);
                    })
                    // .then(() => (this.loading = false))
                    .catch((error) => (console.log(error)));
            }
        },
        mounted() {
            console.log(this.url);
            this.load();
        }
    }
</script>

<style>


</style>