import { createWebHistory, createRouter } from "vue-router";
import Dashboard from "./components/Dashboard";
import AddRecipe from "./components/AddRecipe";
import Recipe from "./components/Recipe";
import Edit from "./components/Edit";

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
    {
        path: '/recipe/:id',
        name: 'recipe',
        props: true,
        component: Recipe,
    },
    {
        path: '/recipe/edit/:id',
        name: 'recipe-edit',
        props: true,
        component: Edit,
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
