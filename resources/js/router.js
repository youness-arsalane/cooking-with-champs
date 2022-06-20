import { createWebHistory, createRouter } from "vue-router";
import Dashboard from "./components/Dashboard";
import AddRecipe from "./components/AddRecipe";
import Recipe from "./components/Recipe";
import Edit from "./components/Edit";
import AddMessage from "./components/AddMessage";
import Login from "./components/Login";
import Register from "./components/Register";

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
    {
        path: '/recipe/:id/add-message',
        name: 'add-message',
        props: true,
        component: AddMessage,
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
