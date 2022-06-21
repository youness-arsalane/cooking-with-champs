<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Contact</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mt-3 ml-auto mr-auto">
                        <form @submit.prevent="postContact">
                            <div class="form-group">
                                <label>Email</label>
                                <input required type="email" class="form-control" v-model="contact.email">
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <textarea required class="form-control" rows="15" v-model="contact.message"></textarea>
                            </div>
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
            contact: {},
        }
    },

    methods: {
        async postContact() {
            await axios
                .post('http://127.0.0.1:8000/api/contact', this.contact)
                .then(response => (
                    this.$router.push('/')
                ))
                .catch(error => console.log(error))
        }
    }
}
</script>
