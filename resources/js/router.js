import { createWebHistory, createRouter } from "vue-router";
import Dashboard from "./components/Dashboard";

const routes = [
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
