import { createWebHistory, createRouter } from "vue-router";
import Dashboard from "./components/Dashboard";
import AddRecipe from "./components/AddRecipe";

const routes = [
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard
    },
    {
        path: '/add-recipe',
        name: 'add-recipe',
        component: AddRecipe
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
