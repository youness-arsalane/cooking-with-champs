<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Add message</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mt-3 ml-auto mr-auto">
                        <form @submit.prevent="addMessage">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea required class="form-control" rows="3" v-model="message.content"></textarea>
                            </div>
                            <input name="user_id" style="display: none;" :value="message.user_id"/>
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
            message: {},
        }
    },

    user () {
        return this.$store.getters.getUser.data
    },

    methods: {
        async addMessage() {
            this.message.user_id = this.$store.getters.getUser.data.id
            await axios
                .post(`http://127.0.0.1:8000/api/recipes/${this.$route.params.id}/message`, this.message)
                .then(response => (
                    this.$router.push('/')
                ))
                .catch(error => console.log(error))
        }
    }
}
</script>
