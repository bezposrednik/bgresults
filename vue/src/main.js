import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import VueAxios from 'vue-axios'

// const cors = require("cors");
const app = createApp(App);
app.use(router);
app.use(VueAxios, axios);
// app.use(cors());
app.mount('#app');
// createApp(App).use(router).mount('#app')
