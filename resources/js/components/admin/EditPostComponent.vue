<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Post<i class="fa fa-plus" aria-hidden="true"></i></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Post</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">

                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Post</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <ValidationObserver v-slot="{ invalid }">
                                <form @submit="formSubmit" enctype="multipart/form-data">

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="Title">Title</label>
                                            <ValidationProvider name='title' rules='required' v-slot="{errors}">
                                                <input type="text" v-model="title" class="form-control"
                                                    placeholder="Post title" value="" required>
                                                <span class="text-danger">
                                                    <small>{{ errors[0] }}</small>
                                                    <small v-if="errors && errors.title"
                                                        class="text-danger">{{ errors.title[0] }}</small>
                                                </span>
                                            </ValidationProvider>
                                        </div>
                                        <div class="form-group">
                                            <label>Category</label>
                                            <ValidationProvider name='category' rules='required' v-slot="{errors}">
                                                <select class="form-control" v-model="category">
                                                    <option v-for="category in loadedCategories" :key="category.name">
                                                        {{category.name}}</option>
                                                </select>
                                                <span class="text-danger">
                                                    <small>{{ errors[0] }}</small>
                                                    <small v-if="errors && errors.category"
                                                        class="text-danger">{{ errors.category[0] }}</small>
                                                </span>
                                            </ValidationProvider>
                                        </div>
                                        <div class="form-group">
                                            <label>Image</label>
                                            <div class="custom-file">
                                                <ValidationProvider rules='required|image' ref="provider"
                                                    v-slot="{errors}">
                                                    <input type="file" class="custom-file-input"
                                                        v-on:change="onImageChange" id="customFile" required>
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                    <span class="text-danger">
                                                        <small>{{ errors[0] }}</small>
                                                        <small v-if="errors && errors.image"
                                                            class="text-danger">{{ errors.image[0] }}</small>
                                                    </span>
                                                </ValidationProvider>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Content</label>
                                            <div class="pad">
                                                <div class="mb-3">
                                                    <ValidationProvider name='body' rules='required|min:500'
                                                        v-slot="{errors}">
                                                        
                                                        <ckeditor :editor="editor" v-model="editorData"
                                                            :config="editorConfig"></ckeditor>
                                                        <span class="text-danger">
                                                            <small>{{ errors[0] }}</small>
                                                            <small v-if="errors && errors.body"
                                                                class="text-danger">{{ errors.body[0] }}</small>
                                                        </span>
                                                    </ValidationProvider>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Tag">Tags</label>
                                            <ValidationProvider name='tags' rules='required' v-slot="{errors}">
                                                <tags-input element-id="tags" v-model="selectedTags" :limit=5>
                                                </tags-input>
                                                <span class="text-danger">
                                                    <small>{{ errors[0] }}</small>
                                                    <small v-if="errors && errors.tags"
                                                        class="text-danger">{{ errors.tags[0] }}</small>
                                                </span>
                                            </ValidationProvider>
                                        </div>

                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <span v-if="loading">
                                            <semipolar-spinner :animation-duration="1000" class="mx-auto" :size="30"
                                                color="#339af0" /></span>
                                        <button type="submit" v-else class="btn btn-primary btn-block"
                                            :disabled="invalid">Submit</button>
                                    </div>
                                </form>
                            </ValidationObserver>

                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
</template>

<script>
    import Swal from 'sweetalert2'

    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

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
        message: 'Must be more than 500 characters'
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
                
                category: '',
                title: '',
                image: '',
                errors: {},
                loading: false,
                success: null,
                loadedCategories: null,
                selectedTags: [],
                editor: ClassicEditor,
                editorData: '',
                editorConfig: {
                    // The configuration of the editor.
                }
            }
        },
        created() {
            this.getPost()
        },
        methods: {
            getPost() {
                axios.get(`/api/posts/edit/${this.$route.params.id}`).then((response) => {
                    if (response.status === 200) {
                        this.editorData = response.data[0].body
                        this.category = response.data[0].category_id
                        this.image = response.data[0].image
                        // this.existingTags = response.data[0].tags
                        this.title = response.data[0].title

                        this.loadedCategories = response.data[1]

                    }
                    // console.log(response.data[0].image);
                }).catch(error => {
                    this.errorModal()
                })
            },
            async onImageChange(e) {
                const {
                    valid
                } = await this.$refs.provider.validate(e);

                if (valid) {
                    this.image = event.target.files[0]
                }

            },
            formSubmit(e) {
                e.preventDefault();

                this.loading = true

                let tags = this.selectedTags

                let stringifiedTags = ""
                //turn the array of values into a string
                for (let i = 0; i < tags.length; i++) {
                    stringifiedTags += tags[i].value + ", "

                }
                //remove the last comma on the string
                let finalizedTags = stringifiedTags.slice(0, -2);

                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                let uri = 'http://127.0.0.1:8000/api/post/create';
                let formData = new FormData();
                formData.append('image', this.image);
                formData.append('category', this.category);
                formData.append('body', this.editorData);
                formData.append('title', this.title);
                formData.append('tags', finalizedTags);


                axios.post(uri, formData, config).then((response) => {
                    if (response.status === 200) {
                        //reset the form
                        this.editorData = ''
                        this.category = ''
                        this.title = ''
                        this.image = ''
                        this.selectedTags = []
                        this.success = response.data.success
                        this.successModal()

                    }
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {}
                        // alert('error')
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
            }

        }
    }

</script>
