import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import VueAxios from 'vue-axios'

const app = createApp(App);

app.use(router);
app.use(VueAxios, axios);
app.mount('#app');

// new Vue({
//     router,
//     store,
//     axios,
//     render: h => h(App)
//   }).$mount("#app");

