<template>

    <div class="login-box">
        <div class="login-logo">
            <b>Neptoon</b>SPA
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="#" method="post" @submit.prevent="login">

                    <small v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</small>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" v-model="email" required autocomplete="" name="email"
                            placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" v-model="password" required name="password"
                            placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <span v-if="loading">
                                <circles-to-rhombuses-spinner  class="mx-auto pt-3" :animation-duration="1200" :circles-num="4"
                                    :circle-size="10" color="#339af0" /></span>
                            <button type="submit" v-else class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div>
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <router-link to="/register" class="text-center">Register a new membership</router-link>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

</template>
<script>
    import {
        CirclesToRhombusesSpinner
    } from 'epic-spinners'
    export default {

        data() {
            return {
                email: '',
                password: '',
                errors: {},
                loading: false,
            }
        },
        methods: {
            login() {
                this.loading = true,
                    axios.get('/sanctum/csrf-cookie').then(response => {

                        axios.post('/api/login', {
                                email: this.email,
                                password: this.password
                            })
                            .then(response => {
                                if (response.status === 204) {
                                    window.location = '/home'
                                }
                            }).catch(error => {
                                if (error.response.status === 422) {
                                    this.errors = error.response.data.errors || {}

                                }
                            }).finally(() => {
                                this.loading = false
                            });
                    })
            }
        },
        components: {
            CirclesToRhombusesSpinner
        }
    }

</script>
