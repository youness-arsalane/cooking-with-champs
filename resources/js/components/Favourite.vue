<template>
    <h1 class="text-center">Favourites</h1>
    <div class="container-fluid main-content">
        <div v-if="recipes && favourite" class="row main-content__recipe-row">
            <div v-for="recipe in recipes" @click="changeRoutes(recipe.id)">
                <div class="main-content__recipe-row--card card m-3" style="width: 18rem;" v-if="favourite.includes(recipe.title)">
                    <img class="card-img-top" :src="`/images/${recipe.logo}`"  alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">{{ recipe.title }}</p>
                    </div>
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
            recipes: null,
            user: this.$store.getters.getUser.data
        }
    },

    mounted() {
        this.getRecipes()
    },

    computed: {
        favourite () {
            return this.$store.getters.getFavourite
        },
    },

    methods: {
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

        getRecipes() {
            axios
                .get('http://127.0.0.1:8000/api/recipes')
                .then(response => {
                    this.recipes = response.data.recipes.data;
                });
        },
    }
}
</script>

<style scoped>

</style>
