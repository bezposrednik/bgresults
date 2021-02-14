<template>
  <div>
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
    name: "App",
    components: {
      Header,
      Main,
      Footer
    }
  };
</script>

<style>
  
</style>