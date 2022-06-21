<template>
    <div class="card">
        <div class="card-header">

            <h3 class="text-center">Synchronize from Spoonacular</h3>
        </div>
        <div class="card-body text-center">
            <router-link to="/spoonacular/validate" class="btn btn-primary my-5">Click here to view random recipes to import</router-link>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            spoonacular: {},
        }
    },
}
</script>
