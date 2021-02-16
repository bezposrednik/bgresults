import { createApp } from 'vue'

import Router from './router/router'
import Store from './store/store'
import Axios from 'axios'
import VueAxios from 'vue-axios'
import App from './App.vue'

const app = createApp(App);

app.use(Router);
app.use(Store);
app.use(VueAxios, Axios);
app.mount('#app');