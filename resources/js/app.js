/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import CKEditor from '@ckeditor/ckeditor5-vue'
Vue.use(CKEditor)

import VueAxios from 'vue-axios'
import axios from 'axios'
Vue.use(VueAxios, axios)

import Admin from './Admin.vue'


import {
    BootstrapVue,
    IconsPlugin
} from 'bootstrap-vue'
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(require('vue-moment'))

import Vuex from 'vuex'
Vue.use(Vuex)

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


import Login from './components/admin/LoginComponent.vue'
import Register from './components/admin/RegisterComponent.vue'
import App from './App.vue'
import storeData from './store/store.js'

const store = new Vuex.Store(
    storeData
)


import DashboardComponent from './components/admin/DashboardComponent.vue'
import AddNewPostComponent from './components/admin/AddNewPostComponent.vue'
import AddNewCategoryComponent from './components/admin/AddNewCategoryComponent.vue'
import DraftsComponent from './components/admin/DraftsComponent.vue'
import EditPostComponent from './components/admin/EditPostComponent.vue'
import LivePostsComponent from './components/admin/LivePostsComponent.vue'
import ProfileComponent from './components/admin/ProfileComponent.vue'


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
                        name: 'profile',
                        path: '/profile/:username',
                        component: ProfileComponent
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
})
const app = new Vue(Vue.util.extend({
    router, store
}, App)).$mount('#app')
