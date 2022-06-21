<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Add recipe</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mt-3 ml-auto mr-auto">
                        <form @submit.prevent="addRecipe">
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
                            <div class="form-group">
                                <label>Recipe Description</label>
                                <textarea required class="form-control" rows="3" v-model="recipe.description"></textarea>
                            </div>
                            <input name="user_id" style="display: none;" :value="recipe.user_id"/>
                            <button type="submit" class="btn btn-danger">Create</button>
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
        }
    },

    user () {
        return this.$store.getters.getUser.data
    },

    methods: {
        async addRecipe() {
            this.recipe.user_id = this.$store.getters.getUser.data.id
            await axios
                .post('http://127.0.0.1:8000/api/recipes/create', this.recipe)
                .then(response => (
                    this.$router.push('/')
                ))
                .catch(error => console.log(error))
        }
    }
}
</script>
