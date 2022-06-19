<template>
    <div style="padding-bottom: 100px">
        <div v-if="recipe">
            <div class="card">
                <img class="card-img-top" :src="`/images/${recipe.logo}`"  alt="Card image cap">
                <div class="card-body">
                    <h1 class="card-title">{{ recipe.title }}</h1>
                    <p class="card-text">{{ recipe.description }}</p>
                    <div class="fb-share-button"
                         data-href="https://www.your-domain.com/your-page.html"
                         data-layout="button_count">
                    </div>
                    <button @click="changeRoutes(recipe.id, 'edit')" type="button" class="btn btn-success mr-1">Edit</button>
                    <button @click="deleteRecipe(recipe.id)" type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
        <div v-if="recipe">
            <div v-if="recipe.recipe_comments" class="mt-3">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Comments</h1>
                    </div>
                    <div class="card-body">
                        <div v-for="comment in recipe.recipe_comments" class="card mt-3">
                            <div class="card-body">
                                <p class="card-title text-primary">{{ comment.user.name }}</p>
                                <p class="card-text">{{ comment.content }}</p>
                            </div>
                        </div>
                        <button @click="changeRoutes(recipe.id, 'message')" type="button" class="btn btn-success mt-3">Place message</button>
                    </div>
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
            comments: null,
            recipe: null
        }
    },
    mounted() {
        this.getRecipe()
    },
    methods: {
        changeRoutes(id, url) {
            if (url === 'edit') {
                this.$router.push(`/recipe/edit/${id}`)
            } else {
                this.$router.push(`/recipe/${id}/add-message`)
            }
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
                    console.log(response)
                    this.recipe = response.data.recipes;
                });
        },
    }
}
</script>