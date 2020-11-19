import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    token: localStorage.getItem('access_token') || null
  },
  getters: {
    loggedIn(state) {
      return state.token !== null
    }
  },
  mutations: {
    retrieveToken(state, token) {
      state.token = token
    },
    registerUser(state, token) {
      state.token = token
    },
    destroyToken(state) {
      state.token = null
    }
  },
  actions: {
    retrieveToken(context, credentials) {

      return new Promise((resolve, reject) => {
        axios.post('/api/login', {
          email: credentials.email,
          password: credentials.password,
        })
          .then(response => {
            //console.log(response)
            const token = response.data.access_token
            localStorage.setItem('access_token', token)
            context.commit('retrieveToken', token)

            resolve(response)
          })
          .catch(error => {
            //console.log(error)
            reject(error)
          })
      })

    },
    registerUser(context, param) {
        console.log(param);

      return new Promise((resolve, reject) => {
        axios.post('/api/register', {
          name: param.name,
          email: param.email,
          password: param.password,
          password_confirmation: param.password_confirmation,
        })
          .then(response => {
            //console.log(response)
            const token = response.data.access_token
            localStorage.setItem('access_token', token)
            context.commit('retrieveToken', token)

            resolve(response)
          })
          .catch(error => {
            //console.log(error)
            reject(error)
          })
      })

    },
    destroyToken(context) {
      
      if (context.getters.loggedIn){
        
        return new Promise((resolve, reject) => {
          axios.post('/api/logout', '', {
              headers: { Authorization: "Bearer " + context.state.token }
            })
            .then(response => {
              //console.log(response)
              localStorage.removeItem('access_token')
              context.commit('destroyToken')
  
              resolve(response)
            })
            .catch(error => {
              //console.log(error)
              localStorage.removeItem('access_token')
              context.commit('destroyToken')

              reject(error)
            })
        })

      }
    },
    latestPosts(){
        return new Promise((resolve, reject) => {
          axios.get('/api/posts')
            .then(response => {
              console.log(response)
              resolve(response)
            })
            .catch(error => {
              //console.log(error)
              reject(error)
            })
        })
    },
    getPost(id){
      return new Promise((resolve, reject) => {
        axios.get('/api/post/'+id)
          .then(response => {
            console.log(response)
            resolve(response)
          })
          .catch(error => {
            //console.log(error)
            reject(error)
          })
      })
  },
  


  }
})

export default store