<template>
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Categories</h3>
        </div>
        <div class="card-body text-center">
            <div class="clearfix mb-3">
                <a href="javascript:void(0)" class="btn btn-primary float-end" @click="changeRoutes(null, 'add')">Add</a>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Active</th>
                    <th class="text-right">Created at</th>
                    <th class="text-right">Updated at</th>
                    <th class="text-right"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="category in categories">
                    <td>{{ category.id }}</td>
                    <td>{{ category.name }}</td>
                    <td>{{ category.active ? 'Actief' : 'Inactief' }}</td>
                    <td class="text-right">{{ category.created_at }}</td>
                    <td class="text-right">{{ category.updated_at }}</td>
                    <td class="text-right">
                        <a href="javascript:void(0)" @click="changeRoutes(category.id, 'show')">Show</a>
                        &nbsp;|&nbsp;
                        <a href="javascript:void(0)" @click="changeRoutes(category.id, 'edit')">Edit</a>
                        &nbsp;|&nbsp;
                        <a href="javascript:void(0)" @click="deleteCategory(category.id)">Delete</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            categories: []
        }
    },

    mounted() {
        this.loadCategories()
    },

    methods: {
        changeRoutes(id, url) {
            if (url === 'show') {
                this.$router.push(`/category/${id}`)
            } else if (url === 'edit') {
                this.$router.push(`/category/edit/${id}`)
            } else {
                this.$router.push(`/add-category`)
            }
        },

        loadCategories() {
            axios
                .get(`http://127.0.0.1:8000/api/categories`)
                .then(response => {
                    console.log(response)
                    this.categories = response.data.categories.data;
                });
        },

        deleteCategory(id) {
            axios
                .delete(`http://127.0.0.1:8000/api/categories/${id}`)
                .then(response => {
                    this.loadCategories()
                });
        },
    }
}
</script>
