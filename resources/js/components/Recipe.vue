<template>
    <div style="padding-bottom: 100px">
        <div v-if="recipe">
            <div class="card">
                <img class="card-img-top" :src="`/images/${recipe.logo}`"  alt="Card image cap">
                <div class="card-body">
                    <h1 class="card-title">{{ recipe.title }}</h1>
                    <p class="card-text">{{ recipe.description }}</p>
                    <button @click="changeRoutes(recipe.id)" type="button" class="btn btn-success mr-1">Edit</button>
                    <button @click="deleteRecipe(recipe.id)" type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
        <div class="container d-flex justify-content-center" fluid v-else>
            <b-spinner label="Spinning"></b-spinner>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            recipe: null
        }
    },
    mounted() {
        this.getRecipe()
    },
    methods: {
        changeRoutes(id) {
            this.$router.push(`/recipe/edit/${id}`)
        },

        deleteRecipe(id) {
            axios
                .delete(`http://localhost:8000/api/recipes/${id}`)
                .then(response => {
                    this.$router.push('/')
                });
        },

        getRecipe() {
            axios
                .get(`http://localhost:8000/api/recipes/${this.$route.params.id}`)
                .then(response => {
                    this.recipe = response.data.recipes;
                });
        },
    }
}
</script>