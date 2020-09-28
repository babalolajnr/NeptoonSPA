<template>
    <div>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <router-link to="/home">Home</router-link>
                            </li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        v-bind:src="'http://127.0.0.1:8000/' + user.avatar" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">
                                    {{ user.firstName + ' ' + user.lastName}}</h3>

                                <p class="text-muted text-center">{{ user.headline }}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Posts</b> <a class="float-right">Post Count</a>
                                    </li>

                                </ul>

                                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i>Bio</strong>

                                <p class="text-muted" v-if="!readMoreBio" @click="changeReadMoreBio()">
                                    {{ user.bio | slice }}...
                                </p>
                                <p class="text-muted" v-else @click="changeReadMoreBio()">
                                    {{ user.bio }}
                                </p>

                                <hr>
                                <strong><i class="fas fa-book mr-1"></i>Experience</strong>

                                <p class="text-muted" v-if="!readMoreExperience" @click="changeReadMoreExperience()">
                                    {{ user.experience | slice }}...
                                </p>
                                <p class="text-muted" v-else @click="changeReadMoreExperience()">
                                    {{ user.experience }}
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                                <p class="text-muted">{{ user.location }}</p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i>Skills</strong>

                                <p class="text-muted">

                                    <span v-for="skill in this.user.skills" :key="skill"
                                        class="badge badge-pill badge-info">{{ skill }}</span>

                                </p>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#settings"
                                            data-toggle="tab">Settings</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="#profilePic" data-toggle="tab">Change
                                            Profile
                                            Picture</a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="settings">
                                        <ValidationObserver v-slot="{ invalid }">
                                            <form @submit="formSubmit">

                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="firstName">First Name</label>
                                                        <ValidationProvider rules='required' v-slot="{errors}">
                                                            <input type="text" v-model="user.firstName"
                                                                class="form-control" required>
                                                            <span class="text-danger">
                                                                <small>{{ errors[0] }}</small>
                                                                <small v-if="errors && errors.firstName"
                                                                    class="text-danger">{{ errors.firstName[0] }}</small>
                                                            </span>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="lastName">Last Name</label>
                                                        <ValidationProvider name='lastName' rules='required'
                                                            v-slot="{errors}">
                                                            <input type="text" v-model="user.lastName"
                                                                class="form-control" required>
                                                            <span class="text-danger">
                                                                <small>{{ errors[0] }}</small>
                                                                <small v-if="errors && errors.lastName"
                                                                    class="text-danger">{{ errors.lastName[0] }}</small>
                                                            </span>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="username">Username</label>
                                                        <ValidationProvider name='username' rules='required'
                                                            v-slot="{errors}">
                                                            <input type="text" v-model="user.username"
                                                                class="form-control" required>
                                                            <span class="text-danger">
                                                                <small>{{ errors[0] }}</small>
                                                                <small v-if="errors && errors.username"
                                                                    class="text-danger">{{ errors.username[0] }}</small>
                                                            </span>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="headline">Headline</label>
                                                        <ValidationProvider name='headline' rules='required'
                                                            v-slot="{errors}">
                                                            <input type="text" v-model="user.headline"
                                                                class="form-control" required>
                                                            <span class="text-danger">
                                                                <small>{{ errors[0] }}</small>
                                                                <small v-if="errors && errors.headline"
                                                                    class="text-danger">{{ errors.headline[0] }}</small>
                                                            </span>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="location">Location</label>
                                                        <ValidationProvider name='location' rules='required'
                                                            v-slot="{errors}">
                                                            <input type="text" v-model="user.location"
                                                                class="form-control" required>
                                                            <span class="text-danger">
                                                                <small>{{ errors[0] }}</small>
                                                                <small v-if="errors && errors.location"
                                                                    class="text-danger">{{ errors.location[0] }}</small>
                                                            </span>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="skills">Skills</label>
                                                        <ValidationProvider name='skills' rules='required'
                                                            v-slot="{errors}">
                                                            <tags-input element-id="skills" v-model="selectedSkills"
                                                                :limit=5>
                                                            </tags-input>
                                                            <span class="text-danger">
                                                                <small>{{ errors[0] }}</small>
                                                                <small v-if="errors && errors.skills"
                                                                    class="text-danger">{{ errors.skills[0] }}</small>
                                                            </span>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Bio</label>
                                                        <div class="pad">
                                                            <div class="mb-3">
                                                                <ValidationProvider name='bio' rules='required|min:100'
                                                                    v-slot="{errors}">

                                                                    <textarea class="form-control" v-model="user.bio"
                                                                        rows="3"></textarea>

                                                                    <span class="text-danger">
                                                                        <small>{{ errors[0] }}</small>
                                                                        <small v-if="errors && errors.bio"
                                                                            class="text-danger">{{ errors.bio[0] }}</small>
                                                                    </span>
                                                                </ValidationProvider>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Experience</label>
                                                        <div class="pad">
                                                            <div class="mb-3">
                                                                <ValidationProvider name='experience'
                                                                    rules='required|min:100' v-slot="{errors}">

                                                                    <textarea class="form-control"
                                                                        v-model="user.experience" rows="3"></textarea>

                                                                    <span class="text-danger">
                                                                        <small>{{ errors[0] }}</small>
                                                                        <small v-if="errors && errors.experience"
                                                                            class="text-danger">{{ errors.experience[0] }}</small>
                                                                    </span>
                                                                </ValidationProvider>
                                                            </div>

                                                        </div>
                                                    </div>


                                                </div>
                                                <!-- /.card-body -->
                                                <div class="card-footer">
                                                    <span v-if="loading">
                                                        <semipolar-spinner :animation-duration="1000" class="mx-auto"
                                                            :size="30" color="#339af0" /></span>
                                                    <button type="submit" v-else class="btn btn-primary btn-block"
                                                        :disabled="invalid">Submit</button>
                                                </div>
                                            </form>
                                        </ValidationObserver>
                                    </div>
                                    <div class="tab-pane" id="profilePic">
                                        <b-form @submit="updateAvatar">

                                            <b-form-file v-model="avatar" :state="Boolean(avatar)"
                                                placeholder="Choose a file or drop it here..."
                                                drop-placeholder="Drop file here..."></b-form-file>
                                            <small v-if="avatarError" class="text-danger">You have not selected any
                                                images</small>

                                            <div class="mt-3">Selected Image: {{ avatar ? avatar.name : '' }}</div>
                                            <span v-if="loading">
                                                <semipolar-spinner :animation-duration="1000" class="" :size="30"
                                                    color="#339af0" /></span>
                                            <b-button v-else type="submit" variant="primary">Submit</b-button>
                                        </b-form>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>

    </div>
