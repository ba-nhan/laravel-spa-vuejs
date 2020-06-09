// import 'es6-promise/auto'
import axios from 'axios'
// import './bootstrap'
import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import Index from './Index' 
import auth from './auth'
import router from './router'

import Materialize from 'materialize-css'
import 'materialize-css/dist/css/materialize.css'
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'
Vue.use(Materialize)


import VueBootstrapTypeahead from 'vue-bootstrap-typeahead'
Vue.component('vue-bootstrap-typeahead', VueBootstrapTypeahead)

import * as VueGoogleMaps from "vue2-google-maps";
Vue.use(VueGoogleMaps, {
  load: {
    key: "AIzaSyBxw9mWSmSwKOieEj3x-rccrmww-BbEhIU",
    libraries: "places"
  }
});
//Set axios
window.axios = require('axios')
// Set Vue globally
window.Vue = Vue

// Set Vue router
Vue.router = router
Vue.use(VueRouter)
// Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `http://127.0.0.1:8000/`
Vue.use(VueAuth, auth)
// Load Index
Vue.component('index', Index)

const app = new Vue({
  el: '#app',
  router,
  
});