import { createWebHistory, createRouter } from 'vue-router';

import Home from '../components/views/Home/View.vue';
import Program from '../components/views/Program/View.vue';
import Results from '../components/views/Results/List.vue';
import Standings from '../components/views/Standings/View.vue';

import TeamsList from '../components/views/Teams/List.vue';
import TeamView from '../components/views/Teams/View.vue';

import Tournaments from '../components/views/Tournaments/View.vue';

const routes = [
    { path: '/', name: 'Home', component: Home },
    { path: '/program', name: 'Program', component: Program },
    { path: '/results', name: 'Results', component: Results },
    { path: '/standings', name: 'Standings', component: Standings },
    { path: '/teams', name: 'Teams', component: TeamsList },
    { path: '/teams/:url', name: 'TeamView', component: TeamView },
    { path: '/tournaments', name: 'Tournaments', component: Tournaments },
];

const router = createRouter({
    linkActiveClass: 'active',
    history: createWebHistory(),
    routes
});

export default router;