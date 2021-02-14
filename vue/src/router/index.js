import { createWebHistory, createRouter } from 'vue-router';

import Home from '../components/views/Home.vue';
import Teams from '../components/views/Teams.vue';
import Results from '../components/views/Results.vue';
// import Tournaments from '../components/views/Tournaments.vue';

const routes = [
    { path: '/', name: 'Home', component: Home },
    { path: '/teams', name: 'Teams', component: Teams },
    // { path: '/teams/:id', component: Teams },
    { path: '/results', name: 'Results', component: Results },
    // { path: '/tournaments', name: 'Tournaments', component: Tournaments },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;