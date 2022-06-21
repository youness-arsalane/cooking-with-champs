<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Login</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mt-3 ml-auto mr-auto">
                        <form @submit.prevent="registerUser">
                            <div class="form-group">
                                <label>name</label>
                                <input required type="text" class="form-control" v-model="register.name">
                            </div>
                            <div class="form-group">
                                <label>email</label>
                                <input required type="email" class="form-control" v-model="register.email">
                            </div>
                            <div class="form-group">
                                <label>password</label>
                                <input required type="password" class="form-control" v-model="register.password">
                            </div>
                            <div class="form-group">
                                <label>confirm password</label>
                                <input required type="password" class="form-control" v-model="register.password_confirmation">
                            </div>
                            <button type="submit" class="btn btn-danger">Register</button>
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
            register: {},
        }
    },
    methods: {
        async registerUser() {
            await axios
                .post('http://127.0.0.1:8000/api/register', this.register)
                .then(response => (
                    this.$router.push('/login')
                ))
                .catch(error => console.log(error))
        }
    }
}
</script>
