<template>
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
            recipes: null
        }
    },

    mounted() {
        this.getRecipes()
    },

    methods: {
        changeRoutes(id) {
            this.$router.push(`/recipe/${id}`)
        },

        filter(event) {
            if (event.target.value.length > 0) {
                axios
                    .get(`http://localhost:8000/api/recipes/filter/${event.target.value}`)
                    .then(response => {
                        this.recipes = response.data.recipes.data;
                    });
            } else {
                this.getRecipes()
            }
        },

        getRecipes() {
            axios
                .get('http://localhost:8000/api/recipes')
                .then(response => {
                    this.recipes = response.data.recipes.data;
                });
        },
    }
}
</script>

<style scoped>

</style>