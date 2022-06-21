<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <img class="" :src="`/images/${category?.image_filename}`" alt="banner" style="width:100%;">
        </div>
        <div class="col-12 mt-3">
            <h1>{{ category?.name }}</h1>
            <p>{{ category?.content }}</p>
        </div>
    </div>

    <div class="container-fluid main-content">
        <div class="row main-content__recipe-row">
            <nav class="navbar navbar-light bg-light">
                <form class="form-inline">
                    <input class="form-control mr-sm-2" type="search" @input="filter($event)" placeholder="Search" aria-label="Search">
                </form>
            </nav>
            <div v-for="recipe in recipes" @click="changeRoutes(recipe.id)" class="main-content__recipe-row--card card m-3" style="width: 18rem;">
                <img class="card-img-top" :src="`/images/${recipe.logo}`"  alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">{{ recipe.title }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            category: null,
            recipes: null
        }
    },

    mounted() {
        this.getCategory();
        this.getRecipes();
    },

    methods: {
        changeRoutes(id) {
            this.$router.push(`/recipe/${id}`)
        },

        filter(event) {
            if (event.target.value.length > 0) {
                axios
                    .get(`http://127.0.0.1:8000/api/recipes/filter/${event.target.value}`)
                    .then(response => {
                        this.recipes = response.data.recipes.data;
                    });
            } else {
                this.getRecipes()
            }
        },

        getCategory() {
            axios
                .get(`http://127.0.0.1:8000/api/category/${this.$route.params.id}`)
                .then(response => {
                    this.category = response.data.categories;
                });
        },

        getRecipes() {
            axios
                .get(`http://127.0.0.1:8000/api/category/${this.$route.params.id}/recipes`)
                .then(response => {
                    this.recipes = response.data.recipes;
                });
        },
    }
}
</script>

<style scoped>

</style>
