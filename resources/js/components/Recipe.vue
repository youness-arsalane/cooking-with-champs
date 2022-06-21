<template>
    <div style="padding-bottom: 100px">
        <div v-if="recipe">
            <div class="card">

                <div class="row">
                    <div class="col-lg-4">
                        <img class="card-img-top p-4" :src="`/images/${recipe.logo}`"  alt="Card image cap">
                    </div>
                    <div class="col-lg-8 p-3">
                        <h1 class="card-title">{{ recipe.title }}</h1>
                        <p class="card-text"><span v-html="recipe.description"></span></p>
                        <div v-if="!loggedIn" class="fb-share-button"
                             data-href="https://www.your-domain.com/your-page.html"
                             data-layout="button_count">
                        </div>
                        <button v-if="loggedIn && user?.role === 1" @click="changeRoutes(recipe.id, 'edit')" type="button" class="btn btn-success mr-1">Edit</button>
                        <button v-if="loggedIn && user?.role === 2" @click="markFav(recipe.title)" type="button" class="btn btn-success mr-1">Mark as favourite</button>
                        <button v-if="loggedIn && user?.role === 1" @click="deleteRecipe(recipe.id)" type="button" class="btn btn-danger">Delete</button>
                    </div>
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
                        <div v-if="recipe.recipe_comments">
                            <div v-for="comment in recipe.recipe_comments" class="card mt-3">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <p class="card-title mb-4">&ldquo;{{ comment.content }}&rdquo;</p>
                                        </div>
                                        <div class="float-right"><b>{{ comment.user.name }}</b>, {{ new Date(comment.created_at).toLocaleString("en-US") }}</div>
                                    </div>

                                    <b v-if="comment.children.length">Reactions</b>
                                    <ul v-if="comment.children.length" class="mb-0">
                                        <li v-for="childComment in comment.children" style="list-style-type:circle;">
                                            &ldquo;{{ childComment.content }}&rdquo;
                                            <br>
                                            <small class="text-muted"><b>{{ childComment.user.name }}</b>, {{ new Date(childComment.created_at).toLocaleString("en-US") }}</small>
                                        </li>
                                    </ul>

                                    <div class="clearfix">
                                        <div class="float-right">
                                            <button type="button" class="btn btn-primary mt-3" v-if="loggedIn && comment.user_id === user?.id" @click="changeRouteEditMessage(recipe.id, comment.id)">Edit</button>
                                            <button type="button" class="btn btn-outline-primary mt-3 ml-2" v-if="loggedIn && comment.user_id === user?.id" @click="changeRoutes(recipe.id, 'message', comment.id)">React</button>
                                            <button type="button" class="btn btn-danger mt-3 ml-2" v-if="loggedIn && comment.user_id === user?.id" @click="deleteMessage(comment.id)">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <h3 class="text-center text-muted my-4">No comments have been placed yet.</h3>
                        </div>
                        <button v-if="loggedIn" @click="changeRoutes(recipe.id, 'message')" type="button" class="btn btn-success mt-3">Place message</button>
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
            recipe: null,
            currentMessage: null
        }
    },
    computed: {
        loggedIn () {
            return this.$store.getters.getLoggedIn
        },

        user () {
            return this.$store.getters.getUser.data
        },
    },

    mounted() {
        this.getRecipe()
    },

    methods: {

        getRecipe() {
            axios
                .get(`http://127.0.0.1:8000/api/recipes/${this.$route.params.id}`)
                .then(response => {
                    console.log(response)
                    this.recipe = response.data.recipes;
                });
        },

        deleteRecipe(id) {
            axios
                .delete(`http://127.0.0.1:8000/api/recipes/${id}`)
                .then(response => {
                    this.$router.push('/')
                });
        },

        getMessage(id) {
            axios
                .get(`http://127.0.0.1:8000/api/recipes/message/${id}`)
                .then(response => {
                    this.currentMessage = response.data.message;
                });
        },

        deleteMessage(id) {
            axios
                .delete(`http://127.0.0.1:8000/api/recipes/message/${id}`)
                .then(response => (
                    this.getRecipe()
                ))
                .catch(error => console.log(error))
        },

        changeRoutes(id, url, parentId) {
            console.log(parentId);
            if (url === 'edit') {
                this.$router.push(`/recipe/edit/${id}`)
            } else {
                if (typeof parentId !== 'undefined') {
                    this.$router.push(`/recipe/${id}/add-message/${parentId}`)
                } else {
                    this.$router.push(`/recipe/${id}/add-message`)
                }
            }
        },

        markFav(name) {
            this.$store.dispatch('markFav', name)
        },

        changeRouteEditMessage(userId, messageId) {
            this.$router.push(`/recipe/${userId}/edit-message/${messageId}`)
        },

    }
}
</script>
