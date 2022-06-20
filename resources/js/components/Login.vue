<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Login</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mt-3 ml-auto mr-auto">
                        <form @submit.prevent="loginUser">
                            <div class="form-group">
                                <label>email</label>
                                <input required type="email" class="form-control" v-model="login.email">
                            </div>
                            <div class="form-group">
                                <label>password</label>
                                <input required type="password" class="form-control" v-model="login.password">
                            </div>
                            <button type="submit" class="btn btn-danger">Login</button>
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
            login: {},
        }
    },
    methods: {
        async loginUser() {
            await axios
                .post('http://localhost:8000/api/login', this.login)
                .then(response => (
                    this.$store.dispatch('setLoggedIn'),
                        this.$store.dispatch('setUser', response),
                        this.$router.push('/')
                ))
                .catch(error => console.log(error))
        }
    }
}
</script>