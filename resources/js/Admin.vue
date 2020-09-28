<template>
    <div>
        <!--navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user8-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
                            class="fas fa-th-large"></i></a>
                </li>
            </ul>
        </nav>
        <!--/.navbar-->

        <!--Main Sidebar Container-->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <!--homelink-->
            <a href="home" class="brand-link">
                <img src="images/neptune2Favicon.png" alt="Neptune logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Neptune</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img v-bind:src="'http://127.0.0.1:8000/' + user.avatar" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <span v-b-hover="usernameHover" :class="isHovered ? 'text-danger' : ''"
                            @click="goToProfilePage()"
                            class="d-block text-white">{{  user.username | capitalize }}</span>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">
                            <!--should be active if in home link-->
                            <!--<a href="home-link" class="nav-link active"></a>-->
                            <router-link to="/home" class="nav-link active">

                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item has-treeview">
                            <!--should be active if in posts link-->
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-sticky-note"></i>
                                <p>
                                    Posts
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/addnewpost" class="nav-link">
                                        <i class="far fa-book nav-icon"></i>
                                        <p>Add New Post</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Posts</p>
                                    </router-link>
                                </li>

                                <li class="nav-item">
                                    <router-link to="/drafts" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Drafts</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/liveposts" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Live Posts</p>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>
                                    Categories
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/addnewcategory" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Add New Category</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Categories</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-header">User</li>
                        <li class="nav-item">

                            <span @click="logout" class="nav-link">
                                <i class="nav-icon fas fa-door-open  text-danger"></i>
                                <p class="text-white">Logout</p>
                            </span>

                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!--/.Main Sidebar Container-->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <transition name="fade">
                <router-view></router-view>
            </transition>

        </div>
        <!-- /.Content Wrapper -->
        <footer class="main-footer">
            <strong>Copyright © 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.0.5
            </div>
        </footer>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
</template>
<style>
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity .5s
    }

    .fade-enter,
    .fade-leave-active {
        opacity: 0
    }

</style>
<script>
    export default {
        data() {
            return {

                user: [],
                isHovered: false
            }
        },
        filters: {
            capitalize: function (value) {
                if (!value) {
                    return ''
                } else {
                    value = value.toString()
                    return value.toUpperCase()
                }

            }
        },
        methods: {
            logout() {
                axios.post('/logout').then(response => {
                    if (response.status === 204) {
                        window.location = '/login'
                    }
                })
            },
            getAuthUser() {
                axios.get('/api/user').then((response) => {
                    this.user = response.data[0]
                    // console.log(response.data[0].firstName)
                })
            },
            goToProfilePage() {
                this.$router.push({
                    name: 'profile',
                    params: {
                        username: this.user.username
                    }
                })
            },
            usernameHover(hovered) {
                this.isHovered = hovered
            }
        },
        created() {
            this.getAuthUser()
        }

    }

</script>
