<template>
    <div>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add New Category <i class="fa fa-plus" aria-hidden="true"></i></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Text Editors</li>
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
                                <h3 class="card-title">Add New Category</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <ValidationObserver v-slot="{ invalid }">
                                <form @submit.prevent="formSubmit">

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="Category Name">Category Name</label>
                                            <ValidationProvider name='category' rules='required' v-slot="{errors}">
                                                <input type="text" v-model="category" class="form-control"
                                                    placeholder="Category Name">
                                                <span class="text-danger">
                                                    <small>{{ errors[0] }}</small>
                                                    <small v-if="errors && errors.category"
                                                        class="text-danger">{{ errors.category[0] }}</small>
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

    import {
        ValidationProvider,
        ValidationObserver
    } from "vee-validate"
    import {
        extend
    } from 'vee-validate';
    import {
        required,

    } from 'vee-validate/dist/rules'
    import {
        SemipolarSpinner
    } from 'epic-spinners'


    extend('required', {
        ...required,
        message: 'This field is required'
    });
    export default {
        components: {
            ValidationProvider,
            ValidationObserver,
            SemipolarSpinner
        },
        data() {
            return {
                category: '',
                errors: null,
                success: null,
                loading: false
            }
        },
        methods: {
            formSubmit(e) {
                e.preventDefault()
                this.loading = true
                var formData = new FormData()
                formData.append('name', this.category)
                axios.post('/api/addnewcategory', formData).then((response) => {
                    if (response.status === 200) {
                        //reset the form

                        this.category = ''
                        this.success = response.data.success
                        this.successModal()

                    }
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {}
                        this.errorModal()
                         
                    }else{
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
                    text:  'Category Exists',
                    icon: 'error',
                    confirmButtonText: 'Okay'
                })
            }

        }

    };

</script>
