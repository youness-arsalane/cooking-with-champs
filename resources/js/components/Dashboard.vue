<template>
    <div class="container-fluid">
        <div class="row">
            <div v-for="recipe in recipes" @click="" class="card m-3" style="width: 18rem;">
                <img class="card-img-top" src="../../../public/images/no-image.png" alt="Card image cap">
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