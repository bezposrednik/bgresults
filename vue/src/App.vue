<template>

  <Admin></Admin>

  <Users></Users>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <Header></Header>
  </head>

  <body>

    <main>
      <Main></Main>
    </main>


    <footer>
      <Footer></Footer>
    </footer>
  </body>

  </html>
</template>

<script setup>
  import Header from './components/layouts/Header.vue'
  import Main from './components/layouts/Main.vue'
  import Footer from './components/layouts/Footer.vue'
</script>

<style>
  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
  }
</style>