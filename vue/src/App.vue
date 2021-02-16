<template>
  <div>
    <!-- 
    <h1 style="background: red;">count: {{ count }}</h1>

    <button @click="increment">Increment</button> -->


    <Header></Header>

    <Main></Main>


    <Footer></Footer>
  </div>
</template>

<script>
  import Header from './components/layouts/Header.vue';
  import Main from './components/layouts/Main.vue';
  import Footer from './components/layouts/Footer.vue';

  export default {
    name: 'App',
    components: {
      Header,
      Main,
      Footer
    },
    data() {
      return {

      }
    }
  };
</script>

<style>

</style>