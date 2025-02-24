require('./bootstrap');
import Vue from 'vue'
import router from './router'
import store from './store'
import App from './layouts/App'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import '../css/app.css'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      // this route requires auth, check if logged in
      // if not, redirect to login page.
      if (!store.getters.loggedIn) {
        next({
          name: 'login',
        })
      } else {
        next()
      }
    } else {
      next() // make sure to always call next()!
    }
  })

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});
