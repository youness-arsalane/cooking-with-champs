<template>
    <div class="container-fluid main-content">
        <div class="row main-content__recipe-row">
            <div v-for="recipe in recipes" @click="changeRoutes(recipe.id)" class="main-content__recipe-row--card card m-3" style="width: 18rem;">
                <img class="card-img-top" src="../../../public/images/McCanada.jpeg" alt="Card image cap">
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