</template>
<script>
    import Swal from 'sweetalert2'

    // styling for tags-input
    const style = require('@voerro/vue-tagsinput/dist/style.css');

    import VoerroTagsInput from '@voerro/vue-tagsinput';
    import {
        ValidationProvider,
        ValidationObserver
    } from "vee-validate"
    import {
        extend
    } from 'vee-validate';
    import {
        required,
        email,
        min,
        image
    } from 'vee-validate/dist/rules'
    import {
        SemipolarSpinner
    } from 'epic-spinners'

    extend('required', {
        ...required,
        message: 'This field is required'
    });

    extend('image', {
        ...image,
        message: 'An image is required'
    });

    extend('min', {
        ...min,
        message: 'Must be more than 100 characters'
    })
    export default {
        components: {
            ValidationProvider,
            ValidationObserver,
            SemipolarSpinner,
            'tags-input': VoerroTagsInput,

        },

        data() {
            return {
                errors: {},
                loading: false,
                success: null,
                user: [],
                selectedSkills: [],
                readMoreBio: false,
                readMoreExperience: false,
                avatar: null,
                avatarError: false,

            }
        },
        created() {
            this.getAuthUser()

        },
        filters: {
            slice: function (value) {
                if(!value) {
                    return ''
                }else {
                    return value.slice(0, 100)
                }
            }
        },
        methods: {
            updateAvatar(e) {
                e.preventDefault();
                if (this.avatar === null) {
                    this.avatarError = true
                } else {
                     this.avatarError = false
                    this.loading = true

                    let formData = new FormData()
                    formData.append('avatar', this.avatar)
                    formData.append('_method', 'patch')

                    axios.post('/api/user/updateAvatar/' + this.user.id, formData).then((response) => {
                        if (response.status === 200) {
                            this.success = response.data.success
                            this.getAuthUser()
                            this.successModal()
                        }
                    }).catch(error => {
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors || {}
                            this.errorModal()
                        } else {
                            this.errorModal()
                        }
                    }).finally(() => {
                        this.loading = false
                    })
                }
            },
            formSubmit(e) {
                e.preventDefault();

                this.loading = true

                let skills = this.selectedSkills

                let stringifiedSkills = ""
                //turn the array of values into a string
                for (let i = 0; i < skills.length; i++) {
                    stringifiedSkills += skills[i].value + ", "

                }
                //remove the last comma on the string
                let finalizedSkills = stringifiedSkills.slice(0, -2);

                let formData = new FormData();

                formData.append('firstName', this.user.firstName);
                formData.append('lastName', this.user.lastName);
                formData.append('username', this.user.username);
                formData.append('headline', this.user.headline);
                formData.append('location', this.user.location);
                formData.append('bio', this.user.bio);
                formData.append('experience', this.user.experience);

                formData.append('skills', finalizedSkills);
                formData.append('_method', 'patch');

                axios.post('/api/user/update/' + this.user.id, formData).then((response) => {
                    if (response.status === 200) {

                        this.success = response.data.success
                        this.successModal()

                    }
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {}
                        this.errorModal()
                    } else {
                        this.errorModal()
                    }
                }).finally(() => {
                    this.loading = false
                });

            },
            successModal() {
                Swal.fire({
                    title: 'Success!',
                    text: this.success,
                    icon: 'success',
                    confirmButtonText: 'Okay'
                })
            },
            errorModal() {
                Swal.fire({
                    title: 'Error!',
                    text: 'There may be some errors😢',
                    icon: 'error',
                    confirmButtonText: 'Okay'
                })
            },
            getAuthUser() {
                axios.get('/api/user').then((response) => {
                    this.user = response.data[0]
                    let skills = this.user.skills
                    this.user.skills = skills.split(', ')

                })
            },
            changeReadMoreBio() {
                if (this.readMoreBio === false) {
                    this.readMoreBio = true
                } else {
                    this.readMoreBio = false
                }
            },
            changeReadMoreExperience() {
                if (this.readMoreExperience === false) {
                    this.readMoreExperience = true
                } else {
                    this.readMoreExperience = false
                }
            },

        }
    }

</script>
