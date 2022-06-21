<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Validate | Synchronize from Spoonacular</h3>
            </div>
            <div class="card-body">
                <form @submit.prevent="syncRecipes">
                    <div class="position-relative" style="padding-bottom:4rem;">
                        <div class="position-absolute text-left" style="left:0;z-index:1;">
                            <input type="checkbox" id="spoonacularRecipe_top" class="spoonacularRecipe_all" value="1" v-model="allSelected" @click="selectAll">
                            <label for="spoonacularRecipe_top" class="ml-1">Select all</label>
                        </div>
                        <div class="position-absolute text-center" style="left:0;right:0;z-index:0;">
                            <button type="button" class="btn btn-outline-primary" @click="getSpoonacularRecipes">Refresh list</button>
                        </div>
                        <div class="position-absolute text-right" style="right:0;z-index:1;">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>

                    <div class="row" style="min-height:10rem;">
                        <div v-for="spoonacularRecipe in spoonacularRecipes" class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-header text-center">
                                    <input type="checkbox" name="spoonacularIds[]" :id="`spoonacularRecipe_${spoonacularRecipe.id}`" v-model="selected" :value="`${spoonacularRecipe.id}`">
                                    <label :for="`spoonacularRecipe_${spoonacularRecipe.id}`" class="ml-1 mb-0">Select</label>
                                </div>
                                <div class="card-body">
                                    <img :src="`${spoonacularRecipe.image}`" alt="" style="width:100%;">
                                    <p class="card-text mt-1" style="height:5rem;">{{ spoonacularRecipe.title }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="position-relative" style="height:5rem;padding-top:2rem;">
                        <div class="position-absolute text-left" style="left:0;z-index:0;">
                            <input type="checkbox" id="spoonacularRecipe_top" class="spoonacularRecipe_all" value="1" v-model="allSelected" @click="selectAll">
                            <label for="spoonacularRecipe_top" class="ml-1">Select all</label>
                        </div>
                        <div class="position-absolute text-center" style="left:0;right:0;z-index:1;">
                            <button type="button" class="btn btn-outline-primary" @click="getSpoonacularRecipes">Refresh list</button>
                        </div>
                        <div class="position-absolute text-right" style="right:0;z-index:0;">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            spoonacularRecipes: {},
            selectedSpoonacularRecipes: {},
            spoonacular: {},
            selected: [],
            allSelected: false
        }
    },

    mounted() {
        this.getSpoonacularRecipes();

        let user = this.$store.getters.getUser.data;
        if (typeof user === 'undefined') {
            this.$router.push('/login');
            alert('You have to be logged in to use this functionality.');
        }
    },

    methods: {
        async syncRecipes() {
            let selectedSpoonacularRecipes = [];
            let spoonacularRecipes = this.spoonacularRecipes;
            this.selected.forEach(function (spoonacularRecipeId) {
                spoonacularRecipes.forEach(function (spoonacularRecipe) {
                    if (spoonacularRecipeId.toString() === spoonacularRecipe.id.toString()) {
                        selectedSpoonacularRecipes.push(spoonacularRecipe);
                        return false;
                    }
                });
            });

            let user = this.$store.getters.getUser.data;

            if (typeof user === 'undefined') {
                alert('You have to be logged in to use this functionality.');
                return false;
            }

            await axios
                .post('http://127.0.0.1:8000/api/spoonacular/sync', {
                    'spoonacularRecipes': selectedSpoonacularRecipes,
                    'user_id': user.id
                })
                .then(response => (
                    this.$router.push('/')
                ))
                .catch(error => console.log(error))
        },

        getSpoonacularRecipes() {
            axios
                .get('http://127.0.0.1:8000/api/spoonacular/recipes')
                .then(response => {
                    this.spoonacularRecipes = response.data;
                });
        },

        selectAll(value) {
            console.log(value);

            let selected = [];

            if (value && !this.allSelected) {
                this.spoonacularRecipes.forEach(function (spoonacularRecipe) {
                    selected.push(spoonacularRecipe.id);
                });

                console.log(selected);
            }

            this.allSelected = !this.allSelected;
            this.selected = selected;
        },
    }
}
</script>
