/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import CKEditor from '@ckeditor/ckeditor5-vue';
Vue.use(CKEditor);

import VueAxios from 'vue-axios';
import axios from 'axios';

import Admin from './Admin.vue';
Vue.use(VueAxios, axios);

import {
    BootstrapVue,
    IconsPlugin
} from 'bootstrap-vue'

Vue.use(BootstrapVue)

Vue.use(IconsPlugin)
Vue.use(require('vue-moment'))

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('login-component', require('./components/admin/LoginComponent.vue').default);
// Vue.component('register-component', require('./components/admin/RegisterComponent.vue').default);
import Login from './components/admin/LoginComponent.vue';
import Register from './components/admin/RegisterComponent.vue';
import App from './App.vue';


import DashboardComponent from './components/admin/DashboardComponent.vue';
import AddNewPostComponent from './components/admin/AddNewPostComponent.vue';
import AddNewCategoryComponent from './components/admin/AddNewCategoryComponent.vue';
import DraftsComponent from './components/admin/DraftsComponent.vue';
import EditPostComponent from './components/admin/EditPostComponent.vue';
import LivePostsComponent from './components/admin/LivePostsComponent.vue';


const routes = [{
        path: '/',
        component: App,
        children: [{
                path: '/login',
                component: Login,
            },
            {
                path: '/register',
                component: Register
            },
            {
                path: '/dashboard',
                component: Admin,
                children: [{
                        name: 'home',
                        path: '/home',
                        component: DashboardComponent
                    },
                    {
                        name: 'addnewpost',
                        path: '/addnewpost',
                        component: AddNewPostComponent
                    },
                    {
                        name: 'addnewcategory',
                        path: '/addnewcategory',
                        component: AddNewCategoryComponent
                    },
                    {
                        name: 'drafts',
                        path: '/drafts',
                        component: DraftsComponent
                    },
                    {
                        name: 'liveposts',
                        path: '/liveposts',
                        component: LivePostsComponent
                    },
                    {
                        name: 'editpost',
                        path: '/editpost/:id',
                        component: EditPostComponent
                    }
                ]
            }
        ],

    },


]

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    mode: 'history',
    routes: routes
});
const app = new Vue(Vue.util.extend({
    router
}, App)).$mount('#app');
