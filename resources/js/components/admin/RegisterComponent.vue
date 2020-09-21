<template>
    <div>
        <div class="register-box">
            <div class="register-logo">
                <b>Neptune</b>
            </div>

            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg">Register</p>

                    <form @submit.prevent="register">
                        <small v-if="errors && errors.firstName" class="text-danger">{{ errors.firstName[0] }}</small>
                        <div class="input-group mb-3">
                            <input id="firstName" type="text" name="firstName" v-model="firstName" class="form-control"
                                value="" placeholder="Firstname" required autocomplete="firstName" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>

                        </div>
                        <small v-if="errors && errors.lastName" class="text-danger">{{ errors.lastName[0] }}</small>
                        <div class="input-group mb-3">
                            <input id="lastName" type="text" name="lastName" class="form-control" v-model="lastName"
                                value="" placeholder="Lastname" required autocomplete="lastName" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>

                        </div>
                        <small v-if="errors && errors.username" class="text-danger">{{ errors.username[0] }}</small>
                        <div class="input-group mb-3">
                            <input id="username" type="text" name="username" class="form-control" v-model="username"
                                placeholder="Username" required autocomplete="username" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>

                        </div>
                        <small v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</small>
                        <div class="input-group mb-3">
                            <input id="email" type="email" placeholder="Email" class="form-control" v-model="email"
                                name="email" value="" required autocomplete="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>

                        </div>
                        <small v-if="errors && errors.password" class="text-danger">{{ errors.password[0] }}</small>
                        <div class="input-group mb-3">
                            <input id="password" type="password" placeholder="Password" class="form-control"
                                v-model="password" name="password" required autocomplete="new-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>

                        </div>

                        <div class="input-group mb-3">
                            <input id="password-confirm" type="password" placeholder="Confirm Password"
                                v-model="password_confirmation" class="form-control" name="password_confirmation"
                                required autocomplete="new-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12">
                                <span v-if="loading">
                                    <semipolar-spinner :animation-duration="1000" class="mx-auto" :size="30" color="#339af0" /></span>
                                <button type="submit" v-else class="btn btn-block btn-primary">
                                    Register
                                </button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <div class="social-auth-links text-center">
                        <p>- OR -</p>
                        <a href="#" class="btn btn-block btn-primary">
                            <i class="fab fa-facebook mr-2"></i>
                            Sign up using Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-danger">
                            <i class="fab fa-google-plus mr-2"></i>
                            Sign up using Google+
                        </a>
                    </div>

                    <router-link to="/login" class="text-center">I already have a membership</router-link>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
    </div>
</template>
<script>
    import {
        SemipolarSpinner
    } from 'epic-spinners'
    export default {
        data() {
            return {
                firstName: '',
                lastName: '',
                username: '',
                email: '',
                password: '',
                password_confirmation: '',
                errors: {},
                loading: false,
            }
        },
        methods: {
            register() {
                this.loading = true;

                let formData = new FormData();
                formData.append('firstName', this.firstName);
                formData.append('lastName', this.lastName);
                formData.append('username', this.username);
                formData.append('email', this.email);
                formData.append('password', this.password);
                formData.append('password_confirmation', this.password_confirmation);

                axios.post('register', formData).then(Response => {
                    if (Response.status === 201) {
                        window.location = '/home'
                    }
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {}
                    }
                }).finally(() => {
                    this.loading = false
                });
            }
        },
        components: {
            SemipolarSpinner
        }
    }

</script>
