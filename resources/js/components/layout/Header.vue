<template>
    <header class="main-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <router-link to="/" class="navbar-brand">Cooking with Champs</router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li v-if="loggedIn && user?.role === 1" class="nav-item">
                            <router-link to="/add-recipe" class="nav-link">Add recipe</router-link>
                        </li>
                        <li v-for="navCategory in navCategories" class="nav-item">
                            <router-link :to="`/category/${navCategory.id}`" class="nav-link">{{ navCategory.name }}</router-link>
                        </li>
                        <li v-if="loggedIn && user?.role === 1" class="nav-item">
                            <router-link to="/categories" class="nav-link">Categories</router-link>
                        </li>
                        <li v-if="loggedIn && user?.role === 1" class="nav-item">
                            <router-link to="/spoonacular" class="nav-link">Spoonacular</router-link>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li v-if="loggedIn && user?.role === 2" class="nav-item">
                            <router-link to="/favourite" class="nav-link">Favourite</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/contact" class="nav-link py-0 mt-2 pr-3" style="border-right: 1px solid rgba(0, 0, 0, 0.55);">Contact</router-link>
                        </li>
                        <li v-if="!loggedIn" class="nav-item">
                            <router-link to="/login" class="nav-link pl-3">Login</router-link>
                        </li>
                        <li v-if="!loggedIn" class="nav-item">
                            <router-link to="/register" class="nav-link">Register</router-link>
                        </li>
                        <li v-if="loggedIn" class="nav-item">
                            <div class="nav-link pl-3">Welcome, <b>{{ user?.role === 1 ? 'Admin' : '' }}</b> {{ user?.name }}!</div>
                        </li>
                        <li v-if="loggedIn" class="nav-item">
                            <a class="nav-link" href="#" @click="logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="p-5 text-center main-header__sub-header">
            <h1 class="mb-3"><span class="font-weight-bold text-white">COOKING WITH</span> <span class="font-weight-bold">CHAMPS</span></h1>
            <h4 class="mb-3 text-white">Find or post recipes to share with friends!</h4>
            <router-link class="btn btn-outline-light" v-if="!loggedIn" to="/login">Sign Up to List a Recipe</router-link>
        </div>
    </header>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            navCategories: {},
        }
    },

    mounted() {
        this.loadNavCategories();
    },

    computed: {
        loggedIn () {
            return this.$store.getters.getLoggedIn
        },

        user () {
            return this.$store.getters.getUser.data
        },

        logout() {
            this.$router.go()
        },
    },

    methods: {
        loadNavCategories() {
            axios
                .get(`http://127.0.0.1:8000/api/categories`)
                .then(response => {
                    this.navCategories = response.data.categories.data;
                    console.log(this.navCategories);
                });
        },
    }
}
</script>

<style scoped>

</style>
