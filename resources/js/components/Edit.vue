<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Edit recipe</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mt-3 ml-auto mr-auto">
                        <form @submit.prevent="saveRecipe">
                            <div class="form-group">
                                <label>Title</label>
                                <input required type="text" class="form-control" v-model="recipe.title">
                            </div>
                            <div class="form-group">
                                <label>Tags (Comma seperated)</label>
                                <input required type="text" class="form-control" v-model="recipe.tags">
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <br>
                                <input type="file" accept="image/png, image/jpeg" @change="recipe.logo">
                            </div>
                            <div class="form-group" style="border:1px solid #CCCCCC;padding:1rem;">
                                <h5>Categories</h5>
                                <div v-for="category in categories">
                                    <input type="checkbox" :id="`category_${category.id}`" v-model="currentCategoryIds" :value="`${category.id}`">
                                    <label :for="`category_${category.id}`" class="ml-1">{{ category.name }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Recipe Description</label>
                                <textarea required class="form-control" rows="15" v-model="recipe.description"></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger">Edit</button>
                        </form>
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
            recipe: {},
            selected: {},
            categories: [],
            currentCategories: [],
            currentCategoryIds: [],
        }
    },

    mounted() {
        this.getRecipe()
        this.getCategories()
        this.getCurrentCategories()
    },

    methods: {
        getRecipe() {
            axios
                .get(`http://127.0.0.1:8000/api/recipes/${this.$route.params.id}`)
                .then(response => {
                    this.recipe = response.data.recipes;
                });
        },

        getCategories() {
            axios
                .get('http://127.0.0.1:8000/api/categories')
                .then(response => {
                    this.categories = response.data.categories.data;
                });
        },

        getCurrentCategories() {
            axios
                .get(`http://127.0.0.1:8000/api/recipes/${this.$route.params.id}/categories`)
                .then(response => {
                    this.currentCategories = response.data.categories;

                    let currentCategoryIds = [];
                    this.currentCategories.forEach(function (currentCategory) {
                        currentCategoryIds.push(currentCategory.id);
                    });

                    this.currentCategoryIds = currentCategoryIds;
                });
        },

        async saveRecipe() {
            this.recipe.categoryIds = this.currentCategoryIds;
            await axios
                .put(`http://127.0.0.1:8000/api/recipes/${this.$route.params.id}`, this.recipe)
                .then(response => (
                    this.$router.push('/')
                ))
                .catch(error => console.log(error))
        }
    }
}
</script>
