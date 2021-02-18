import { createWebHistory, createRouter } from 'vue-router';

import Home from '../components/views/Home.vue';
import TeamsList from '../components/views/Teams/List.vue';
import TeamView from '../components/views/Teams/View.vue';
import Results from '../components/views/Results.vue';
// import Tournaments from '../components/views/Tournaments.vue';

const routes = [
    { path: '/', name: 'Home', component: Home },
    {
        path: '/teams',
        name: 'Teams',
        component: TeamsList,
        // children: [
        //     {
        //         path: '/teams/:url',
        //         component: TeamView
        //     }
        // ]
    },
    { path: '/teams/:url', name: 'TeamView', component: TeamView },
    { path: '/results', name: 'Results', component: Results },
    // { path: '/tournaments', name: 'Tournaments', component: Tournaments },
];

const router = createRouter({
    linkActiveClass: 'active',
    history: createWebHistory(),
    routes
});

export default router;