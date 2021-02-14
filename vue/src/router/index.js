import { createWebHistory, createRouter } from "vue-router";
import Teams from "../components/views/Teams.vue"
import Results from "../components/views/Results.vue"


const routes = [
    { path: "/teams", name: "Teams", component: Teams },
    { path: "/results", name: "Results", component: Results },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});


export default router;