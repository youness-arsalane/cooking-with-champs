<template>
    <header class="main-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarExample01">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <router-link to="/" class="nav-link">Home</router-link>
                        </li>
                        <li v-if="!loggedIn" class="nav-item">
                            <router-link to="/login" class="nav-link">Login</router-link>
                        </li>
                        <li v-if="!loggedIn" class="nav-item">
                            <router-link to="/register" class="nav-link">Register</router-link>
                        </li>
                        <li v-if="loggedIn && user?.role === 1" class="nav-item">
                            <router-link to="/add-recipe" class="nav-link">Add recipe</router-link>
                        </li>
                        <li v-if="loggedIn && user?.role === 1" class="nav-item">
                            <router-link to="/spoonacular" class="nav-link">Spoonacular</router-link>
                        </li>
                        <li v-if="loggedIn && user?.role === 1" class="nav-item">
                            <router-link to="/categories" class="nav-link">Categories</router-link>
                        </li>
                        <li v-for="navCategory in navCategories" class="nav-item">
                            <router-link :to="`/categories/${navCategory.id}`" class="nav-link">{{ navCategory.name }}</router-link>
                        </li>

                        <li v-if="loggedIn" class="nav-item">
                            <div class="nav-link">Welkom {{ user?.name }}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="p-5 text-center main-header__sub-header">
            <h1 class="mb-3"><span class="font-weight-bold text-white">COOKING WITH</span> <span class="font-weight-bold">CHAMPS</span></h1>
            <h4 class="mb-3 text-white">Find or post recipes to share with friends!</h4>
            <button type="button" class="btn btn-outline-light">Sign Up to List a Recipe</button>
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
        axios
            .get(`http://127.0.0.1:8000/api/categories`)
            .then(response => {
                this.navCategories = response.data.categories.data;
                console.log(this.navCategories);
            });
    },

    computed: {
        loggedIn () {
            return this.$store.getters.getLoggedIn
        },

        user () {
            return this.$store.getters.getUser.data
        },
    }
}
</script>

<style scoped>

</style>
