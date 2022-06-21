<template>
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Edit category</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mt-3 ml-auto mr-auto">
                    <form @submit.prevent="saveCategory">
                        <div class="form-group">
                            <label>Name</label>
                            <input required type="text" class="form-control" v-model="category.name">
                        </div>
                        <div class="form-group">
                            <label>Category Description</label>
                            <textarea required class="form-control" rows="3" v-model="category.content"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <br>
                            <input required type="file" accept="image/png, image/jpeg" @change="category.image_filename">
                        </div>
                        <div class="form-group">
                            <label>Active</label>
                            <select class="form-control" v-model="category.active">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-danger">Edit</button>
                    </form>
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
            category: {}
        }
    },

    mounted() {
        this.getCategory()
    },

    methods: {
        getCategory() {
            axios
                .get(`http://127.0.0.1:8000/api/categories/${this.$route.params.id}`)
                .then(response => {
                    this.category = response.data.categories;
                });
        },

        async saveCategory() {
            await axios
                .put(`http://127.0.0.1:8000/api/categories/${this.$route.params.id}`, this.category)
                .then(response => (
                    this.$router.push('/categories')
                ))
                .catch(error => console.log(error))
        }
    }
}
</script>

<style scoped>

</style>
