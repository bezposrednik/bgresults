import { createWebHistory, createRouter } from 'vue-router';

import Home from '../components/views/Home.vue';
import TeamsList from '../components/views/Teams/List.vue';
import TeamsView from '../components/views/Teams/View.vue';
import Results from '../components/views/Results.vue';
// import Tournaments from '../components/views/Tournaments.vue';

const routes = [
    { path: '/', name: 'Home', component: Home },
    { path: '/teams', name: 'Teams', component: TeamsList },
    { path: '/teams/:id/:url', component: TeamsView },
    { path: '/results', name: 'Results', component: Results },
    // { path: '/tournaments', name: 'Tournaments', component: Tournaments },
];

const router = createRouter({
    linkActiveClass: 'active',
    history: createWebHistory(), 
    routes
});

export default router;