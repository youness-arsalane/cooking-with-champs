<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Edit recipe</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mt-3 ml-auto mr-auto">
                        <form @submit.prevent="editMessage">
                            <div class="form-group">
                                <label>Content</label>
                                <textarea required class="form-control" v-model="message.content"></textarea>
                            </div>
                            <input name="user_id" style="display: none;" :value="message.user_id"/>
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
            message: {},
        }
    },

    mounted() {
        this.getMessage()
    },

    methods: {
        getMessage() {
            axios
                .get(`http://127.0.0.1:8000/api/recipes/message/${this.$route.params.messageId}`)
                .then(response => {
                    this.message = response.data.message;
                });
        },

        async editMessage() {
            this.message.user_id = this.$store.getters.getUser.data.id
            await axios
                .put(`http://127.0.0.1:8000/api/recipes/message/${this.$route.params.messageId}`, this.message)
                .then(response => (
                    this.$router.push('/')
                ))
                .catch(error => console.log(error))
        }
    }
}
</script>
