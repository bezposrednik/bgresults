<template>

    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                    data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarExample01">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <router-link to="/" class="nav-link" active-class="active">Начало</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/teams" :class="{'active': menuActive('/teams'), 'nav-link': true} ">Отбори</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/results" class="nav-link">Резултати</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/tournaments" class="nav-link">Турнири</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navbar -->

        <!-- Jumbotron -->
        <div class="p-5 text-center bg-light">
            <h1 class="mb-3">Heading</h1>
            <h4 class="mb-3">Subheading</h4>
            <a class="btn btn-primary" href="" role="button">Call to action</a>
        </div>
        <!-- Jumbotron -->
    </header>

</template>

<script>
    export default {
        methods: {
            menuActive(path) {
                return this.$route.path.startsWith(path)
            }
        }
    }
</script>

<style lang="scss">
    .active {
        background: red;

        p {
            color: red;
        }
    }
</style>