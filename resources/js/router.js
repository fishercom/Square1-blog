import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// Pages
import NotFound from './pages/NotFound'
import Index from './pages/Index'
import Post from './pages/Post'
import Login from './pages/Login'
import Register from './pages/Register'
import Logout from './pages/Logout'
import Dashboard from './pages/Dashboard'
import CreatePost from './pages/CreatePost'

// Routes
const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'is-active',
    routes: [
        {
            path: '/index',
            name: 'index',
            component: Index,
        },
        {
            path: '/post/:id?',
            name: 'post',
            component: Post,
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/logout',
            name: 'logout',
            component: Logout,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/create-post',
            name: 'create_post',
            component: CreatePost,
            meta: {
                requiresAuth: true,
            }
        },
        { 
            path: '/404', 
            name: '404', 
            component: NotFound,
        },
        { 
            path: '*', 
            redirect: '/index', 
        },
    ],
});

export default router